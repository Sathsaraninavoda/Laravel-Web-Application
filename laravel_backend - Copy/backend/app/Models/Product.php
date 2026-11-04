<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'name',
        'description',
        'category',
        'price',
        'cost_price',
        'stock_quantity',
        'min_stock_level',
        'image_path',
        'sku',
        'status',
        'weight',
        'dimensions',
        'tags',
        'featured'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:3',
        'featured' => 'boolean'
    ];

    // Generate unique product code
    public static function generateProductCode()
    {
        do {
            $productCode = 'PROD' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('product_code', $productCode)->exists());
        
        return $productCode;
    }

    // Get status badge class
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'active' => 'btn-success-custom',
            'inactive' => 'btn-secondary-custom',
            'out_of_stock' => 'btn-danger-custom',
            default => 'btn-secondary-custom'
        };
    }

    // Get stock status
    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity <= 0) {
            return 'Out of Stock';
        } elseif ($this->stock_quantity <= $this->min_stock_level) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }

    // Get stock status badge class
    public function getStockBadgeAttribute()
    {
        if ($this->stock_quantity <= 0) {
            return 'btn-danger-custom';
        } elseif ($this->stock_quantity <= $this->min_stock_level) {
            return 'btn-warning-custom';
        } else {
            return 'btn-success-custom';
        }
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('assets/' . $this->image_path) : asset('assets/default-product.jpg');
    }

    // Get profit margin
    public function getProfitMarginAttribute()
    {
        if ($this->cost_price && $this->cost_price > 0) {
            return (($this->price - $this->cost_price) / $this->cost_price) * 100;
        }
        return 0;
    }
}
