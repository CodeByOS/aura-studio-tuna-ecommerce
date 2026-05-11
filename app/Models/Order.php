<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User ; 
use App\Models\OrderItem ;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Order extends Model
{
    

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_status',
        'payment_method',
        'shipping_address',
        'billing_address',
        'notes',
        'coupon_code',
        'discount_amount',
    ];


    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function items(): HasMany { return $this->hasMany(OrderItem::class); }


    //this is used automatically in  research : 
    public function getRouteKeyName(): string
    {
        return 'order_number';
    }

}
