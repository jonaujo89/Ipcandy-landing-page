<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_identities")
*/
class Identity extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /** @Column(length=1024) */
    public $identity;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="identities")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;
}