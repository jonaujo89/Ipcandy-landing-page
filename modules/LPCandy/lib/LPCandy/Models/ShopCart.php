<?php

namespace LPCandy\Models;

class ShopCart {

    private $user;
    public $products;

    function __construct($user) {
        $session = new \Session\SessionNamespace('Shop');
        $this->user = $user;
        $this->products = [];
        
        if ($session->cart && !empty($session->cart)) {
            $this->products = \LPCandy\Models\ShopProduct::findBy(['id' => $session->cart]);
        }
    }

    function add($product) {
        if (in_array($product, $this->products)) return;
        $this->products[] = $product;
        $this->save();
    }

    function remove($product) {
        if (($key = array_search($product, $this->products)) !== false) {
            unset($this->products[$key]);
        }
        $this->save();
    }

    function setEmpty() {
        $this->products = [];
        $this->save();
    }

    function save() {
        $session = new \Session\SessionNamespace('Shop');
        $productIds = [];
        foreach($this->products as $product) {
            $productIds[] = $product->id;
        }
        $session->cart = $productIds;
        $session->count = $this->getCount();
        $session->total = $this->getTotal();
    }

    function getProducts() {
        $products = [];
        foreach ($this->products as $product) {
            $products[] = $product->getJSON($this->user);
        }
        return $products;
    }

    function getCount() {
        return count($this->products);
    }

    function getTotal() {
        $sum = 0;
        foreach ($this->products as $item) {
            $sum += $item->price;
        }
        return $sum;
    }
}
