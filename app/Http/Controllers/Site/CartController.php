<?php

namespace App\Http\Controllers\Site;

use Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Traits\UploadAble;
class CartController extends BaseController
{
    use UploadAble;
    public function getCart()
    {
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
