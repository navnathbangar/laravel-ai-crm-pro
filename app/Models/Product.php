<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [

        'sku',

        'barcode',

        'product_name',

        'slug',

        'category',

        'brand',

        'unit',

        'cost_price',

        'selling_price',

        'stock',

        'minimum_stock',

        'image',

        'description',

        'status',

        'created_by'

    ];

    protected $casts = [

        'cost_price' => 'decimal:2',

        'selling_price' => 'decimal:2',

        'stock' => 'integer',

        'minimum_stock' => 'integer',

    ];

    /**
     * Boot Method
     */

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {

            if (empty($product->slug)) {

                $product->slug = Str::slug($product->product_name);

            }

            if (empty($product->sku)) {

                $product->sku = 'PRD-' . strtoupper(Str::random(8));

            }

        });

    }

    /**
     * Active Products Scope
     */

    public function scopeActive($query)
    {
        return $query->where('status','Active');
    }

    /**
     * Image Accessor
     */

    public function getImageUrlAttribute()
    {
        if ($this->image) {

            return asset('storage/'.$this->image);

        }

        return asset('images/no-image.png');

    }

    /**
     * Created By
     */

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}