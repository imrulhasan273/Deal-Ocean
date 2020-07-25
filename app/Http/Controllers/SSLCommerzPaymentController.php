<?php

namespace App\Http\Controllers;

use Session;
use App\Order;
use App\Payment;
use App\Mail\OrderPaid;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Session\Middleware\StartSession;

session_start();
class SSLCommerzPaymentController extends Controller
{
    public function index(Request $request, $ordId)
    {
        $post_data = array();

        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10

        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = now(); // tran_id must be unique

        #-----Here We take the orderId into $post_data to pass it on success function
        $post_data['order_id'] = $ordId;
        $_SESSION['payment_values']['order_id'] = $post_data['order_id'];
        #----------------------------------------------------------------------------

        #Start to save these value  in session to pick in success page.
        $_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
        #End to save these value  in session to pick in success page.

        $server_name = $request->root() . "/";
        $post_data['success_url'] = $server_name . "success";
        $post_data['fail_url'] = $server_name . "fail";
        $post_data['cancel_url'] = $server_name . "cancel";

        // dd($post_data);

        $sslc = new SSLCommerz();
        // dd($sslc);
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->initiate($post_data, false);

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $payment_method = $request->card_issuer;
        $transId        = $request->bank_tran_id;
        $storeId        = $request->store_id;

        // echo "Transaction is Successful";

        $update_product = DB::table('orders')
            ->where('id', $_SESSION['payment_values']['order_id'])
            ->update([
                'is_paid' => '1',
                'payment_method' => $payment_method,
                'transection_id' => $transId,
                'store_id'       => $storeId,
                'status'         => 'processing'
            ]);

        //reset cart
        $update_cart = DB::table('users')
            ->where('id', auth()->id())
            ->update([
                'cartitems' => '',
                'discount' => 0
            ]);

        #send email to customer
        $order = Order::find($_SESSION['payment_values']['order_id']);
        Mail::to($order->user->email)->send(new OrderPaid($order));
        #---

        return redirect(route('home'))->with('message', 'Order with Transaction successful');
    }

    public function fail(Request $request)
    {
        $payment_method = $request->card_issuer;

        $update_product = DB::table('orders')
            ->where('id', $_SESSION['payment_values']['temp'])
            ->update([
                'is_paid' => '0',
                'payment_method' => $payment_method,
                'status'  => 'failed'
            ]);



        return redirect(route('home'))->with('error', 'Transaction Unsuccessful');
    }

    public function cancel(Request $request)
    {
        $update_product = DB::table('orders')
            ->where('id', $_SESSION['payment_values']['temp'])
            ->update([
                'is_paid' => '0',
                'status'  => 'canceled'
            ]);

        return redirect(route('home'))->with('error', 'Order has been Canceled');
    }
    public function ipn(Request $request)
    {
        //...
    }
}
