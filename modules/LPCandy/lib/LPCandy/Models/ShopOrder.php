<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_shop_orders")
*/
class ShopOrder extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(type="array") */
    public $products;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /** @Column(type="datetime") */
    public $created;

    /** @Column(type="boolean") */
    public $is_paid = false;

    function __construct() {
        $this->created = new \DateTime();
    }
};