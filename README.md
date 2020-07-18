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

## One to One

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
