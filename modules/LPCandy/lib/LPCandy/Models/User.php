<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_users")
*/
class User extends \Auth\Models\User {

    /**
     * @OneToMany(targetEntity="Identity", mappedBy="user")
     */
    public $identities;

    /** @Column(length=128) */
    public $name;
    /** @Column(length=128) */
    public $phone;
    /** @Column(length=128) */
    public $city;
    /** @Column(length=512) */
    public $address;
    /** @Column(length=1024) */
    public $address_extra;
    
    static public function token_data($token) {
        $response = file_get_contents('https://ulogin.ru/token.php?token=' . $token . '&host=' . $_SERVER['HTTP_HOST']);
        $data = json_decode($response);
        if (!isset($data->identity)) return false;
        return $data;
    }

    static public function login_token($data,$createUser=true) {
        if (!$data) return null;
        $identity = Identity::findOneByIdentity($data->identity);
        if (!$identity && !$createUser) return null;
        if (!$identity) {
            $identity = new Identity();
            $identity->identity = $data->identity;
            $user = new User();
            $user->email = @$data->email ? : "";
            $user->login = $data->identity;
            $user->name = @$data->name ? : "";
            if (!$user->name) {
                $user->name = @$data->first_name.' '.@$data->last_name;
                $user->name = trim($user->name);
            }
            if (!$user->name) $user->name = "Неизвестное имя";
            $user->phone = "";
            $user->city = "";
            $user->address = "";
            $user->address_extra = "";
            $user->password = md5(uniqid());
            $user->save(false);

            $identity->user = $user;
            $identity->save();
        }
        $identity->user->getField('id');
        User::generateSecret($identity->user);
        return $identity->user;
    }
    
    function hasAccess($resource) {
        $groups = \Bingo\Config::get('config','acl')?:array();
        foreach ($groups as $group) {
            if (in_array($this->id,$group['users']) && in_array($resource,$group['res'])) return true;
        }
        return false;
    }

    function getCart() {
        return new \LPCandy\Models\ShopCart($this);
    }

    private $boughtProductsCache = [];

    public function getBoughtProducts($includeCart=false) {
        if (!isset($this->boughtProducts[$includeCart])) {
            $res = self::$entityManager->createQuery(" 
                SELECT o.products 
                FROM \LPCandy\Models\ShopOrder o 
                WHERE o.user = :user AND o.is_paid = :is_paid 
            ") 
                ->setParameter('is_paid', true) 
                ->setParameter('user', $this) 
                ->getResult(); 
 
            $products = []; 
            foreach($res as $one) { 
                $products = array_merge($products, $one['products']); 
            }

            if ($includeCart) $products = array_merge($products, $this->getCart()->products);
            $this->boughtProductsCache[$includeCart] = $products;
        }
        return $this->boughtProductsCache[$includeCart];
    }
}