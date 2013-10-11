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

    static public function login_token($token) {
        $response = file_get_contents("http://loginza.ru/api/authinfo?token=$token");
        $data = json_decode($response);

        if (!isset($data->identity)) return false;
        $identity = Identity::findOneByIdentity($data->identity);
        if (!$identity) {
            $identity = new Identity();
            $identity->identity = $data->identity;
            $user = new User();
            $user->email = @$data->email ? : "";
            $user->login = $data->identity;
            $user->name = @$data->nickname ? : "";
            if (!$user->name) {
                if (isset($data->name)) {
                    $user->name = @$data->name->first_name." ".@$data->name->last_name;
                }
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
}