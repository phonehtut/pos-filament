<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{

    protected $fillable = [
        'name',
        'price',
        'productId',
        'description',
        'image',
        'tag'
    ];

    protected $casts = [
        'tag' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->productId)) {
                $model->productId = str_pad(self::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}
