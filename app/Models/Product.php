<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'slug', 'photo', 'price', 'about', 'category_id'];

    public function detail_transaction(): HasOne
    {
        return $this->hasOne(TransactionDetail::class, 'product_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function getCategoryNameAttribute()
    {
        return $this->category ? $this->category->name : '';
    }
}
