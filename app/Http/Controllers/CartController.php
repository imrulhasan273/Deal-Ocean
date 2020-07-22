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


        return Redirect()->back();
    }
    public function index()
    {

        $cartItemsQuery = DB::table('users')->where('id', auth()->id())->value('cartitems');    //query to take cart item colum
        // $res = preg_split('/\s+/', $cartItemsQuery); //split cart items id in an array (way 1:slower but have multiple lines)
        $cartItemsArray = explode(" ", $cartItemsQuery);     //split cart items id in an array (way 2:faster)
        $itemCount = count($cartItemsArray) - 1;             //count number of cart items
        //-------------------

        // foreach ($cartItemsArray as $x => $x_value) {
        //     echo "Key=" . $x . ", Value=" . $x_value;
        //     echo "<br>";
        // }



        //Fetch products using cart items id
        $cartItems = DB::table('products')->whereIn('id', $cartItemsArray)->get();
        //----------------------------------


        return view('cart.index', compact('itemCount', 'cartItems'));
    }
    public function checkout()
    {
        return view('cart.checkout');
    }
}
