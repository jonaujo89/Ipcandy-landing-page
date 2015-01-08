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
    /** @Column(type="integer") */ 
    public $status;
        /*
        0 - new order
        1 - order to work
        2 - order is complete
        3 - order is canceled
        */
    
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