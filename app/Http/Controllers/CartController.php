<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\RedisJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function add($product)
    {
        $cartItems = DB::table('users')->where('id', auth()->id())->value('cartitems');

        if ($cartItems == NULL) {
            $cartItems = " " . $product;
        } else {
            $cartItems = $cartItems . " " . $product;
        }

        $update_cart = DB::table('users')
            ->where('id', auth()->id())
            ->update(['cartitems' => $cartItems]);

        return Redirect()->back()->with('message', 'Item added to cart');
    }
    public function index()
    {
        $cartItemsQuery = DB::table('users')->where('id', auth()->id())->value('cartitems');    //query to take cart item colum
        $cartItemsArray = preg_split('/\s+/', $cartItemsQuery); //split cart items id in an array (way 1:slower but have multiple lines)
        // $cartItemsArray = explode(" ", $cartItemsQuery);     //split cart items id in an array (way 2:faster)
        $itemCount = count($cartItemsArray) - 1;             //count number of cart items


        //-----handle if duplicate items are added to cart. ---- memorize the counter
        $itemOccurrence = [];
        foreach ($cartItemsArray as $cart) {
            if (!isset($itemOccurrence[$cart])) {
                $itemOccurrence[$cart] = 0;
            }

            $itemOccurrence[$cart]++;
        }
        //-------------------------------------


        //Fetch products using cart items id
        $cartItems = DB::table('products')->whereIn('id', $cartItemsArray)->get();
        //----------------------------------

        return view('cart.index', compact('itemCount', 'cartItems', 'itemOccurrence'));
    }

    public function update($itemId, $itemOccur)
    {
        if ($itemOccur == 'i') {
            $cartItems = DB::table('users')->where('id', auth()->id())->value('cartitems');

            if ($cartItems == NULL) {
                $cartItems = " " . $itemId;
            } else {
                $cartItems = $cartItems . " " . $itemId;
            }

            $update_cart = DB::table('users')
                ->where('id', auth()->id())
                ->update(['cartitems' => $cartItems]);

            return Redirect()->back();
        } else {
            $cartItemsQuery = DB::table('users')->where('id', auth()->id())->value('cartitems');
            $cartItemsArray = explode(" ", $cartItemsQuery);

            $cartItems = NULL;
            $flag = 0;
            for ($i = 1; $i < count($cartItemsArray); $i++) {
                if (($cartItemsArray[$i] != $itemId) || ($flag == 1)) {
                    $cartItems = $cartItems . " " . $cartItemsArray[$i];
                }
                if ($cartItemsArray[$i] == $itemId) {
                    $flag = 1;
                }
            }

            $update_cart = DB::table('users')
                ->where('id', auth()->id())
                ->update(['cartitems' => $cartItems]);


            return back();
        }
    }

    public function destroy($itemId)
    {
        $cartItemsQuery = DB::table('users')->where('id', auth()->id())->value('cartitems');    //query to take cart item colum
        $cartItemsArray = explode(" ", $cartItemsQuery);

        $cartItems = NULL;

        for ($i = 1; $i < count($cartItemsArray); $i++) {
            if ($cartItemsArray[$i] != $itemId) {
                $cartItems = $cartItems . " " . $cartItemsArray[$i];
            }
        }

        $update_cart = DB::table('users')
            ->where('id', auth()->id())
            ->update(['cartitems' => $cartItems]);


        return back();
    }

    public function checkout()
    {
        return view('cart.checkout');
    }
}
