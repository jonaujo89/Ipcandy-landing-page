<?php

namespace LPCandy\Controllers;

class Developer extends \CMS\Controllers\Admin\BasePrivate {
    function import_tracks() {
        $result = $this->em->getConnection()->executeQuery("
            SELECT *
            FROM lp_tracking
        ")->fetchAll();
        
        $counter = 0;
        foreach ($result as $one) {
            $entity = new \LPCandy\Models\Entity;
            $entity->type = 'track';
            $entity->ip = $one['ip'];
            $entity->page = \LPCandy\Models\Page::find($one['page_id']) ?: null;
            $entity->user = \LPCandy\Models\User::find($one['user_id']) ?: null;
            $entity->save();

            $files = [];
            $data = unserialize($one['data']);
            $values = [];
            foreach ($data['values'] ?? [] as $value) {
                if (is_array($value['value'])) {
                    $destDir = APP_DIR."/upload/LPCandy/entity/".$one['user_id'];
                    if (!file_exists($destDir)) mkdir($destDir,0777,true);
                    foreach ($value['value'] as $key => $file) {
                        rename(APP_DIR."/upload/LPCandy/track/".$one['id'].'/'.$file['dest'], $destDir.'/'.$file['dest']);
                        $files['file-'.$key] = [$file['src'], $file['dest']];
                    }
                    $value['value'] = array_keys($files);
                }
                $values[] = $value;
            }
            $entity->files = $files;
            $entity->save();

            foreach (['form' => json_encode($values), 'status' => $one['status']] as $key => $value) {
                $field = new \LPCandy\Models\EntityField;
                $field->entity = $entity;
                $field->name = $key;
                $field->value = $value;
                $field->save();
            }
            
            
            if (++$counter % 20 == 0) {
                $this->em->clear();
            }
        }

        echo 'Импортировано '.$counter.' треков';
    }
}