<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Product;
use App\Traits\UploadAble;
class CartController extends BaseController
{
    use UploadAble;
    public function getCart()
    {
        $carts =  \Cart::getContent();

        $cartLists = $carts->unique(function ($item) {
                    return $item['name'].$item['price'];
                });

        $cartLists->all();
        $cartValues =  $carts->groupBy('name');
        $newCart = [];
        foreach($cartValues as $key => $cart){
            $qty[] = $cart->sum('quantity');
            $art = [
                'name' => $cart[0]['name'],
                'price' => $cart[0]['price'],
                'quantity' => $cart->sum('quantity'),
            ];

            array_push($newCart, $art);

        }
        // return view('site.pages.cart', compact('cartLists'));
        // $total = Cart::getTotalQuantity();
        return view('site.pages.cart');
    }

    public function removeItem($id)
    {
        Cart::remove($id);

        if (Cart::isEmpty()) {
            return redirect('/');
        }
        return $this->responseRedirectBack('Item removed from cart successfully', 'success', false, false);
    }

    public function clearCart()
    {
        Cart::clear();

        return $this->responseRedirectBack('All Cart clear successfully', 'success', false, false);
    }
}
