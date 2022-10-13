<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function getOrders()
    {
        $orders = auth()->user()->orders;
        $orderLists = $orders->sortByDesc("id");
        return view('site.pages.account.orders', compact('orderLists'));
    }
}