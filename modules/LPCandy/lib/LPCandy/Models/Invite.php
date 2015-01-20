<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_invites")
*/
class Invite extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(length=1024) */
    public $code;
  
    /**
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;
    
    function __construct() {
        $this->code = "";
    }
    
    static function generate() {
        while (true) {
            $invite = new \LPCandy\Models\Invite();
            $invite->code = "lpcandy_invite_".md5(uniqid("",1)); 
            
            $other = self::findByCode($invite->code);
            if (count($other)==0) return $invite;
        }
    }
}