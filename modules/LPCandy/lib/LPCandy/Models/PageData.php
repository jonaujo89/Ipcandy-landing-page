<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_pagedata")
*/
class PageData extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(type="object") */
    public $custom_fields;
    
    /**
     * @ManyToOne(targetEntity="Page")
     * @JoinColumn(name="page_id", referencedColumnName="id")
     */
    public $page;    
}