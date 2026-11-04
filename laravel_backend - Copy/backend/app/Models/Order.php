<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'products',
        'order_date',
        'status',
        'total_amount',
        'shipping_address',
        'billing_address',
        'payment_method',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'order_date' => 'datetime',
        'products' => 'array'
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('order_number', $orderNumber)->exists());
        
        return $orderNumber;
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'btn-warning-custom',
            'processing' => 'btn-primary-custom',
            'shipped' => 'btn-info-custom',
            'completed' => 'btn-success-custom',
            'cancelled' => 'btn-danger-custom',
            default => 'btn-secondary-custom'
        };
    }

    // Get formatted products string
    public function getProductsStringAttribute()
    {
        if (is_array($this->products)) {
            return implode(', ', array_column($this->products, 'name'));
        }
        return $this->products;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
