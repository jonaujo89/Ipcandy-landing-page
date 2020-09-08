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
    
    /**
     * @ManyToMany(targetEntity="ShopProduct", inversedBy="orders")
     * @JoinTable(name="lp_orders_products", joinColumns={@JoinColumn(name="order_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="product_id", referencedColumnName="id")}
     * ))
     */
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

    /** @Column(type="float") */
    public $total;

    function __construct() {
        $this->created = new \DateTime();
    }
};