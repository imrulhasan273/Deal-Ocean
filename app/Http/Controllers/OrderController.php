<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //--all the items in cart including double item
        $cartItemsQuery = DB::table('users')->where('id', auth()->id())->value('cartitems');
        $cartItemsArray = preg_split('/\s+/', $cartItemsQuery);
        $itemCount = count($cartItemsArray) - 1;
        //--

        //--All the distinct items with occurance
        $itemOccurrence = [];
        foreach ($cartItemsArray as $cart) {
            if (!isset($itemOccurrence[$cart])) {
                $itemOccurrence[$cart] = 0;
            }
            $itemOccurrence[$cart]++;
        }
        //--

        //--All the items details from database
        $cartItems = DB::table('products')->whereIn('id', $cartItemsArray)->get();
        //--

        //--total price
        $totalPrice = 0;
        foreach ($cartItems  as $item) {
            $totalPrice += ($item->price * $itemOccurrence[$item->id]);
        }
        $couponDiscount = DB::table('users')->where('id', auth()->id())->value('discount');
        $discountPrice = (($couponDiscount * $totalPrice) / 100);
        $totalPrice = $totalPrice - $discountPrice;
        //---



        $request->validate([
            'billing_fullname' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_address' => 'required',
            'billing_phone' => 'required',
            'billing_zipcode' => 'required',

            'payment_method' => 'required',
        ]);

        if ($request->shipping_check == 'on') {
            $request->validate([
                'shipping_fullname' => 'required',
                'shipping_state' => 'required',
                'shipping_city' => 'required',
                'shipping_address' => 'required',
                'shipping_phone' => 'required',
                'shipping_zipcode' => 'required',
            ]);
        }

        $order = new Order();
        $order->order_number = uniqid('OrderNumber-');

        $order->billing_fullname = $request->input('billing_fullname');
        $order->billing_state = $request->input('billing_state');
        $order->billing_city = $request->input('billing_city');
        $order->billing_address = $request->input('billing_address');
        $order->billing_phone = $request->input('billing_phone');
        $order->billing_zipcode = $request->input('billing_zipcode');

        $order->payment_method = $request->input('payment_method');
        $order->notes = $request->input('order_note');

        if ($request->shipping_check == 'on') {

            $order->shipping_fullname = $request->input('shipping_fullname');
            $order->shipping_state = $request->input('shipping_state');
            $order->shipping_city = $request->input('shipping_city');
            $order->shipping_address = $request->input('shipping_address');
            $order->shipping_phone = $request->input('shipping_phone');
            $order->shipping_zipcode = $request->input('shipping_zipcode');
        } else {
            $order->shipping_fullname = $request->input('billing_fullname');
            $order->shipping_state = $request->input('billing_state');
            $order->shipping_city = $request->input('billing_city');
            $order->shipping_address = $request->input('billing_address');
            $order->shipping_phone = $request->input('billing_phone');
            $order->shipping_zipcode = $request->input('billing_zipcode');
        }

        $order->grand_total = $totalPrice;
        $order->item_count = $itemCount;
        $order->user_id = auth()->id();
        $order->save();

        //Add all the products in order_product table which is pivot table
        foreach ($cartItems as $item) {
            $dPrice = floatval(($couponDiscount * $item->price) / 100);
            $item->price = $item->price - $dPrice;
            $order->product()->attach($item->id, ['price' => $item->price, 'quantity' => $itemOccurrence[$item->id]]);
        }

        return Redirect::route('home');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
