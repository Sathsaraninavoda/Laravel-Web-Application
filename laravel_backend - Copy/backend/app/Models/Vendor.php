<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'status',
        'contact_person',
        'business_type',
        'tax_number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'bg-success',
            'pending' => 'bg-warning',
            'inactive' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
