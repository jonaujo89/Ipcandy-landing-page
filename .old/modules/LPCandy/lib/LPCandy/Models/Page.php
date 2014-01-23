<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_pages")
*/
class Page extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(length=256) */
    public $title;    
    
    /**
     * @ManyToOne(targetEntity="Template")
     * @JoinColumn(name="template_id", referencedColumnName="id")
     */
    public $template; 
    
    /** @Column(type="integer") */
    public $template_id;
    
    /** @Column(length=1024) */
    public $domain; 
    
    /** @Column(type="object") */
    public $custom_fields;
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    
    
    function __construct() {
        $this->domain = "";
    }
    
    function getViewTemplate() {
        return $this->template ? $this->template->getField('name') : 'page-'.$this->id;
    }
}