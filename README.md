# **Deal Ocean**

---

# **Schema Diagram**

---

![](MARKDOWN_NOTES/ER.png)

---

# **Elequent Relationship**

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
php artisan make:migration create_tableName_table --create=tableName
```

---
