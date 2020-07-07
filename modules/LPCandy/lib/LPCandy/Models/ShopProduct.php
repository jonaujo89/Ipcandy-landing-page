<?php

namespace LPCandy\Models;

/**
* @Entity
* @Table(name="lp_shop_products")
*/
class ShopProduct extends \DoctrineExtensions\ActiveEntity\ActiveEntity {
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    public $id;
    
    /** @Column(length=256) */
    public $title;    
       
    /** @Column(type="string") */
    public $excerpt;

    /** @Column(type="text") */
    public $description;

    /** @Column(type="string") */
    public $thumbnail;

    /** @Column(length=32) */
    public $price;

    /** @Column(type="string") */
    public $js_path;

    /** @Column(type="string") */
    public $css_path;

    function getThumbnailUrl($w=false,$h=false) {
        if (!$this->thumbnail) return false;
        $file = $this->thumbnail;
        if (!file_exists(INDEX_DIR."/upload/CMS/files/$file")) return false;
        if ($w && $h) {
            return \Bingo\ImageResizer::get_url($file,$w,$h,array(255,255,255));
        } else {
            return url("/upload/CMS/files/".$file);
        }
    }

    function getJsUrl() {
        return url("upload/CMS/files/".$this->js_path);
    }

    function getCssUrl() {
        return url("upload/CMS/files/".$this->css_path);
    }

    function getJSON($user) {
        return [
            'id'           => $this->id,
            'type'         => $this->type,
            'title'        => $this->title,
            'excerpt'      => $this->excerpt,
            'description'  => $this->description,
            'thumbnail'    => $this->getThumbnailUrl(),
            'price'        => $this->price,
            'created'      => $this->created,
            'isBought'     => in_array($this, $user->getBoughtProducts()),
            'js_url'       => $this->getJsUrl(),
            'css_url'      => $this->getCssUrl()
        ];
    }
};