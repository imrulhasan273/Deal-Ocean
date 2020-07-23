# **Deal Ocean**

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
