<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_number',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'date_of_birth',
        'status',
        'total_spent',
        'total_orders'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'total_spent' => 'decimal:2'
    ];

    // Generate unique customer number
    public static function generateCustomerNumber()
    {
        do {
            $customerNumber = 'CUST' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('customer_number', $customerNumber)->exists());
        
        return $customerNumber;
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'btn-success-custom',
            'inactive' => 'btn-danger-custom',
            default => 'btn-secondary-custom'
        };
    }
}
