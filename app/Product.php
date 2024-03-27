<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_price',
        'product_discount',
        'product_image',
        'product_color',
        'size_id',
        'product_description',
        'product_quantity',
        'category_id'
    ];
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes');
    }
}
