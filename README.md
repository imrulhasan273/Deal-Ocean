# **Deal Ocean**

---

# Project Method

---

## SDLC Approach

---

# **Schema Diagram**

---

![](MARKDOWN_NOTES/ER.png)

---

# Model | Migration | Controller | Policy | Observer

| Models     | Migrations       | Controllers          | Policies | Observers | Seed              |
| ---------- | ---------------- | -------------------- | -------- | --------- | ----------------- |
| -          | -                | Dashboard            | -        | -         | -                 |
| -          | -                | -                    | -        | -         | SuperAdminSeeder  |
| User       | users            | UserController       |          |           |                   |
| Shop       | shops            | ShopController       |          |           |                   |
| Location   | locations        | LocationController   |          |           |                   |
| Country    | countries        | CountryController    |          |           |                   |
| Region     | regions          | RegionController     |          |           |                   |
| Role       | roles            | RoleController       |          |           |                   |
|            | role_user        |                      |          |           |                   |
| Permission | permissions      | PermissionController |          |           |                   |
| -          | permission_role  |                      |          |           |                   |
| Coupon     | coupons          | CouponController     |          |           |                   |
| Category   | categories       | CategoryController   |          |           |                   |
| Product    | products         | ProductController    |          |           | ProductSeeder     |
| -          | category_product |                      |          |           |                   |
| Order      | orders           | OrderController      |          |           |                   |
| -          | order_product    |                      |          |           |                   |
| -          | -                | CartController       |          |           |                   |
| Slider     | sliders          | SliderController     |          |           | SliderSeeder '\*' |
| Banner     | banners          | BannerController     |          |           | BannerSeeder '\*' |

---

# **Some Basic Understanding of Elequent Relationship**

-   One To One : hasOne(), belongsTo()
-   One To Many : hasMany()
-   Many To Many: belongsToMany()

---

## **One To One**

### tables

`users`

`phones`

### Models

`User`

`Phone`

### **Table:** `phones`

```php
Schema::create('phones', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->string('phone');
    $table->unsignedBigInteger('user_id');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users');
});
```

> Here `user_id` is foreign key in `phones` table. And the primary key of this is in `users` tables

### **Model:** `Phone.php`

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

> Create `user` relationship in that `Phone` model.

> `belongsTo` because, the table that has `references` (fk) here `user_id` in phones is the one that will use `belongsTo` in relationship.

### **Model:** `User.php`

```php
public function phone()
{
    return $this->hasOne(Phone::class);
}
```

> Create `phone` relationship in that `User` model

> `hasOne` because, the table we are `referencing` is the one which will use `hasOne` in relationship.

---

## **One To Many** (Most Commonly Used Relationship)

**Idea:** States that there is one owner and that owner has many of the secondary property

### tables

`users`

`posts`

### Models

`User`

`Post`

### **Table:** `posts`

```php
Schema::create('posts', function (Blueprint $table) {
    $table->bigIncrements('id');
    $table->unsignedBigInteger('user_id');
    $table->string('title');
    $table->text('body');
    $table->timestamps();
});
```

### **Model:** `Post.php`

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
```

> Create `user` relationship in that `Post` model.

> `belongsTo` because, the table that has `references` (fk) here `user_id` in posts is the one that will use `belongsTo` in relationship.

> A `post` can be posted by only one user so it should be `belongsTo` relationship.

### **Model:** `User.php`

```php
public function posts()
{
    return $this->hasMany(\App\Post::class);
}
```

> Create `posts` relationship in `User` model.

> And an user can have many posts. So the relationship is `hasMany`

## **Many To Many**

### tables

`categories`

`products`

`category_product`

> Here `category_product` is intermediate table

> And one thing to note that, here `categories` and `products` are not directly coonnected. Instead they connected though `category_product` table

### Models

`Category`

`Product`

> Note: We don't need to create Model for `intermediate` table. We just create a migration for the table.

### **Table:** `categories`

```php
Schema::create('categories', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->timestamps();
});
```

### **Table:** `products`

```php
Schema::create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->float('price');
    $table->timestamps();
});
```

### **Table:** `category_product` (Pivot Table)

```php
Schema::create('category_product', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('category_id')->unsigned();
    $table->integer('product_id')->unsigned();
});
```

### **Model:** `Product.php`

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
```

### **Model:** `Category.php`

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
```

Create a Product

`ProductController.php`

```php
<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $product = new Product;
        $product->name = 'God of War';
        $product->price = 40;

        $product->save();

        $category = Category::find([3, 4]);
        $product->categories()->attach($category);

        return 'Success';
    }
}
```

> First, we have created the Product and save it in the products table. Now, it is time to assign the categories to the newly created Product.

> Since we just need an ID of categories, so right now, I have coded manually, but in real-time, you have those ids in the form request.

> Now, attach() function will assign those category ids to the newly created Product and also create two new rows inside the pivot table. Each row has a relationship with its Product and category.

```php
// show.blade.php
<h2>Product Name: </h2>
<p>{{ $product->name }} || ${{ money_format($product->price, 2) }}</p>

<h3>Product Belongs to</h3>

<ul>
    @foreach($product->categories as $category)
    <li>{{ $category->title }}</li>
    @endforeach
</ul>
```

**Detach() function.**

`ProductController.php`

```php
public function removeCategory(Product $product)
{
    $category = Category::find(3);
    $product->categories()->detach($category);
    return 'Success';
}
```

---

### Creating only migration

```cmd
php artisan make:migration create_category_product_table --create category_product
```

> `create_ + pivotTable + _table`

> here pivot table contains two table and table names should present in `alphabetical order`.

One important thing

```php
return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity', 'price');
```

> Here `order_items` is pivot table. `order_items` is column name of this table. And `product_id` id the column name of foreign table (Product)

---

# **Some relationship in our Database Design**

---

-   `Order` **belongsToMany** `Product`
-   `Order` **belongsTo** `User`
-   `Product` **belongsTo** `Shop`
-   `Shop` **hasMany** `Product`
-   `Shop` **belongsTo** `User`
-   `User` **hasOne** `Shop`

---

# **Commands | Model | Migrations**

```cmd
~$ php artisan make:model Model -a
```

> Creates everything

```cmd
~$ php artisan make:model Model -a
```

> Creates Model, Controller and Migration

```cmd
~$ php artisan make:migration create_permission_role_table
```

> Creates only migrations

---

# **Created all the Model, Controllers, migration and seeds initially**

---

# **Set remember_token column**

---

`Model.php`

```php
protected $fillable = [
    'name', 'email', 'password', 'remember_token'
];
```

`Controller.php`

```php
protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'remember_token' => Str::random(60),
    ]);
}
```

---

# **Created all the table columns**

---

# **Created all the relationship among models**

---

# **Front End Design Completed**

---

# **Create a Super Admin using Seeder**

---

`SuperAdminSeeder.php`

```php
<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'Imrul Hasan', 'email' => 'imrulhasan273@gmail.com', 'password' => Hash::make('imrulhasan')]);
        $role = Role::create(['name' => 'super_admin', 'display_name' => 'Super Admin']);
        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $role->id]);
    }
}
```

`DatabaseSeeder.php`

```php
<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminSeeder::class);
    }
}
```

Now run the following commands.

```cmd
~$ composer dump-autoload
```

```cmd
~$ php artisan db:seed
~$ php artisan migrate:fresh --seed
```

---

# **Login And Registration Page Done**

# **Loader System**

`x.blade.php`

```php
<!-- Start Page Preloder -->
<div id="preloder">
    <div class="loader">
    </div>
</div>
<!-- End Page Preloder -->
```

`loader.css`

```css
/* Preloder */
#preloder {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999999;
    background: #000;
}

.loader {
    width: 40px;
    height: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -13px;
    margin-left: -13px;
    border-radius: 60px;
    animation: loader 0.8s linear infinite;
    -webkit-animation: loader 0.8s linear infinite;
}

@keyframes loader {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
    50% {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        border: 4px solid #673ab7;
        border-left-color: transparent;
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
}

@-webkit-keyframes loader {
    0% {
        -webkit-transform: rotate(0deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
    50% {
        -webkit-transform: rotate(180deg);
        border: 4px solid #673ab7;
        border-left-color: transparent;
    }
    100% {
        -webkit-transform: rotate(360deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
}
```

`loader.js`

```js
"use strict";

$(window).on("load", function() {
    /*------------------
		Preloder
	--------------------*/
    $(".loader").fadeOut();
    $("#preloder")
        .delay(400)
        .fadeOut("slow");
});
```

---

# **Feature Products**

---

`HomeController.php`

```php
public function index()
{
    $products = Product::take(8)->get();

    return view('home', compact('products'));
}
```

---

# **Shopping Cart Operation**

---

> Now I am implementing a shopping cart operation in unique way. And much more robust.

`cart/index.blade.php`

```php
<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    <div class="cart-table-warp">
                        <table>
                        <thead>
                            <tr>
                                <th class="product-th"></th>
                                <th class="product-th">Product</th>
                                <th class="quy-th">Quantity</th>
                                <th class="size-th">SizeSize</th>
                                <th class="total-th">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="remove-col">
                                    <a href="{{ route('cart.destroy', $item->id) }}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                                <td class="product-col">
                                    <img src="{{asset('/storage/products/'.$item->cover_img)}}" alt="">
                                    <div class="pc-title">
                                        <h4>{{ $item->name }}</h4>
                                        <p>${{ $item->price }}</p>
                                    </div>
                                </td>
                                <td class="quy-col">
                                    <div class="quantity">
                                        <form id="myform">
                                            <div class="pro-qty">
                                                <a href="{{ route('cart.update', [$item->id , 'd']) }}" class="dec qtybtn">-</a>
                                                <input type="text" value="{{ $itemOccurrence[$item->id] }}" readonly>
                                                <a href="{{ route('cart.update', [$item->id , 'i']) }}" class="inc qtybtn">+</a>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                                <td class="size-col"><h4>Size M</h4></td>
                                <td class="total-col"><h4>${{$item->price * $itemOccurrence[$item->id]}}</h4></td>
                                @php
                                    $subTotalPrice = ($subTotalPrice + $item->price * $itemOccurrence[$item->id]);
                                    $totalPrice = $totalPrice + $item->price * $itemOccurrence[$item->id];
                                @endphp
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    @php
                    // calculating discount on coupon
                        $totalPrice = $subTotalPrice - ( ($couponDiscount*$subTotalPrice)/100 );
                    @endphp
                    <div class="total-cost">
                        <h6>Sub Total <span>${{$subTotalPrice}}</span></h6>
                        <br>
                        <h6>Total <span>${{$totalPrice}}</span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <form action="{{ route('cart.coupon') }}" class="promo-code-form">
                    <input name="coupon_code" type="text" placeholder="Enter promo code">
                    <button name="submit" type="submit">Submit</button>
                </form>
                <a href="{{route('cart.checkout')}}" class="site-btn">Proceed to checkout</a>
                <a href="{{route('home')}}" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->
```

`**CartController.php**`

`add to cart` operation

```php
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
```

`index` page of cart

```php
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
    //Fetch products using cart items id
    $cartItems = DB::table('products')->whereIn('id', $cartItemsArray)->get();
    //----------------------------------

    //Fetch coupon discount from user table
    $couponDiscount = DB::table('users')->where('id', auth()->id())->value('discount');
    //

    return view('cart.index', compact('itemCount', 'cartItems', 'itemOccurrence', 'couponDiscount'));
}
```

`update cart operation`

```php
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
    }
    else
    {
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
```

`delete an item operation in cart`

```php
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
```

`Apply a coupon in cart`

```php
public function coupon(Request $request)
{
    $couponsQuery = DB::table('coupons')->where('code', $request->coupon_code)->value('discount');

    if ($couponsQuery != NULL) {
        $update_user = DB::table('users')
            ->where('id', auth()->id())
            ->update(['discount' => $couponsQuery]);
        return back()->with('message', 'Promo Code Applied');
    }
    else
    {
        $update_user = DB::table('users')
            ->where('id', auth()->id())
            ->update(['discount' => 0]);
        return back()->with('message', 'Promo Code Expires');
    }
}
```

---

# **Order a product**

---

`OrderController.php`

```php
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
        $subTotalPrice = 0;
        $totalPrice = 0;
        foreach ($cartItems  as $item) {
            $subTotalPrice += ($item->price * $itemOccurrence[$item->id]);
        }
        $couponDiscount = DB::table('users')->where('id', auth()->id())->value('discount');
        $discountPrice = (($couponDiscount * $subTotalPrice) / 100);
        $totalPrice = $subTotalPrice - $discountPrice;
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

        $order->sub_total = $subTotalPrice;
        $order->discount = $discountPrice;
        $order->grand_total = $totalPrice;
        $order->item_count = $itemCount;
        $order->user_id = auth()->id();
        $order->save();

        //Add all the products in order_product table which is pivot table
        foreach ($cartItems as $item) {
            // $dPrice = floatval(($couponDiscount * $item->price) / 100);
            // $item->price = $item->price - $dPrice;
            $order->product()->attach($item->id, ['price' => $item->price, 'quantity' => $itemOccurrence[$item->id]]);
        }

        if (request('payment_method') == 'online') {
            $orderId = $order->id;
            $grandTotal = $order->grand_total;
            return view('payments.create', compact('orderId', 'grandTotal'));
        }

        //Reset cart items, coupons from user table
        $update_cart = DB::table('users')
            ->where('id', auth()->id())
            ->update([
                'cartitems' => '',
                'discount' => 0
            ]);
        //----

        #send email to customer
        $order = Order::find($order->id);
        Mail::to($order->user->email)->send(new OrderPaid($order));
        #---


        return Redirect::route('home')->with('message', 'Order has been placed');
    }
```

---

# **Payment Gateway set up with SSLCommerz**

---

## Step 1

> Create 2 controllers

```cmd
~$ php artisan make:controller SSLCommerz
~$ php artisan make:controller SSLCommerzPaymentController
```

## Step 2

copy past code in `SSLCommerz.php` controller

```php
<?php

namespace App\Http\Controllers;

define("SSLCZ_STORE_ID", "ecomm5ef617eb08f58");
define("SSLCZ_STORE_PASSWD", "ecomm5ef617eb08f58@ssl");

# IF SANDBOX TRUE, THEN IT WILL CONNECT WITH SSLCOMMERZ SANDBOX (TEST) SYSTEM
define("SSLCZ_IS_SANDBOX", true);

# IF BROWSE FROM LOCAL HOST, KEEP true
define("SSLCZ_IS_LOCAL_HOST", true);

class SSLCommerz
{
    protected $sslc_submit_url;
    protected $sslc_validation_url;
    protected $sslc_mode;
    protected $sslc_data;
    protected $store_id;
    protected $store_pass;
    public $error = '';

    public function __construct()
    {
        $this->setSSLCommerzMode((SSLCZ_IS_SANDBOX) ? 1 : 0);
        $this->store_id = SSLCZ_STORE_ID;
        $this->store_pass = SSLCZ_STORE_PASSWD;
        $this->sslc_submit_url = "https://" . $this->sslc_mode . ".sslcommerz.com/gwprocess/v3/api.php";
        $this->sslc_validation_url = "https://" . $this->sslc_mode . ".sslcommerz.com/validator/api/validationserverAPI.php";
    }

    public function initiate($post_data, $get_pay_options = false)
    {
        if ($post_data != '' && is_array($post_data)) {

            $post_data['store_id'] = $this->store_id;
            $post_data['store_passwd'] = $this->store_pass;

            $load_sslc = $this->sendRequest($post_data);

            if ($load_sslc) {
                if (isset($this->sslc_data['status']) && $this->sslc_data['status'] == 'SUCCESS') {
                    if (!$get_pay_options) {
                        if (isset($this->sslc_data['GatewayPageURL']) && $this->sslc_data['GatewayPageURL'] != '') {
                            // header("Location: " . $this->sslc_data['GatewayPageURL']);
                            echo "
                                <script>
                                    window.location.href = '" . $this->sslc_data['GatewayPageURL'] . "';
                                </script>
                            ";
                            exit;
                        } else {
                            $this->error = "No redirect URL found!";
                            return $this->error;
                        }
                    } else {
                        $options = array();
                        # VISA GATEWAY
                        if (isset($this->sslc_data['gw']['visa']) && $this->sslc_data['gw']['visa'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['visa']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'dbbl_visa') {
                                    //$options['cards'][0]['name'] = "DBBL VISA";
                                    //$options['cards'][0]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."dbbl_visa'><img style='width:60px; height:60px' src='".$this->_get_image("dbbl_visa", $this->sslc_data)."' alt='dbbl_visa'/></a>";
                                }
                                if ($gw_value == 'brac_visa') {
                                    //$options['cards'][1]['name'] = "BRAC VISA";
                                    //$options['visa'][1]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."brac_visa'><img style='width:60px; height:60px' src='".$this->_get_image("brac_visa", $this->sslc_data)."' alt='brac_visa'/></a>";
                                }
                                if ($gw_value == 'city_visa') {
                                    //$options['cards'][2]['name'] = "CITY VISA";
                                    //$options['cards'][2]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."city_visa'><img style='width:60px; height:60px' src='".$this->_get_image("city_visa", $this->sslc_data)."' alt='city_visa'/></a>";
                                }
                                if ($gw_value == 'ebl_visa') {
                                    //$options['cards'][3]['name'] = "EBL VISA";
                                    //$options['cards'][3]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."ebl_visa'><img style='width:60px; height:60px' src='".$this->_get_image("ebl_visa", $this->sslc_data)."' alt='ebl_visa'/></a>";
                                }
                                if ($gw_value == 'visacard') {
                                    $options['cards'][4]['name'] = "VISA";
                                    $options['cards'][4]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "visacard'><img style='width:60px; height:60px' src='" . $this->_get_image("visacard", $this->sslc_data) . "' alt='visacard'/></a>";
                                }
                            }
                        } # END OF VISA

                        # MASTER GATEWAY
                        if (isset($this->sslc_data['gw']['master']) && $this->sslc_data['gw']['master'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['master']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'dbbl_master') {
                                    //$options['cards'][5]['name'] = "DBBL MASTER";
                                    //$options['cards'][5]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."dbbl_master'><img style='width:60px; height:60px' src='".$this->_get_image("dbbl_master", $this->sslc_data)."' alt='dbbl_master'/></a>";
                                }
                                if ($gw_value == 'brac_master') {
                                    //$options['cards'][6]['name'] = "BRAC MASTER";
                                    //$options['master'][6]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."brac_master'><img style='width:60px; height:60px' src='".$this->_get_image("brac_master", $this->sslc_data)."' alt='brac_master'/></a>";
                                }
                                if ($gw_value == 'city_master') {
                                    //$options['cards'][7]['name'] = "CITY MASTER";
                                    //$options['cards'][7]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."city_master'><img style='width:60px; height:60px' src='".$this->_get_image("city_master", $this->sslc_data)."' alt='city_master'/></a>";
                                }
                                if ($gw_value == 'ebl_master') {
                                    //$options['cards'][8]['name'] = "EBL MASTER";
                                    //$options['cards'][8]['link'] =  "<a class='hvr-pop' href='".$this->sslc_data['redirectGatewayURL']."ebl_master'><img style='width:60px; height:60px' src='".$this->_get_image("ebl_master", $this->sslc_data)."' alt='ebl_master'/></a>";
                                }
                                if ($gw_value == 'mastercard') {
                                    $options['cards'][9]['name'] = "MASTER";
                                    $options['cards'][9]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "mastercard'><img style='width:60px; height:60px' src='" . $this->_get_image("mastercard", $this->sslc_data) . "' alt='mastercard'/></a>";
                                }
                            }
                        } # END OF MASTER


                        # AMEX GATEWAY
                        if (isset($this->sslc_data['gw']['amex']) && $this->sslc_data['gw']['amex'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['amex']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'city_amex') {
                                    $options['cards'][10]['name'] = "AMEX";
                                    $options['cards'][10]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "city_amex'><img style='width:60px; height:60px' src='" . $this->_get_image("city_amex", $this->sslc_data) . "' alt='city_amex'/></a>";
                                }
                            }
                        } # END OF AMEX


                        # OTHER CARDS GATEWAY
                        if (isset($this->sslc_data['gw']['othercards']) && $this->sslc_data['gw']['othercards'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['othercards']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'dbbl_nexus') {
                                    $options['others'][0]['name'] = "NEXUS";
                                    $options['others'][0]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "dbbl_nexus'><img style='width:60px; height:60px' src='" . $this->_get_image("dbbl_nexus", $this->sslc_data) . "' alt='dbbl_nexus'/></a>";
                                }

                                if ($gw_value == 'qcash') {
                                    $options['others'][1]['name'] = "QCASH";
                                    $options['others'][1]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "qcash'><img style='width:60px; height:60px' src='" . $this->_get_image("qcash", $this->sslc_data) . "' alt='qcash'/></a>";
                                }

                                if ($gw_value == 'fastcash') {
                                    $options['others'][2]['name'] = "FASTCASH";
                                    $options['others'][2]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "fastcash'><img style='width:60px; height:60px' src='" . $this->_get_image("fastcash", $this->sslc_data) . "' alt='fastcash'/></a>";
                                }
                            }
                        } # END OF OTHER CARDS

                        # INTERNET BANKING GATEWAY
                        if (isset($this->sslc_data['gw']['internetbanking']) && $this->sslc_data['gw']['internetbanking'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['internetbanking']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'city') {
                                    $options['internet'][0]['name'] = "CITYTOUCH";
                                    $options['internet'][0]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "city'><img style='width:60px; height:60px' src='" . $this->_get_image("city", $this->sslc_data) . "' alt='city'/></a>";
                                }

                                if ($gw_value == 'bankasia') {
                                    $options['internet'][1]['name'] = "BANK ASIA";
                                    $options['internet'][1]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "bankasia'><img style='width:60px; height:60px' src='" . $this->_get_image("bankasia", $this->sslc_data) . "' alt='bankasia'/></a>";
                                }

                                if ($gw_value == 'ibbl') {
                                    $options['internet'][2]['name'] = "IBBL";
                                    $options['internet'][2]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "ibbl'><img style='width:60px; height:60px' src='" . $this->_get_image("ibbl", $this->sslc_data) . "' alt='ibbl'/></a>";
                                }

                                if ($gw_value == 'mtbl') {
                                    $options['internet'][3]['name'] = "MTBL";
                                    $options['internet'][3]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "mtbl'><img style='width:60px; height:60px' src='" . $this->_get_image("mtbl", $this->sslc_data) . "' alt='mtbl'/></a>";
                                }
                            }
                        } # END OF INTERNET BANKING

                        # MOBILE BANKING GATEWAY
                        if (isset($this->sslc_data['gw']['mobilebanking']) && $this->sslc_data['gw']['mobilebanking'] != "") {
                            $sslcz_visa = explode(",", $this->sslc_data['gw']['mobilebanking']);
                            foreach ($sslcz_visa as $gw_value) {
                                if ($gw_value == 'dbblmobilebanking') {
                                    $options['mobile'][0]['name'] = "DBBL MOBILE BANKING";
                                    $options['mobile'][0]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "dbblmobilebanking'><img style='width:60px; height:60px' src='" . $this->_get_image("dbblmobilebanking", $this->sslc_data) . "' alt='dbblmobilebanking'/></a>";
                                }

                                if ($gw_value == 'bkash') {
                                    $options['mobile'][1]['name'] = "Bkash";
                                    $options['mobile'][1]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "bkash'><img style='width:60px; height:60px' src='" . $this->_get_image("bkash", $this->sslc_data) . "' alt='bkash'/></a>";
                                }

                                if ($gw_value == 'abbank') {
                                    $options['mobile'][2]['name'] = "AB Direct";
                                    $options['mobile'][2]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "abbank'><img style='width:60px; height:60px' src='" . $this->_get_image("abbank", $this->sslc_data) . "' alt='abbank'/></a>";
                                }

                                if ($gw_value == 'ibbl') {
                                    $options['mobile'][3]['name'] = "IBBL";
                                    $options['mobile'][3]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "ibbl'><img style='width:60px; height:60px' src='" . $this->_get_image("ibbl", $this->sslc_data) . "' alt='ibbl'/></a>";
                                }

                                if ($gw_value == 'mycash') {
                                    $options['mobile'][4]['name'] = "MYCASH";
                                    $options['mobile'][4]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "mycash'><img style='width:60px; height:60px' src='" . $this->_get_image("mycash", $this->sslc_data) . "' alt='mycash'/></a>";
                                }

                                if ($gw_value == 'ific') {
                                    $options['mobile'][5]['name'] = "IFIC";
                                    $options['mobile'][5]['link'] = "<a class='hvr-pop' href='" . $this->sslc_data['redirectGatewayURL'] . "ific'><img style='width:60px; height:60px' src='" . $this->_get_image("ific", $this->sslc_data) . "' alt='ific'/></a>";
                                }
                            }
                        } # END OF MOBILE BANKING

                        return $options;
                    }
                } else {

                    $this->error = "Invalid Credential!";
                    return $this->error;
                }
            } else {
                $this->error = "Connectivity Issue. Please contact your sslcommerz manager";
                return $this->error;
            }
        } else {
            $msg = "Please provide a valid information list about transaction with transaction id, amount, success url, fail url, cancel url, store id and pass at least";
            $this->error = $msg;
            return false;
        }
    }

    public function orderValidate($trx_id = '', $amount = 0, $currency = "BDT", $post_data)
    {
        if ($post_data == '' && $trx_id == '' && !is_array($post_data)) {
            $this->error = "Please provide valid transaction ID and post request data";
            return $this->error;
        }
        $validation = $this->validate($trx_id, $amount, $currency, $post_data);
        if ($validation) {
            return true;
        } else {
            return false;
        }
    }

    # SEND CURL REQUEST
    protected function sendRequest($data)
    {


        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $this->sslc_submit_url);
        curl_setopt($handle, CURLOPT_POST, 1);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        if (SSLCZ_IS_LOCAL_HOST) {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        } else {
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2); // Its default value is now 2
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
        }


        $content = curl_exec($handle);


        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($code == 200 && !(curl_errno($handle))) {
            curl_close($handle);
            $sslcommerzResponse = $content;

            # PARSE THE JSON RESPONSE
            $this->sslc_data = json_decode($sslcommerzResponse, true);
            return $this;
        } else {
            curl_close($handle);
            $msg = "FAILED TO CONNECT WITH SSLCOMMERZ API";
            $this->error = $msg;
            return false;
        }
    }

    # SET SSLCOMMERZ PAYMENT MODE - LIVE OR TEST
    protected function setSSLCommerzMode($test)
    {
        if ($test) {
            $this->sslc_mode = "sandbox";
        } else {
            $this->sslc_mode = "securepay";
        }
    }

    # VALIDATE SSLCOMMERZ TRANSACTION
    protected function validate($merchant_trans_id, $merchant_trans_amount, $merchant_trans_currency, $post_data)
    {
        # MERCHANT SYSTEM INFO
        if ($merchant_trans_id != "" && $merchant_trans_amount != 0) {

            # CALL THE FUNCTION TO CHECK THE RESUKT
            $post_data['store_id'] = $this->store_id;
            $post_data['store_pass'] = $this->store_pass;

            if ($this->SSLCOMMERZ_hash_varify($this->store_pass, $post_data)) {

                $val_id = urlencode($post_data['val_id']);
                $store_id = urlencode($this->store_id);
                $store_passwd = urlencode($this->store_pass);
                $requested_url = ($this->sslc_validation_url . "?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

                $handle = curl_init();
                curl_setopt($handle, CURLOPT_URL, $requested_url);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

                if (SSLCZ_IS_LOCAL_HOST) {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
                } else {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2); // Its default value is now 2
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
                }


                $result = curl_exec($handle);

                $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                if ($code == 200 && !(curl_errno($handle))) {

                    # TO CONVERT AS ARRAY
                    # $result = json_decode($result, true);
                    # $status = $result['status'];

                    # TO CONVERT AS OBJECT
                    $result = json_decode($result);
                    $this->sslc_data = $result;

                    # TRANSACTION INFO
                    $status = $result->status;
                    $tran_date = $result->tran_date;
                    $tran_id = $result->tran_id;
                    $val_id = $result->val_id;
                    $amount = $result->amount;
                    $store_amount = $result->store_amount;
                    $bank_tran_id = $result->bank_tran_id;
                    $card_type = $result->card_type;
                    $currency_type = $result->currency_type;
                    $currency_amount = $result->currency_amount;

                    # ISSUER INFO
                    $card_no = $result->card_no;
                    $card_issuer = $result->card_issuer;
                    $card_brand = $result->card_brand;
                    $card_issuer_country = $result->card_issuer_country;
                    $card_issuer_country_code = $result->card_issuer_country_code;

                    # API AUTHENTICATION
                    $APIConnect = $result->APIConnect;
                    $validated_on = $result->validated_on;
                    $gw_version = $result->gw_version;

                    # GIVE SERVICE
                    if ($status == "VALID" || $status == "VALIDATED") {
                        if ($merchant_trans_currency == "BDT") {
                            if (trim($merchant_trans_id) == trim($tran_id) && (abs($merchant_trans_amount - $amount) < 1) && trim($merchant_trans_currency) == trim('BDT')) {
                                return true;
                            } else {
                                # DATA TEMPERED
                                $this->error = "Data has been tempered";
                                return false;
                            }
                        } else {
                            //echo "trim($merchant_trans_id) == trim($tran_id) && ( abs($merchant_trans_amount-$currency_amount) < 1 ) && trim($merchant_trans_currency)==trim($currency_type)";
                            if (trim($merchant_trans_id) == trim($tran_id) && (abs($merchant_trans_amount - $currency_amount) < 1) && trim($merchant_trans_currency) == trim($currency_type)) {
                                return true;
                            } else {
                                # DATA TEMPERED
                                $this->error = "Data has been tempered";
                                return false;
                            }
                        }
                    } else {
                        # FAILED TRANSACTION
                        $this->error = "Failed Transaction";
                        return false;
                    }
                } else {
                    # Failed to connect with SSLCOMMERZ
                    $this->error = "Faile to connect with SSLCOMMERZ";
                    return false;
                }
            } else {
                # Hash validation failed
                $this->error = "Hash validation failed";
                return false;
            }
        } else {
            # INVALID DATA
            $this->error = "Invalid data";
            return false;
        }
    }

    # FUNCTION TO CHECK HASH VALUE
    protected function SSLCOMMERZ_hash_varify($store_passwd = "", $post_data)
    {

        if (isset($post_data) && isset($post_data['verify_sign']) && isset($post_data['verify_key'])) {
            # NEW ARRAY DECLARED TO TAKE VALUE OF ALL POST
            $pre_define_key = explode(',', $post_data['verify_key']);

            $new_data = array();
            if (!empty($pre_define_key)) {
                foreach ($pre_define_key as $value) {
                    //   if (isset($post_data[$value])) {
                    $new_data[$value] = ($post_data[$value]);
                    //  }
                }
            }
            # ADD MD5 OF STORE PASSWORD
            $new_data['store_passwd'] = md5($store_passwd);

            # SORT THE KEY AS BEFORE
            ksort($new_data);

            $hash_string = "";
            foreach ($new_data as $key => $value) {
                $hash_string .= $key . '=' . ($value) . '&';
            }
            $hash_string = rtrim($hash_string, '&');

            if (md5($hash_string) == $post_data['verify_sign']) {

                return true;
            } else {
                $this->error = "Verification signature not matched";
                return false;
            }
        } else {
            $this->error = 'Required data mission. ex: verify_key, verify_sign';
            return false;
        }
    }

    # FUNCTION TO GET IMAGES FROM WEB
    protected function _get_image($gw = "", $source = array())
    {
        $logo = "";
        if (!empty($source) && isset($source['desc'])) {

            foreach ($source['desc'] as $key => $volume) {

                if (isset($volume['gw']) && $volume['gw'] == $gw) {

                    if (isset($volume['logo'])) {
                        $logo = str_replace("/gw/", "/gw1/", $volume['logo']);
                        break;
                    }
                }
            }
            return $logo;
        } else {
            return "";
        }
    }

    public function getResultData()
    {
        return $this->sslc_data;
    }
}
```

## Step 3

> Copy past code in `SSLCommerzPaymentController.php`

```php
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

        //-----Here We take the orderId into $post_data to pass it on success function
        $post_data['temp'] = $ordId;
        $_SESSION['payment_values']['temp'] = $post_data['temp'];
        //----------------------------------------------------------------------------

        #Start to save these value  in session to pick in success page.
        $_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
        #End to save these value  in session to pick in success page.

        $server_name = $request->root() . "/";
        $post_data['success_url'] = $server_name . "success";
        $post_data['fail_url'] = $server_name . "fail";
        $post_data['cancel_url'] = $server_name . "cancel";

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
        // dd($request);

        $payment_method = $request->card_issuer;
        $transId        = $request->bank_tran_id;
        $storeId        = $request->store_id;

        echo "Transaction is Successful";

        $update_product = DB::table('orders')
            ->where('id', $_SESSION['payment_values']['temp'])
            ->update([
                'is_paid' => '1',
                'payment_method' => $payment_method,
                'transection_id' => $transId,
                'store_id'       => $storeId,
                'status'         => 'processing'
            ]);

        //send email to customer
        // $order = Order::find($_SESSION['payment_values']['temp']);
        // Mail::to($order->user->email)->send(new OrderPaid($order));
        //---

        return redirect(route('home'))->with('message', 'Order with Transaction successful');
    }

    public function fail(Request $request)
    {
        // dd($request);
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
```

## Step 4

Copy past in `Http/Controllers/Middleware/VerifyCsrfToken.php`

```php
<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/success', '/cancel', '/fail', '/ipn'
    ];
}
```

## Step 5

> Create some routing

`web.php`

```php
// SSLCOMMERZ Start
Route::POST('/pay/{orderId}', 'SSLCommerzPaymentController@index')->name('payments.pay');
Route::POST('/success', 'SSLCommerzPaymentController@success');
Route::POST('/fail', 'SSLCommerzPaymentController@fail');
Route::POST('/cancel', 'SSLCommerzPaymentController@cancel');
Route::POST('/ipn', 'SSLCommerzPaymentController@ipn');
// SSLCOMMERZ END
```

---

# **Flow of Payment Gateway**

---

## Flow 1

`OrderController.php`

```php
if (request('payment_method') == 'online') {
    $orderId = $order->id;
    $grandTotal = $order->grand_total;
    return view('payments.create', compact('orderId', 'grandTotal'));
}
```

> I send the `orderId` and `grandTotal` to the `view/payment/create.blade.php`

## Flow 2

`create.blade.php`

```php
<form action="{{ route('payments.pay', [$orderId])}}" method="POST" class="form-horizontal">
    @csrf
    <div class="form-group">
        <label class="control-label">Total Price: </label>
        <div class="col-sm-6">
            <input value="{{$grandTotal}}" type="text" class="form-control" name="amount"
                    readonly/>
        </div>
    </div>

    <div class="clearfix form-actions ">
        <div class="col-md-10">
            <button class="btn btn-info btn-sm" id="submit" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>Proceed Payment
            </button>
        </div>
    </div>
</form>
```

> In this view it is a form. In this form there is one `input` field. And this field contain `grandTotal` value.

> After submitting the form. input value will be sent to `Request` and the `orderId` will be sent to the `route('payment.pay')` which is the `index` method of `SSLCommerzPaymentController` controller.

## Flow 3

`SSLCommerzPaymentController.php`

```php
    public function index(Request $request, $ordId)
    {
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = now(); // tran_id must be unique

        //-----Here We take the orderId into $post_data to pass it on success function
        $post_data['temp'] = $ordId;
        $_SESSION['payment_values']['temp'] = $post_data['temp'];
        //----------------------------------------------------------------------------

        #Start to save these value  in session to pick in success page.
        $_SESSION['payment_values']['tran_id'] = $post_data['tran_id'];
        #End to save these value  in session to pick in success page.

        $server_name = $request->root() . "/";
        $post_data['success_url'] = $server_name . "success";
        $post_data['fail_url'] = $server_name . "fail";
        $post_data['cancel_url'] = $server_name . "cancel";

        $sslc = new SSLCommerz();
        // dd($sslc);
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->initiate($post_data, false);

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
```

> In this method we can see the payment gateway. and pay the bills.

## Flow 4

`SSLCommerzPaymentController.php`

```php
    public function success(Request $request)
    {
        // dd($request);

        $payment_method = $request->card_issuer;
        $transId        = $request->bank_tran_id;
        $storeId        = $request->store_id;

        echo "Transaction is Successful";

        $update_product = DB::table('orders')
            ->where('id', $_SESSION['payment_values']['temp'])
            ->update([
                'is_paid' => '1',
                'payment_method' => $payment_method,
                'transection_id' => $transId,
                'store_id'       => $storeId,
                'status'         => 'processing'
            ]);

        //send email to customer
        // $order = Order::find($_SESSION['payment_values']['temp']);
        // Mail::to($order->user->email)->send(new OrderPaid($order));
        //---

        return redirect(route('home'))->with('message', 'Order with Transaction successful');
    }
```

> This method will be executed when the payment will be succesfull.

## Flow 5

`SSLCommerzPaymentController.php`

```php
    public function fail(Request $request)
    {
        // dd($request);
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
```

> THis method will be executed when the payment will be unseccessfull.

## Flow 6

`SSLCommerzPaymentController.php`

```php
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
```

> This method will be excuted when the payment will be cancelled.

---

---

# **Send Email To User | Payment Confirmation**

--

## Step 1

Run below command to set some default folder and files,

```cmd
~$ php artisan make:mail OrderPaid --markdown=mail.order.paid
```

## **New Directory:**

-   M-Laravel-Ecommerce\resources\views\mail
-   M-Laravel-Ecommerce\app\Mail\

## Step 2

before returning from `success` function in `PublicSslCommerzPaymentController.php`

```php
$order = Order::find($_SESSION['payment_values']['order_id']);
Mail::to($order->user->email)->send(new OrderPaid($order));
```

> We find the order using order id which is inside the `$_SESSION['payment_values']['order_id']` variable.

> Then we send a mail to email of user of order sending the information to the OrderPaid class.

## Step 3

`apps/Mail/Orderpaid.php`

```php
public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
public function __construct(Order $order)
{
    $this->order = $order;
}
```

> Here we take the `$order` instance of `Order` model as argument from default constructor and set this order value to public `$order` variable.

## Step 4

`mail/order/paid.blade.php`

```php
@extends('mail.template')
@section('invoice')
@component('mail::button', ['url' => ''])
Print
@endcomponent

@component('mail::layout')

{{-- Start Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
    Invoice Page
@endcomponent
@endslot
{{-- End Header --}}


@if ($order->payment_method == 'cash_on_delivery')
# Invoice Status: Un Paid
@else
# Invoice Status: Paid
@endif

<hr>
Shipping Information
<hr>
<h6> Name: {{$order->shipping_fullname}} <br>
     City: {{$order->shipping_city }}<br>
     Address: {{ $order->shipping_address }}<br>
     Country: {{ $order->shipping_state }}<br>
     Cell: {{$order->shipping_phone }}<br>
</h6>
<hr>
Invoice Information
<hr>
<h6> Order No: {{$order->order_number }}<br>
     Payment Method: {{$order->payment_method }}<br>
     Transection ID: {{$order->transection_id }}<br>
</h6>
<hr>


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Product name</th>
            <th>quantity</th>
            <th>price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->product as $item)
        <tr>
            <td scope="row">{{ $item->name }}</td>
            <td>{{ $item->pivot->quantity }}</td>
            <td>{{ $item->pivot->price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<hr>
Total Items: {{ $order->item_count }}
<br>
Sub Total : {{ $order->sub_total }}
<br>
Discount : {{ $order->discount }}
<br>
Grand Total : {{ $order->grand_total }}

<hr>
Date: {{ $order->updated_at }}
<br>
Thanks for your purchase, {{ config('app.name') }}

{{-- Start Footer --}}
@slot('footer')
@component('mail::footer')
© 2020 Deal Ocean. All rights reserved.
@endcomponent
@endslot
{{-- End Footer --}}

@endcomponent
@endsection
```

`mail/template.blade.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{-- <link href="{{ asset('css/mail.css') }}" rel="stylesheet"/> --}}
    <link href="{{ asset('links/custom/mail/mail.css') }}" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title></title>
</head>
<body>
    <main class="py-4 container">
        @yield('invoice')
    </main>
</body>
</html>
```

Here is the form interface we send to user.

## Step 5

`Order.php`

```php
public function product()
{
    return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withPivot('quantity', 'price')->withTimestamps();
}

public function user()
{
    return $this->belongsTo(User::class);
}
```

> Here we need to add `user()` function for foreign key constraint.

> In the `mail/order/paid.blade.php` form we use `pivot` for quantity and price. To access these we need to use `withPivot('quantity', 'price');` in the `product()` function.

## Step 6

`.env`

```php
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=52cf0d921a8067
MAIL_PASSWORD=a25e11ca412af2
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=imrulhasan273@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### `Reference Mail Server`

### Steps:

-   registration for a new account
-   go to demo message
-   inside integration fird laravel option.
-   And copy the below code segment and past it to .env file like above mentioned note.

---

---

# **User Registration | Role Assign | role_user pivot table | Many to Many relationship**

--

`users` table

```php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('cartitems')->nullable();
            $table->longText('wishlist')->nullable();
            $table->unsignedBigInteger('discount')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
```

> First I created a `users` table.

> Notice: there is no foreign key which is `role_id` here. For User have role_id through the roles table.

`roles` table

```php
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->timestamps();
        });
```

> This is the `roles` table

`role_user` table

```php
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->timestamps();
        });
```

> Here I created the intermediate table called `pivot` table.

> This table make relation between `users` and `roles` table. So we dont need to use any foreign key in `users` and `roles` table.

`User` model

```php
public function role()
{
    return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
}
```

> THis is a relation between `User` and `Role`. User can create role through `role` method.

**Finally**

`Register` Controller

```php
    protected function create(array $data)
    {
        $role = Role::where('name', 'customer')->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(60),
        ]);

        $user->role()->attach($role->id);

        return $user;
    }
```

> I don't actually have to provide the `user_id` and `role_id` separately, just provide the `role_id` and laravel will take care of the rest. `$user->role()->attach($role->id);`

---

# **Some Basic Seeder Uses for User - Role => role_user**

---

## Step 1

Create some Role Seeder

`RoleSeeder.php`

```php
    public function run()
    {
        Role::create(['name' => 'super_admin', 'display_name' => 'Super Admin']);
        Role::create(['name' => 'admin', 'display_name' => 'Admin']);
        Role::create(['name' => 'seller', 'display_name' => 'Seller']);
        Role::create(['name' => 'customer', 'display_name' => 'Customer']);
    }
```

`SuperAdminSeeder.php`

```php
    public function run()
    {
        #Super Admin Seeder
        $role = Role::where('name', 'super_admin')->first();
        $user = User::create([
            'name' => 'Md. Imrul Hasan',
            'email' => 'imrulhasan273@gmail.com',
            'password' => Hash::make('imrulhasan'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);
    }
```

`UserSeeder.php`

```php
    public function run()
    {
        #Admin Seeder
        $role = Role::where('name', 'admin')->first();
        $user = User::create([
            'name' => 'Imrul Hasan',
            'email' => '16101034@uap-bd.edu',
            'password' => Hash::make('imrulhasan'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);

        #Seller Seeder
        $role = Role::where('name', 'seller')->first();
        $user = User::create([
            'name' => 'Brishty Hoque',
            'email' => 'brishtyhoque273@gmail.com',
            'password' => Hash::make('0000000000'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);

        #Customer Seeder
        $role = Role::where('name', 'customer')->first();
        $user = User::create([
            'name' => 'Towhidul Islam',
            'email' => 'towhid@gmail.com',
            'password' => Hash::make('0000000000'),
            'remember_token' => Str::random(60),
        ]);
        $user->role()->attach($role->id);
    }
```

## Step 2

`DatabaseSeeder.php`

```php
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(UserSeeder::class);
    }
```

---

# **Admin Dashboard | Shop Panel**

---

**Shop Panel In Dashboard**

`views/shops.blade.php`

```php
@php
$active='shops';
@endphp
@extends('layouts.backend')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card card-plain">
        <div class="card-header card-header-primary">
          <h4 class="card-title mt-0">Shop Table</h4>
          <p class="card-category"> Here is a subtitle for this table</p>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead class="">
                <th>
                  ID
                </th>
                <th>
                  Name
                </th>
                <th>
                  Owner
                </th>
                <th>
                  Is Active
                </th>
                <th>
                    Ratings
                </th>
                <th>
                    Location
                </th>
                <th>
                    Edit
                </th>
              </thead>
              @foreach ($shops as $shop)
              <tbody>
                <tr>
                  <td>
                    {{$shop->id}}
                  </td>
                  <td>
                    {{$shop->name}}
                  </td>
                  <td>
                    {{$shop->seller->name}}
                  </td>
                  <td>
                    @if($shop->is_active)
                    Yes
                    @else
                    No
                    @endif
                  </td>
                  <td>
                    {{$shop->rating}}
                  </td>
                  <td>
                    {{$shop->location->address}}
                  </td>
                  <td>
                    <a href="{{route('shops.edit',[$shop->id])}}">Edit</a>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
```

> After Clicking on Edit button

`ShopController.php`

```php
    public function edit(Shop $shop)
    {
        $locations = Location::all();

        return view('dashboard.shops.edit', compact(['shop', 'locations']));
    }
```

`views/shops/edit.blade.php`

```php
@php
$active='shops';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Shop</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">
        <form method="POST" action="{{route('shops.update')}}">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Shop id</label>
                      <input name="shop_id" value="{{ $shop->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <input name="shop_name" value="{{ $shop->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Owner</label>
                        <input name="seller_name" value="{{ $shop->seller->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="bmd-label-floating">Is Active</label>
                        <select  name="is_active" class="form-control">
                            <option style="color: rgb(20, 211, 77)" value="1" {{ $shop->is_active == '1' ? 'selected':'' }}>Active</option>
                            <option style="color: rgb(231, 9, 9)" value="0" {{ $shop->is_active == '0' ? 'selected':'' }}>In-active</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Description</label>
                        <input name="description" value="{{ $shop->description }}" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="bmd-label-floating">Rating</label>
                    <input name="rating" value="{{ $shop->rating }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Location</label>
                        <select name="location" class="form-control">
                            @foreach ($locations as $location)
                                <option style="color: rgb(19, 146, 219)" value="{{$location->id}}" {{ $shop->location_id == $location->id ? 'selected':'' }}>{{$location->address}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Shop</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>@endsection
```

> After CLick on Update button.

`ShopController.php`

```php
    public function update(Request $request, Shop $shop)
    {
        $updatingShop = Shop::where('id', $request->shop_id)->first();
        if ($updatingShop) {
            $updatingShop->update([
                'is_active' => $request->is_active,
                'description' => $request->description,
                'location_id' => $request->location
            ]);
        }

        return Redirect::route('dashboard.shops');
    }
```

---

---

# **Admin Dashboard | Access | Role**

---

## Step 1

`Middlewere/RoleChecker.php`

```php
public function handle($request, Closure $next, $super_adminRole, $adminRole,  $sellerRole)
{
    $roles = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];

    if (in_array($super_adminRole, $roles)) {
        return $next($request);
    } else if (in_array($adminRole, $roles)) {
        return $next($request);
    } else if (in_array($sellerRole, $roles)) {
        return $next($request);
    }

    return Redirect::route('home');
}
```

## Step 2

`Kernel.php`

```php
protected $routeMiddleware = [
    'roleChecker' => \App\Http\Middleware\RoleChecker::class,
];
```

## Step 3

`DashboardController.php`

## **4 Variations**

```php
function __construct()
{
    $this->middleware(['roleChecker:super_admin,admin,seller']);
}
```

> Here `super_admin`, `admin` and `seller` can access

```php
function __construct()
{
    $this->middleware(['roleChecker:super_admin,null,null']);
}
```

> Here `super_admin` can access

```php
function __construct()
{
    $this->middleware(['roleChecker:null,admin,null']);
}
```

> Here `admin` can access

```php
function __construct()
{
    $this->middleware(['roleChecker:null,null,seller']);
}
```

> Here `seller` can access

---

---

# **Create a Shop | Request for a Shop**

---

## Initially

`shops` table

```php
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_active')->default(false);
            $table->text('description')->nullable();
            $table->float('rating')->nullable();
            $table->unsignedBigInteger('location_id');

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->timestamps();
        });
```

`Shop.php` [Model]

```php
protected $fillable = ['name', 'is_active', 'description', 'location_id'];

public function owner()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function location()
{
    return $this->belongsTo(Location::class, 'location_id');
}
```

## Step 1

Make a button for creating a new shop

```php
<a href="{{ route('shops.create') }}" class="site-btn">Open Your Shop</a>
```

## Step 2

```php
Route::get('/shops/create', 'ShopController@create')->name('shops.create')->middleware('auth');         //auth
```

## Step 3

`ShopController.php`

```php
public function create()
{
    $locations = Location::all();
    return view('shops.create', compact('locations'));
}
```

## Step 4

`views/shops/create.blade.php`

```php
@extends('layouts.frontend')
@section('content')
<div style="margin-bottom: 30px;margin-top:30px" class="container">
    <div class="container">
        <h2>Submit Your Shop</h2>

        <form action="{{route('shops.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name of Shop</label>
                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="description">Location</label>
                <select name="location" class="form-control">
                    @foreach ($locations as $location)
                        <option style="color: rgb(19, 146, 219)" value="{{$location->id}}" >{{$location->address}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
```

## Step 5

`web.php`

```php
Route::post('/shops/store', 'ShopController@store')->name('shops.store')->middleware('auth');         //auth
```

## Step 6 :this steps require `Step 7`

```php
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required'
        ]);

        //Save to db
        $shop = auth()->user()->shop()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'location_id' => $request->input('location')
        ]);

        //send mail to admin
        $admins = User::whereHas('role', function ($q) {
            $q->where('name', 'admin');
        })->get();

        Mail::to($admins)->send(new ShopActivationRequest($shop));

        return redirect()->route('home')->with('message', 'Create shop request sent');
    }
```

> Mail will be sent to the admins through ShopActivationRequest.php

## Step 7

### Create a mailing sytstem to mail a create shop request to admins

Create a new mail first

```cmd
~$ php artisan make:mail ShopActivationRequest --markdown=mail.admin.shop-activation
```

`Mail/ShopActivationRequest.php`

```php
    public $shop; //creating public variable
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop; //local_variable <-- parameter
    }
```

> Now contructor will take the $shop instance. And now we can access the variable $shop in shop-activation.blade.php views.

`mail/admin/shop-activation.blade.php`

```php
@component('mail::message')
# Shop Activation Request

Please activate shop. Here are shop details.

Shop Name : {{$shop->name}}
Shop Owner : {{$shop->owner->name}}


@component('mail::button', ['url' => url('/admin/shops')])
Manage Shops
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
```

> `url = /admin/shops`. Currently we dont have the page for shops in admin panel.

---

# Elequent Model Observer

## Now I need to send message to User who's shop is activated. And Also give them a dashboard to add new products.

> **Motive:** Observer Class is a **Design Pattern** in Software Engineering which task is to observe the model. When any changes then Observer class will send an Event listener to Alert there occurs some chanegs.

> [Documentation](https://laravel.com/docs/7.x/eloquent#events)

> **Goal:** When in `shops` table the value of column `is_active` is made to `active` from `inactive` then I need to fire the email to user.

> I need observer class so I can find all these information on documentation in event section of Elequent.

> Make sure we have `$fillable` in `Shop` model and we already set the `columns` which is in `shops` table.

> Make sure we have a `seller()` function in `Shop` model and this `seller` function is for `User` model.

## Step 1

Run below command to Create observer class for Shop Model

```cmd
~$ php artisan make:observer ShopObserver --model=Shop
```

-   Now we have `DealOcean\app\Observers\ShopObserver.php`

`ShopObserver.php`

```php
<?php

namespace App\Observers;

use App\Shop;

class ShopObserver
{
    /**
     * Handle the shop "created" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function created(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "updated" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function updated(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "deleted" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function deleted(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "restored" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function restored(Shop $shop)
    {
        //
    }

    /**
     * Handle the shop "force deleted" event.
     *
     * @param  \App\Shop  $shop
     * @return void
     */
    public function forceDeleted(Shop $shop)
    {
        //
    }
}
```

## Step 2

Before doing that, we need to tell laravel that you need to use this class whenever model events related to Shop is updated. To register an observer, use the observe method on the model you wish to observe. You may register observers in the boot method of one of your service providers. In this example, we'll register the observer in the AppServiceProvider:

Go to `AppServiceProvider`

`AppServiceProvider.php`

```php
use App\Shop;
use App\Observers\ShopObserver;
```

```php
public function boot()
{
    Shop::observe(ShopObserver::class);
}
```

## Step 3

`ShopObserver.php`

```php
public function updated(Shop $shop)
{
    $roles = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
    if (in_array('super_admin', $roles) || in_array('admin', $roles)) {

        if ($shop->getOriginal('is_active') == false && $shop->is_active == true) {

            #send mail to customer.
            Mail::to($shop->seller->email)->send(new ShopActivated($shop));

            #make change role from customer to seller
            $prevRole = Role::where('name', 'customer')->first();
            $nextRole = Role::where('name', 'seller')->first();

            $det = $shop->seller->role()->detach($prevRole);

            if ($det) {
                $shop->seller->role()->attach($nextRole);
            }
        } else {
            dd('shop change to inactive');
        }
    }
}
```

## Step 4

Make mail system to Customers

```cmd
~$ php artisan make:mail ShopActivated --markdown=mail.customer.shop-activated
```

## Step 5

`Mail/ShopActivated.php`

```php
public $shop;
public function __construct(Shop $shop)
{
    $this->shop = $shop;
}
```

## Step 6

`mail/customer/shop-activated.blade.php`

```php
@component('mail::message')

# Congratulations

Your shop is now active

@component('mail::button', ['url' => route('dashboard.shops')])
Visit Your Shop
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
```

> Now the Customer can visit his activated shop in `dashboard.shops` route.

> Now the `customer` is made to `seller` and can visit **/admin** as a seller.

---

## Now there is a major security issue after giving seller a admin panel.

> Currently a seller can view all the shops even if the shop is not belong to him. Its a security issue. We need to fix the problem by modifyting voyager controller.

> If I just put a logic inside shops panel to restrict other shops to view, it is not good enough. Because although those shops will not appear in shops panel we can manually view and update those shops just changing the `url` after going to seller's shop.

> So we need to use something different approach too...........

> Solution: **Restrict in Shop Panel with role** + **Policty Class**

---

# Tips

---

```php
$roles  = $shop->seller->role;
$subsetRole = $roles->map->only(['id', 'name']);
$arrRole = $subsetRole->toArray();
$authName = $arrRole[0]['name'];
dd($authName);
```

---

# **Creating Policy Class**

---

## Step 1

Run the below command to make a policy class for Shop

```cmd
~$ php artisan make:policy ShopPolicy --model=Shop
```

> here Policy name is `ShopPolicy`. And this policy is for `Shop` model.

-   M-Laravel-Ecommerce\app\Policies\ShopPolicy.php

`ShopPocicy.php`

```php
<?php

namespace App\Policies;

use App\Shop;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function view(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function update(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function delete(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function restore(User $user, Shop $shop)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Shop  $shop
     * @return mixed
     */
    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
```

## Step 2

Register the policy in Providers policy array.

`Providers/AuthServiceProvider.php`

```php
protected $policies = [
        App\Shop::class => App\Policies\ShopPolicy::class,
];

public function boot()
{
    $this->registerPolicies();
}
```

## Step 3

Set a policy on Edit Operation for a shop

`ShopPolicy.php`

```php
public function edit(User $user, Shop $shop)
{
    return $user->id == $shop->user_id;
}
```

> If auth user is the shops user then it will return true. Hence He can edit.

## Step 4

`ShopController.php`

```php
public function edit(Shop $shop)
{
    $this->authorize('edit', $shop);

    $locations = Location::all();

    return view('dashboard.shops.edit', compact(['shop', 'locations']));
}
```

> This edit function will need to `authorized` from policy. and the `$shop` object is passed which is from `Shop` model

> Now only owner can edit the shop.

## Step 5

`ShopPolicy.php`

```php
public function before($user, $ability)
{
    $roles = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
    if (($roles[0] == 'admin') || ($roles[0] == 'super_admin')) {
        return true;
    }
}
```

> `$roles` will get the role of `Auth` user

> This function should put on Top of all the function of `ShopPolicy` so that every time it will execute first.

> When the Auth user is an `Admin` or `Super Admin` then no matter which shop it is. He can do every task he wants.

> This before method check first if the user has a role of admin or not. If he is admin then the user will have all the controlls in Shop page. Now for admin the policty is disabled. meaning Admin can do all the task in Shop Panel.

Note: Policy defination will be same.

---

## Now I will give a policy for `view` as well like `edit`

Repeating `Step 3` and `Step 4`

## Step 3

```php
public function view(User $user, Shop $shop)
{
    return $user->id == $shop->user_id;
}
```

## Step 4

Shop Panel View in Admin Dashboard

`views/dashboard/shops.blade.php`

```php
@foreach ($shops as $shop)
@can('view', $shop)
<tbody>
//
</tbody>
@endcan
@endforeach
```

> here new `syntax` => `@can('view', $shop)`

> `view` is a method inside `ShopPolicy`. And `$shop` is a instance of `Shop` model passed through it.

---

## Now I will give a policy for `delete` as well like `edit` and `view`

## Step 3

```php
public function delete(User $user, Shop $shop)
{
    return false;
}
```

> Return false. Because I don't want to give seller to controll delete opreration.

> But admin can view it as for `before` function on top of `ShopPolicy`

## Step 4

`views/dashboard/shops.blade.php`

Custom `php` codes for getting the `role` of `Auth` user.

```php
@php
$authRole = Auth::check() ? Auth::user()->role->pluck('name')->toArray() : [];
@endphp
```

`thead`

```php
<th>
    @if(($authRole[0] == 'admin') || ($authRole[0] == 'super_admin'))
    Delete
    @endif
</th>
```

`tbody`

```php
<td>
    @can('delete', $shop)
        <a href="{{route('shops.destroy',[$shop->id])}}">Delete</a>
    @endcan
</td>
```

---

Now we need to make `route` and `function` for delete operation.

## Add Route

`web.php`

```php
Route::get('/admin/shops/{shop}/destroy', 'ShopController@destroy')->name('shops.destroy')->middleware('auth')->middleware(['roleChecker:super_admin,admin,seller']);  //admin
```

## Add Function in Controller

`ShopController.php`

```php
public function destroy(Shop $shop)
{
    $prevRole = Role::where('name', 'seller')->first();
    $nextRole = Role::where('name', 'customer')->first();
    $det = $shop->seller->role()->detach($prevRole);
    if ($det) {
        $shop->seller->role()->attach($nextRole);
    }

    $deleteShop = DB::table('shops')->where('id', $shop->id)->delete();

    return Redirect::route('dashboard.shops');
}
```

---

# **Product Management**

---

Create a Product Policy

```cmd
php artisan make:policy ProductPolicy --model=Product
```

## Everything same as `Shop Panel`

-   Creating `ProductPolicty`
-   Creating View Operaion
-   Creating Edit Operaion
-   Creating Update Operaion
-   Creating Delete Operation

## As Proudct `Update Operation` is Slightly Differnt as there is a Image.

`views/dashboard/products/edit.blade.php`

```php
@php
$active='products';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Edit Product</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('products.update')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">
                <div class="col-md-5" hidden>
                    <div class="form-group">
                      <label class="bmd-label-floating">Product id</label>
                      <input name="product_id" value="{{ $product->id }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Name</label>
                        <input name="product_name" value="{{ $product->name }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Price</label>
                        <input name="product_price" value="{{ $product->price }}" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Shop ID</label>
                        <input name="shop_id" value="{{ $product->shop_id }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <input name="shop_name" value="{{ $product->shop->name }}" type="text" class="form-control" disabled>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Description</label>
                        <input name="product_description" value="{{ $product->description }}" type="text" class="form-control">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <img style="height: 3%" src="{{asset('/storage/products/'.$product->cover_img)}}" alt="">
                    </div>
                    <input name="product_img" type="file" class="form-control">
                </div>
            </div>

            <button name="submit" type="submit" class="btn btn-primary pull-right">Update Product</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection
```

`Product.php`

```php
protected $fillable = ['name', 'price', 'description', 'cover_img'];
```

> Mass assignment is required

`ProductController.php`

```php
    public function update(Request $request, Product $product)
    {
        # When update with a new photo
        if ($request->hasFile('product_img')) {

            $this->deleteOldImage($request->product_id);

            $imageName = $this->storeNewImage($request->file('product_img'));

            $updatingProduct = Product::where('id', $request->product_id)->first();
            if ($updatingProduct) {
                $updatingProduct->update([
                    'name' => $request->product_name,
                    'price' => $request->product_price,
                    'description' => $request->product_description,
                    'cover_img' => $imageName,
                ]);
            }

            return Redirect::route('dashboard.products');
        }


        # When no photo is updated
        $updatingProduct = Product::where('id', $request->product_id)->first();
        if ($updatingProduct) {
            $updatingProduct->update([
                'name' => $request->product_name,
                'price' => $request->product_price,
                'description' => $request->product_description,
            ]);
        }

        return Redirect::route('dashboard.products');
    }
```

> **Case 1:** If user input a `file` then `delete` the old image and `store` the new image and `update` the name of the image into database along with others fields.

> **Case 2:** If user `don't` input an image then just update the other information with the input fields

> Below is the two protected function which is for `delete` and `store` operation.

```php
    protected function deleteOldImage($prod_id)
    {
        $oldImg = DB::table('products')->where('id', $prod_id)->pluck('cover_img')->toArray();
        $name = $oldImg[0];
        Storage::delete('/public/products/' . $name);
    }
```

```php
    protected function storeNewImage($file)
    {
        $filenameWithExt = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $file->storeAs('public/products', $fileNameToStore);

        return $fileNameToStore;
    }
```

---

## Proudct `Store Operation` [Every other operations looks similar to Shop Management]

---

`views/dashboard/products/add.blade.php`

```php
@php
$active='products';
@endphp
@extends('layouts.backend')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Product</h4>
          <p class="card-category">Complete your Shop</p>
        </div>
        <div class="card-body">

        <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Name</label>
                        <input name="product_name" value="" type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating"> Price</label>
                        <input name="product_price" value="" type="text" class="form-control">
                    </div>
                </div>

                @if (($role[0] == 'admin') || ($role[0] == 'super_admin'))
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <select name="shop_id" class="form-control">
                            @foreach ($shops as $shop)
                                <option style="color: rgb(19, 146, 219)" value="{{$shop->id}}" {{ $shop->user_id == $user_id ? 'selected':'' }}>{{$shop->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <div class="col-md-6" hidden>
                    <div class="form-group">
                        <label class="bmd-label-floating">Shop Name</label>
                        <select name="shop_id" class="form-control">
                            @foreach ($shops as $shop)
                                <option style="color: rgb(19, 146, 219)" value="{{$shop->id}}" {{ $shop->user_id == $user_id ? 'selected':'' }}>{{$shop->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="bmd-label-floating">Product Description</label>
                        <input name="product_description" value="" type="text" class="form-control">
                    </div>
                </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        </div>
                        <input name="product_img" type="file" class="">
                    </div>
                </div>

                <button name="submit" type="submit" class="btn btn-primary pull-right">Add Product</button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>

</div>
@endsection
```

`ProductController.php`

```php
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'shop_id' => 'required',
            'product_img' => 'required',
        ]);

        $imageName = $this->storeNewImage($request->file('product_img'));

        $addProduct = Product::create([
            'name' => $request->input('product_name'),
            'price' => $request->input('product_price'),
            'description' => $request->input('product_description'),
            'shop_id' => $request->input('shop_id'),
            'cover_img' => $imageName
        ]);

        return Redirect::route('dashboard.products');
    }
```

---

# **Coupon Management**

---

## Exactly same as `Product Manegement`

-   Note: I make the middlewere of these route to `middleware(['roleChecker:super_admin,admin,null'])`

-   So seller have no way to visit coupons panel `(nulled)`

---

# **Order Management**

---

## Same as Shop Management

`OrderController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderPaid;
use Carbon\Traits\Timestamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order_products = DB::table('order_product')->where('order_id', $order->id)->get();

        $products_id = DB::table('order_product')->where('order_id', $order->id)->pluck('product_id')->toArray();

        $products = DB::table('products')->whereIn('id', $products_id)->get();

        return view('dashboard.orders.edit', compact(['order', 'order_products', 'products']));
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

        $updatingOrder = Order::where('id', $request->order_id)->first();
        if ($updatingOrder) {
            $updatingOrder->update([
                'is_paid' => $request->is_paid,
                'status' => $request->status,
            ]);
        }

        return Redirect::route('dashboard.orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $delete_order = DB::table('orders')->where('id', $order->id)->delete();
        return Redirect::route('dashboard.orders');
    }
}
```

---

# **Region Panel**

---

### same as Coupon Panel

`RegionController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RegionController extends Controller
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

    public function add()
    {
        return view('dashboard.regions.add');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'region_name' => 'required',
        ]);

        $addProduct = Region::create([
            'name' => $request->input('region_name'),
        ]);

        return Redirect::route('dashboard.regions');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        // dd('edit');
        return view('dashboard.regions.edit', compact(['region']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $updatingRegion = Region::where('id', $request->region_id)->first();
        if ($updatingRegion) {
            $updatingRegion->update([
                'name' => $request->region_name,
            ]);
        }

        return Redirect::route('dashboard.regions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        DB::table('regions')->where('id', $region->id)->delete();
        return Redirect::route('dashboard.regions');
    }
}
```

---

---

# **Country Panel**

---

### same as Coupon Panel

`CountryController.php`

```php
<?php

namespace App\Http\Controllers;

use App\Region;
use App\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
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

    public function add()
    {
        $regions = Region::all();

        return view('dashboard.countries.add', compact('regions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_name' => 'required',
            'region_id' => 'required'
        ]);

        //Save to db
        $country = Country::create([
            'name' => $request->input('country_name'),
            'region_id' => $request->input('region_id'),
        ]);


        return Redirect::route('dashboard.countries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        $regions = Region::all();

        return view('dashboard.countries.edit', compact(['country', 'regions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $updatingCountry = Country::where('id', $request->country_id)->first();
        if ($updatingCountry) {
            $updatingCountry->update([
                'name' => $request->country_name,
                'region_id' => $request->region_id,
            ]);
        }

        return Redirect::route('dashboard.countries');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $deleteCountry = DB::table('countries')->where('id', $country->id)->delete();

        return Redirect::route('dashboard.countries');
    }
}
```

---

---

# **Shop Create Request | Ajax Method **

---

`ShopController.php`

```php
public function create()
{
    $regions = Region::all();
    $countries = Country::all();
    return view('shops.create', compact('regions', 'countries'));
    # findCountry is used in this function
}
```

> all the data of `Country` and `Region` is passed through the blade file.

`views/shops/create.blade.php`

```php
@extends('layouts.frontend')
@section('content')
<div style="margin-bottom: 30px;margin-top:30px" class="container">
    <div class="container">
        <h2>Submit Your Shop</h2>
        <form action="{{route('shops.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="name">Name of Shop</label>
                <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder="">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="" rows="3"></textarea>
            </div>

            <label for="region">Region</label>
            <select name="region" class="form-control RegionAjax" id="">
                <option value="0" disabled="true" selected="true">Select-</option>
                @foreach($regions as $region)
                    <option value="{{$region->id}}">{{$region->name}}</option>
                @endforeach
            </select>

            <label for="country">Country</label>
            <select name="country" class="form-control CountryAjax">
                <option value="0" disabled="true" selected="true">Select</option>
            </select>

            <div class="form-group">
                <label for="address">Address</label>
                <input name="address" type="text" class="form-control"  aria-describedby="helpId" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
```

> Here `name="region"` field is the key to find the countries. All the countries will be displayed on `name="country"` field based on selected `region`.

> We can set the `address` field of our own in the text field.

Below is the Ajax Code.

`layouts/frontend.blade.php`

```js
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            //below function executes if there is a change in the text field class named `RegionAjax`
            $(document).on('change','.RegionAjax',function(){
                //take the `region_id` from this method. and .val(). -> this .val() get the value from value atttibute of the text field.
                var region_id=$(this).val();
                //parent of this tag..... not necessary in this code
                var div=$(this).parent();
                //initially `option` variable is empty. [op]
                var op=" ";
                //now the ajax code
                $.ajax({
                    //method type: get
                    type:'get',
                    //url is given in name route.
                    url:"{{ route('countryListRoute') }}",
                    //this is the data passing in the url to the function
                    data:{'id':region_id},
                    //when the function return the json data successfully the json data inside the function parameter
                    success:function(data){
                        //the options are put in the `op` variable.
                        op+='<option value="0" selected disabled>Choose Country</option>';
                        //loop through the json data and take the id as value and name as display in the `op` variable.
                        for(var i=0;i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                       }
                       //let first empty the existing tag value of class named `CountryAjax`
                       div.find('.CountryAjax').html(" ");
                       //then append the `op` variable into the `CountryAjax`
                       div.find('.CountryAjax').append(op);
                    },
                    error:function(){
                    }
                });
            });
        });
    </script>
```

> Here `RegionAjax` is the class name of `Region` field in the blade file

> Here `CountryAjax` is the class name of `Country` field in the blade file

`web.php`

```php
Route::get('/shops/findCountry', 'ShopController@findCountry')->name('countryListRoute');
```

> **ajax** request is send to `findCountry` function in `ShopController` to get the countries of the selected `region`.

`ShopController.php`

```php
public function findCountry(Request $request)
{
    $data = Country::select('id', 'name')->where('region_id', $request->id)->take(100)->get();
    return response()->json($data);
}
```

> In this function get the countries `id` and `name` of the selected `region`.

> Here we just get the top 100 rows. We can change the value.

---

# **Role Panel**

---

---

# **User Panel**

---

---

# **role_user** Panel

---
