<?php

class LPForms extends \Bingo\Module {
    function __construct() {
        $this->addModelPath(dirname(__FILE__).'/LPForms/Models');
        $this->connect('forms',array('controller'=>'LPForms\Controllers\Profile','action'=>'forms'));
        
        \Bingo\Action::add('admin_menu',function($menu,$user){
            if ($user)
                $menu[] = array('url'=>'forms','label'=>'Forms');
            return $menu;
        },10,2);
        
        $forms = array();
        $registerElements = function (&$form,$cmp) use (&$registerElements) {
            foreach ($cmp->children as $ch) {
                if ($ch->value->type=="form_text") {
                    $form[] = $ch;
                }
                if ($ch->value->type != $form)
                    $registerElements(&$form,$ch);
            }
        };
        
        \Bingo\Action::add('lp_register_component',function($cmp) use (&$forms,&$registerElements) {
            if ($cmp->value->type=='form') {
                $form = array();
                $registerElements(&$form,$cmp);
                $forms[$cmp->value->id] = &$form;
            }
            
        });
        
        \Bingo\Action::add('lp_components',function($components) use (&$forms) {
            
            $page = \LPCandy\Models\Page::find(Component::$api->page_id);
            
            $old_update = $components['form']['update'];
            $components['form']['update'] = function ($val) use ($page,&$forms,&$old_update) {
                $message = '';
                if (isset($_POST['form_id']) && $_POST['form_id']==$val['id']) {
                    $track = new \LPForms\Models\Track;
                    $track->form = $val['id'];
                    $track->user = $page->user;
                    
                    $form = &$forms[$val['id']];
                    if ($form) foreach ($form as $cmp) {
                        if ($cmp->value->name) {
                            $track->data[] = array(
                                'component' => (object)(array)$cmp,
                                'value' => @$_POST[$cmp->value->name]
                            );
                        }
                    }
                    $track->save();
                    $message = @$val['success'] ?: _t('Data was successfully submitted');
                    $message = "<div class='alert success'>".$message."</div>";
                }
                
                $ret = $old_update($val);
                $ret['html'] = '<div><form method="POST">'.$message.'
                    <input type="hidden" name="form_id" value="'.$val['id'].'">
                    <br class="component-area" /></form>
                </div>';
                return $ret;
            };
            return $components;
        });
    }
}