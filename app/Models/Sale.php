<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    const PAYMENT_METHODS = [
        'cash' => 'Cash',
        'credit_card' => 'Credit Card',
        'debit_card' => 'Debit Card',
    ];

    const PAYMENT_STATUS = [
        'paid' => 'Paid',
        'not_paid' => 'Not Paid',
    ];

    const DELIVERY_STATUS = [
        'delivered' => 'Delivered',
        'not_delivered' => 'Not Delivered',
    ];

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
        'payment_method',
        'payment_status',
        'delivery_status',
        'delivery_address',
        'reference',
        'price',
        'creator_id'
    ];

    protected static function booted()
    {
        static::creating(function ($sale) {
            $sale->creator_id = auth()->id();
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
