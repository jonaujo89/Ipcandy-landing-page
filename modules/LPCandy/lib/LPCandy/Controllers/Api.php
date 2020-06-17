<?php

namespace LPCandy\Controllers;

class Api extends \CMS\Controllers\Admin\Base {
    function __construct() {
        parent::__construct();
        $this->user = \LPCandy\Models\User::checkLoggedIn();
        bingo_domain('lpcandy');
    }    

    function needUser() {
        if (!$this->user) die();
    }

    function needOwnPage() {
        $this->needUser();
        
        $id = $_POST['id'] ?? false;
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user) die();
        return $page;
    }

    function domainValidator($page) {
        return function ($val) use ($page) {
            if ($val) {
                $pages = \LPCandy\Models\Page::findByDomain($val);
                foreach ($pages as $one) {
                    if ($one->id!=$page->id) throw new \ValidationException(_t("Domain is already in use"));
                }
            }
            return $val;
        };
    }    

    function user() {
        echo json_encode([
            'user' => $this->user ? [
                'name'=>$this->user->name,
                'email'=>$this->user->email
            ] : false
        ]);
    }

    function user_login() {
        $token = @$_POST['token'];
        $redirect = $_GET['redirect'] ?? 'login';

        if ($this->user) { redirect($redirect);return; }
        if ($token) {
            $token_data = \LPCandy\Models\User::token_data($token);
            $user = \LPCandy\Models\User::login_token($token_data,$createUser=true);
            if ($user) {
                redirect($redirect);
                return;
            }
        }
    }

    function user_logout() {
        if ($this->user) $this->user->logout();
        echo json_encode(false);
    }


    function user_save() {
        $this->needUser();
        $this->user->email = $_POST['email'] ?? "";
        $this->user->save();
        $this->user();
    }

    function getPageTemplates() {
        $tpl_pages = [];
        $default_page = \LPCandy\Models\Page::findOneByDomain('default');
        if ($default_page) {
            $default_page->title = _t('Sample page');
            $tpl_pages[] = $default_page;
        }
        foreach (\LPCandy\Models\Page::findBy(['user'=>$this->user,'parent'=>null]) as $tpl_page) {
            if ($default_page && $default_page->id==$tpl_page->id) continue;
            $tpl_pages[] = $tpl_page;
        }
        return $tpl_pages;
    }

    function page() {
        $page = $this->needOwnPage();
        echo json_encode([
            'id' => $page->id,
            'title' => $page->title,
            'domain' => $page->domain,
            'parent_id' => $page->parent ? $page->parent->getField('id') : false,
            'pathname' => $page->pathname,
            'meta_robots' => $page->meta_robots,
            'meta_keywords' => $page->meta_keywords,
            'meta_description' => $page->meta_description
        ]);
    }

    function page_templates() {
        $this->needUser();
        echo json_encode(array_map(function($page){
            return [
                'id' => $page->id,
                'title' => $page->title,
                'screenshot_url' => $page->getScreenshotUrl()
            ];
        },$this->getPageTemplates()));
    }

    function page_design() {
        $page = $this->needOwnPage();
        echo json_encode($page->loadBlocks($published=false));
    }

    function page_view() {
        $page = \LPCandy\Models\Page::find($_POST['id'] ?? 0);
        if ($page) echo json_encode($page->loadBlocks($published=true));
    }

    function page_save() {
        $this->needUser();

        $id = $_POST['id'] ?? false;
        $parent_id = $_POST['parent_id'] ?? false;

        if (!$id) {
            $page = new \LPCandy\Models\Page;
            $page->user = $this->user;
            $parent = \LPCandy\Models\Page::find($parent_id);
            if ($parent && $parent->user==$this->user) {
                $page->parent = $parent;
            }
            $isNewPage = true;
        } else {
            $page = $this->needOwnPage();
            $isNewPage = false;
        }

        $form = new \Form();
        foreach ([
            'title' => 'required',
            'domain' => $this->domainValidator($page),
            'template','meta_robots','meta_keywords','meta_description'
        ] as $field=>$validator) {
            if (!is_string($field)) {
                $field = $validator;
                $validator = '';
            }
            if ($validator || isset($_POST[$field])) {
                $form->text($field,'',$validator);
            }
        }
        if ($page->parent) {
            $form->text('pathname','','required');
        }

        if ($form->validate()) {
            $form->fill($page);
            $page->save();

            if ($isNewPage && !empty($form->values['template'])) {
                $tpl_page = \LPCandy\Models\Page::find($form->values['template']);
                if ($tpl_page) {
                    if (in_array($tpl_page,$this->getPageTemplates())) {
                        $page->copyFromTemplate($tpl_page);
                        $page->save();
                    }
                }
            }
            echo json_encode([
                'id' => $page->id,
                'title' => $page->title,
            ]);
        } else {
            echo json_encode([
                'errors' => array_reduce($form->elements,function($res,$el){
                    if ($el->error) $res[$el->name] = $el->error;
                    return $res;
                },[])
            ]);
        }
    }

    function page_delete() {
        $page = $this->needOwnPage();
        $page->delete();
        echo json_encode(true);
    }

    function page_list() {
        $this->needUser();

        $res = [];
        $list = \LPCandy\Models\Page::findByUser($this->user);
        foreach ($list as $page) {
            $page->children = [];
            if (!$page->parent) $res[$page->id] = [
                'id' => $page->id,
                'title' => $page->title,
                'domain' => $page->domain,
                'screenshot_url' => $page->getScreenshotUrl(),
                'children' => []
            ];
        }
        foreach ($list as $page) {
            if ($page->parent) {
                $parent_id = $page->parent->getField('id');
                if (isset($res[$parent_id])) {
                    $res[$parent_id]['children'][] = [
                        'id' => $page->id,
                        'title' => $page->title,
                        'pathname' => $page->pathname,
                        'screenshot_url' => $page->getScreenshotUrl(),
                        'parent_id' => $page->parent->getField('id')
                    ];
                }
            }
        }
        echo json_encode(array_values($res));
    }

    function page_editor($id) {
        $page = \LPCandy\Models\Page::find($id);
        if (!$page) return; 

        $action = @$_POST['_type'];
        switch ($action) {
            case 'save':
                if ($page->user!=$this->user) return;
                $page->saveBlocks(json_decode($_POST['blocks'],true));
                break;

            case 'publish':
                if ($page->user!=$this->user) return;
                $page->publish(json_decode($_POST['blocks'],true),$_POST['html']);
                break;

            case 'entity-edit':
                $this->entity_edit($page);
                break;

            case 'email-send':
                $this->email_send($page);
                break;
        }
    }

    function upload($page=null) {
        if (!$this->user) return;
        
        $name = $_POST['name'];

        $uploadDir = INDEX_DIR."/upload/LPCandy/files/".$this->user->id;
        $uploadUrl = INDEX_URL."/upload/LPCandy/files/".$this->user->id;

        $res = array();
        if ($name && strpos($name,"..")===false) {

            $dir = $uploadDir."/".$name;
            $tdir = $uploadDir."/.thumbs/".$name;
            
            if (!file_exists($dir)) mkdir($dir,0777,true);
            if (!file_exists($tdir)) mkdir($tdir,0777,true);
            
            foreach ($_FILES as $key=>$val) {
                $error = $val['error'];
                if ($error==UPLOAD_ERR_OK) {
                    $name = $val['name'];
                    $tmp_name = $val['tmp_name']; 
                    
                    $info = pathinfo($name); 
                    if (!isset($info['extension'])) {
                        $res[] = array('error'=>_t('File is invalid'));
                        continue;
                    }

                    if (!in_array(strtolower($info['extension']), ["jpg","jpeg","png","gif"])) {
                        $res[] = array('error'=>_t('Wrong image format'));
                        continue;
                    }

                    $ext = ".".$info['extension'];
                    $filename = $info['filename'];
                    $dest = $filename.$ext; 
                    
                    if (file_exists("$dir/$dest")) {
                        $counter = 2;
                        do {
                           $dest = $filename."($counter)".$ext;
                           $counter++;
                        } while (file_exists("$dir/$dest"));
                    }
                    move_uploaded_file($tmp_name,"$dir/$dest");
                    $url = str_replace(INDEX_DIR,"",$dir."/".$dest);
                    
                    $res[] = array('name'=>$dest,'url'=>$url);
                } else {
                    if ($error == UPLOAD_ERR_FORM_SIZE || $error == UPLOAD_ERR_INI_SIZE) {
                        $res[] = array('error'=>str_replace('{max_size}',ini_get("upload_max_filesize"),_t('File is too large. Maximum upload size is {max_size}')));
                    } else if ($error == UPLOAD_ERR_NO_FILE) {
                        $res[] = array('error'=>_t("No file was uploaded"));
                    } else {
                        $res[] = array('error'=>_t("Upload error. Try again later"));
                    }
                }
            }
        }        
        echo json_encode($res);
    }

    function email_send($page=null) {
        $user = $page ? $page->user : $this->user;
        if (!$user) return;

        $subject = $_POST['subject'] ?? '';
        $text = $_POST['text'] ?? '';

        if (!$subject || !$text) return;

        $smtp = \Bingo\Config::get('config', 'smtp');
        $domain = \Bingo\Config::get('config', 'domain')[bingo_get_locale()];
        $mailer = new \PHPMailer();
        $mailer->isSMTP();
        $mailer->Host = $smtp['host'];
        $mailer->Port = $smtp['port'];
        $mailer->CharSet = 'utf-8';
        $mailer->setFrom('info@'.$domain, _t('LPCandy'));
        $mailer->Subject = $subject;
        $mailer->msgHTML($text);
        $mailer->addAddress($user->email, $user->name);

        if (!$mailer->send()) {
            trigger_error($mailer->ErrorInfo);
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    function entity_file() {
        $id = $_GET['id'] ?? 0;
        $name = $_GET['name'] ?? '';
        if (!$id || !$name) return;

        $entity = \LPCandy\Models\Entity::find($id);
        if (!$entity) return;

        $config = \Bingo\Config::get('config','entityTypes')[$entity->type] ?? false;
        if (!$config) return;

        $public_read = !empty($config['public_read']);
        if (!$public_read && $entity->user!=$this->user) return;

        $file = $entity->getFilePath($name);
        if (!$file || !file_exists($file)) return;
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$entity->getFileName($name));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);              
    }

    function entity_edit($page=null) {
        $type = $_POST['type'] ?? false;
        if (!$type) return;

        $config = \Bingo\Config::get('config','entityTypes')[$type] ?? false;
        if (!$config) return;

        $public = $page!=null;

        $public_read = !empty($config['public_read']);
        $public_edit = !empty($config['public_edit']);
        $public_create = !empty($config['public_create']);
        $upload = !empty($config['upload']);

        $id = $_POST['id'] ?? 0;
        if ($id) {
            $entity = \LPCandy\Models\Entity::find($id);
            if (!$entity) return;
            if ($entity->type!=$type) return;
            if (!$public && $entity->user!=$this->user) return;
        } else {
            $entity = null;
        }

        $data = $_POST;
        unset($data['id'],$data['type'],$data['_type']);
        
        if (!empty($data)) {
            if (!$entity) {
                $entity = new \LPCandy\Models\Entity;
                $entity->type = $type;
                $entity->ip = $_SERVER['REMOTE_ADDR'];

                if ($public && !$public_create) return;
                if ($public) {
                    $entity->page = $page;
                    $entity->user = $page->user;
                } else {
                    $entity->user = $this->user;
                }
                $entity->save();

            } else {
                if ($public && !$public_edit) return;
                if (!$public && $entity->user!=$this->user) return;
            }

            if ($upload) $entity->upload();

            foreach ($data as $key=>$val) {
                $field = \LPCandy\Models\EntityField::findOneBy(['entity'=>$entity,'name'=>$key]);
                if (!$field) {
                    $field = new \LPCandy\Models\EntityField;
                    $field->entity = $entity;
                }
                $field->name = $key;
                $field->value = $val;
                $field->save(false);
            }
            $entity->save();
            $this->em->flush();
        }
        
        $res = ['id'=>$entity->id];
        if (
            $entity && 
            (
                ($public && $public_read) ||
                (!$public && $entity->user==$this->user)
            )
        ) {
            $res = $this->entity_json($entity);
        }
        echo json_encode($res);
    }

    function entity_json($entity) {
        $res = [
            'id' => $entity->id,
            'ip' => $entity->ip,
            'created' => $entity->created->getTimestamp(),
            'page_id' => $entity->page ? $entity->page->id : false,
            'page_title' => $entity->page ? $entity->page->title : false,
            'files' => $entity->files
        ];
        if ($entity->fields)
            foreach ($entity->fields as $f) $res[$f->name] = $f->value;
        return $res;
    }

    function entity_delete() {
        $id = $_POST['id'] ?? 0;
        $entity = \LPCandy\Models\Entity::find($id);
        if (!$entity || $entity->user!=$this->user) return;
        $entity->delete();
        echo json_encode(true);
    }


    function entity_list() {
        $this->needUser();

        $type = $_POST['type'] ?? false;
        if (!$type) return;

        $qb = $this->em->createQueryBuilder();
        $qb->select("DISTINCT(e.id) as id");
        $qb->from("\LPCandy\Models\Entity","e");
        $qb->leftJoin("e.page","page");
        $qb->andWhere("e.user = :user")->setParameter("user",$this->user);
        $qb->andWhere("e.type = :type")->setParameter("type",$type);

        $ownFields = ['id','ip','page','created'];

        $filter = $_POST;
        unset($filter['p'],$filter['perPage'],$filter['user'],$filter['type'],$filter['sortBy'],$filter['sortOrder']);

        $p = 0;
        foreach ($filter as $key=>$val) {
            if (!$val) continue;

            if (is_array($val)) {
                $op = "IN";
            }
            else if (strpos($val,"LIKE ")===0) {
                $val = substr($val,5);
                $op = "LIKE";
            } 
            else {
                $op = "=";
            }

            $p++;
            if (in_array($key,$ownFields)) {
                $qb
                    ->andWhere("e.$key $op (:param_$p)")
                    ->setParameter("param_$p",$val)
                ;
            }
            else {
                $qb
                    ->leftJoin("e.fields","f_$p")
                    ->andWhere("f_$p.name = :param_name_$p AND f_$p.value $op :param_val_$p")
                    ->setParameter("param_name_$p",$key)
                    ->setParameter("param_val_$p",$val)
                ;
            }
        }

        $sortBy = $_POST['sortBy'] ?? 'id';
        $sortOrder = $_POST['sortOrder'] ?? "DESC";

        if (in_array($sortBy,$ownFields)) {
            if ($sortBy=="page") 
                $sortBy = "page.id";
            else
                $sortBy = "e.".$sortBy;
        }
        else {
            $qb->leftJoin("e.fields","sf");
            $qb->andWhere("sf.name = :sortBy")->setParameter("sortBy",$sortBy);
            $sortBy = "sf.value";
        }
        $qb->orderBy($sortBy,$sortOrder);

        if (isset($_POST['p'])) $page = (int)$_POST['p']; else $page = 1;if ($page<=1) $page = 1;
        $query = $qb->getQuery();
        $total = \DoctrineExtensions\Paginate\Paginate::getTotalQueryResults($query,true);
        $pagination = new \Bingo\Pagination($_POST['perPage'] ?? 10,$page,$total,false,$query);
        $ids = array_map(function($one){return $one['id'];},$pagination->result());

        $qb = $this->em->createQueryBuilder();
        $qb->select("e,f");
        $qb->from("\LPCandy\Models\Entity","e");
        $qb->leftJoin("e.fields","f");
        $qb->leftJoin("e.page","page");
        $qb->andWhere("e.id IN (:ids)");
        $qb->setParameter("ids",$ids);
        $res = $qb->getQuery()->getResult();

        $hash = [];
        foreach ($res as $e) $hash[$e->id] = $e;
        $entities = [];
        foreach ($ids as $id) if (isset($hash[$id])) $entities[] = $hash[$id];

        $list = [];
        foreach ($entities as $entity) {
            $list[] = $this->entity_json($entity);
        }

        echo json_encode([
            'list'=>$list,
            'pageCount'=>$pagination->getPageCount(),
            'pageNumber'=>$pagination->current
        ]);
    }
}