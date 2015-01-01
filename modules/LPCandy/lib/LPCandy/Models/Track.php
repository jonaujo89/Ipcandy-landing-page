<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_tracking")
*/
class Track extends \DoctrineExtensions\ActiveEntity\ActiveEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    /** @Column(type="array") */
    public $data;
    /** @Column(type="datetime") */
    public $date;
    /** @Column(length=128) */
    public $form;
    
    /**
     * @ManyToOne(targetEntity="LPCandy\Models\User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;    

    function __construct() {
        $this->date = new \DateTime();
        $this->data = array();
    }
}