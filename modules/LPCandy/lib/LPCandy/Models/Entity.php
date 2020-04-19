<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_entity")
*/
class Entity extends \ActiveEntity
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /** @Column(length=128) */ 
    public $type;
    
    /** @Column(type="datetime") */
    public $created;
    
    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /**
     * @ManyToOne(targetEntity="Page")
     * @JoinColumn(name="page_id", referencedColumnName="id",onDelete="SET NULL")
     */
    public $page;  

    /** @Column(length=128) */ 
    public $ip;    

    /** @Column(type="array") */
    public $files;

    /**
     * @OneToMany(targetEntity="EntityField", mappedBy="entity")
     */
    public $fields;

    function __construct() {
        $this->created = new \DateTime();
        $this->files = [];
    }

    function getFilePath($name) {
        $file = $this->files[$name] ?? false;
        if (!$file) return false;
        return APP_DIR."/upload/LPCandy/entity/".$this->user->id."/".$file[1];
    }

    function getFileName($name) {
        $file = $this->files[$name] ?? false;
        if (!$file) return false;
        return $file[0];
    }

    function upload() {
        $dir = APP_DIR."/upload/LPCandy/entity/".$this->user->id;
        if (!file_exists($dir)) mkdir($dir,0777,true);
        foreach ($_FILES as $key=>$file) {
            if ($file['error']==UPLOAD_ERR_OK) {
                $info = pathinfo($file['name']);
                $dest = uniqid().".".$info['extension'];
                move_uploaded_file($file['tmp_name'],"$dir/$dest");
                $this->files[$key] = [
                    $file['name'],
                    $dest
                ];
            }
        }
        $this->save();
    }
}