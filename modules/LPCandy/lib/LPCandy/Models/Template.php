<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_templates")
*/
class Template extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(type="object") */
    public $form;    

    /** @Column(length=1024) */
    public $name; 
    
    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    
}