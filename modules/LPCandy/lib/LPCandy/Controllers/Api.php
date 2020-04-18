<?php

namespace LPCandy\Controllers;

class Api extends \CMS\Controllers\Admin\Base {
    function __construct() {
        parent::__construct();
        $this->user = \LPCandy\Models\User::checkLoggedIn();
        bingo_domain('lpcandy');
    }    
    
    function needUser() {
        if (!$this->user) { echo _t("Invalid auth"); die(); }
    }

    function needOwnPage() {
        $this->needUser();
        
        $id = $_POST['id'] ?? false;
        $page = \LPCandy\Models\Page::find($id);
        if (!$page || $page->user!=$this->user)  {
            echo json_encode([
                'errors' => ['*' => _t('Invalid page')]
            ]);
            die();
        }
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
        $this->auth();
    }

    function getPageTemplates() {
        $tpl_pages = [];
        $default_page = \LPCandy\Models\Page::findOneByDomain('default');
        if ($default_page) $tpl_pages[] = $default_page;
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
        if (!$page || $page->user!=$this->user) return;

        $action = @$_POST['_type'];
        switch ($action) {
            case 'save':
                $page->saveBlocks(json_decode($_POST['blocks'],true));
                break;

            case 'publish':
                $page->publish(json_decode($_POST['blocks'],true),$_POST['html']);
                break;

            case 'upload':
                $res = $page->upload($_POST['name'],$_POST['iconWidth'],$_POST['iconHeight']);
                echo json_encode($res);
                break;
        }
    }
}