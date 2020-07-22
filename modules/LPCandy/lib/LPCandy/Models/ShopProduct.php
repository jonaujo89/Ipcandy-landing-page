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

    /**
     * @ManyToMany(targetEntity="ShopOrder", mappedBy="products")
     */
    public $orders;
    
    /** @Column(length=256) */
    public $title_ru;
    
    /** @Column(length=256) */
    public $title_en;
       
    /** @Column(type="string") */
    public $excerpt_ru;

    /** @Column(type="string") */
    public $excerpt_en;

    /** @Column(type="text") */
    public $description_ru;

    /** @Column(type="text") */
    public $description_en;

    /** @Column(type="string") */
    public $thumbnail;

    /** @Column(length=32) */
    public $price;

    /** @Column(type="string") */
    public $js_path;

    /** @Column(type="string") */
    public $css_path;

    function getThumbnailUrl($w=258,$h=193) {
        if (!$this->thumbnail) return false;
        $file = $this->thumbnail;
        if (!file_exists(INDEX_DIR."/upload/CMS/files/$file")) return false;
        return \Bingo\ImageResizer::get_url($file,$w,$h,array(255,255,255));
    }

    function getJsUrl() {
        return url("upload/CMS/shop_products/".$this->js_path);
    }

    function getCssUrl() {
        return url("upload/CMS/shop_products/".$this->css_path);
    }

    static function _t($list) {
        $suff = (bingo_get_locale()=='en_EN') ? 'en' : 'ru';
        
        if (!is_array($list)) {
            $list = [$list];
            $is_array = false;
        } else $is_array = true;

        
        foreach ($list as $one) {
            $one->title = $one->{"title_$suff"};
            $one->excerpt = $one->{"excerpt_$suff"};
            $one->description = $one->{"description_$suff"};
        }

        return $is_array? $list: $list[0];
    }
    
    function getJSON($user) {
        self::_t($this);
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