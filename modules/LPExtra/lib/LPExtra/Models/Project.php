<?php

namespace LPExtra\Models;

/**
* @Entity
* @Table(name="lp_projects")
*/
class Project extends \ActiveEntity {
    
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id;
    
    /** @Column(length=1024) */
    protected $title;
    
    /** @Column(type="text") */
    protected $content;
    
    /** @Column(type="text") */
    protected $excerpt;
    
    /** @Column(type="datetime") */
    protected $date;
    
    /** @Column(type="datetime") */
    protected $modified;

    /** @Column(length=128) */
    protected $type;
    
    /** @Column(type="integer") */
    protected $item_order;
    
    /** @Column(type="array") */
    protected $data;

    /**
     * @ManyToOne(targetEntity="\LPCandy\Models\User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;
    
    function __construct() {
        $this->type = "post";
        $this->data = array();
        $this->date = new \DateTime("now");
        $this->modified = $this->date;
        $this->item_order = 0;
        $this->content = "";
        $this->hidden = false;
        $this->excerpt = "";
    }
}