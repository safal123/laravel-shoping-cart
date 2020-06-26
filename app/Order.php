<?php

namespace App;

use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    // If we want to customize the name of columns used to
    // store timestamps we can change as below
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';

    protected $fillable = [
        'user_id',
        'billing_email',
        'billing_name',
        'billing_address',
        'billing_phone',
        'billing_name_on_card',
        'billing_discount_code',
        'billing_discount',
        'billing_subtotal',
        'billing_tax',
        'billing_total',
        'payment_method',
        'shipped',
        'error',
    ];

    // Order belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order has many products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
            ->withPivot('quantity', 'price');
    }
}
