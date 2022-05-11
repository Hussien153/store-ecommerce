<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $items = [];
    public $totalQuantity;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if($cart) {
            $this->items = $cart->items;
            $this->totalQuantity = $cart->totalQuantity;
            $this->totalPrice = $cart->totalPrice;
        } else {
            $this->items = [];
            $this->totalQuantity = 0;
            $this->totalPrice = 0;
        }
    }

    public function add($product)
    {
        $item = [
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'qty' => 0,
            'image' => $product->image,

        ];

        if (!array_key_exists($product->id, $this->items)) {
            $this->items[$product->id] = $item;
            $this->totalQuantity +=1;
            $this->totalPrice += $product->price;
        } else {
            $this->totalQuantity +=1;
            $this->totalPrice += $product->price;
        }

        $this->items[$product->id]['qty']  += 1 ;

    }

    public function remove($id) {

        if (array_key_exists($id, $this->items)) {
            $this->totalQuantity -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            unset($this->items[$id]);
        }

    }

    public function updateQuantity($id, $qty) {
        // reset quantity and price in the cart.
        $this->totalQuantity -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'] * $this->items[$id]['qty'];

        // here we add item with new quanitity
        $this->items[$id]['qty'] = $qty;

        //total price and total quanitity in cart
        $this->totalQuantity += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;

    }
   // use HasFactory;
}
