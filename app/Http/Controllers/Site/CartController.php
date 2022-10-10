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
        $cartValues =  $carts->groupBy('name');
        $cartLists = [];
        foreach($cartValues as $key => $cart){
            $qty[] = $cart->sum('quantity');
            $newCart = [
                'id'   => $cart[0]['id'],
                'name' => $cart[0]['name'],
                'price' => $cart[0]['price'],
                'quantity' => $cart->sum('quantity'),
                'attributes'=> $cart[0]['attributes'],
                'conditions'  => $cart[0]['conditions']
            ];
            array_push($cartLists, $newCart);
        }
        return view('site.pages.cart', compact('cartLists'));

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
