<?php

namespace LPExtra\Controllers;

class Projects extends \LPCandy\Controllers\Base {
    function __construct() {
        parent::__construct(true);
        if (!$this->user->hasAccess('project_editor')) redirect("/");
    }

    function project_list() {
        $list = \LPExtra\Models\Project::findBy(array('user'=>$this->user));
        
        $this->data['fields'] = array(
            'id' => _t('#'),
            'title' => _t('title')
        );
        $this->data['item_actions']['project-edit'] = _t('Edit project');
        
        $this->data['list'] = $list;
        
        $this->data['title'] = _t("Projects");
        $this->data['page_actions']['project-edit'] = _t('Create New Project');
        $this->view('lpcandy/base-list');
    }
    
    function project_edit($id) {
        $p = \LPExtra\Models\Project::findOrCreate($id);
        if ($p->id && $p->user!=$this->user) redirect("/");
        
        $form = new \Bingo\Form;
        $form->fieldset();
        $form->text('title',_t('Title'),'required',$p->title);
        $form->text("data[thumb]",_t("Thumbnail"),'',@$p->data['thumb'])->add_class("browse_file image");
        $form->textarea('excerpt',_t('Excerpt'),'',$p->excerpt,array('rows'=>15))->addClass('tinymce');
        $form->textarea('content',_t('Content'),'',$p->content,array('rows'=>35))->addClass('tinymce');

        $form->fieldset();
        $form->submit(_t('Save project'));
        
        $this->data['title'] = _t('Edit project');
        
        if ($form->validate()) {
            $form->fill($p);
            $p->user = $this->user;
            $p->save();
            redirect('project-list');
        }
        
        $this->data['form'] = $form->get();
        $this->view('lpcandy/base-edit-tinymce');
    }
}