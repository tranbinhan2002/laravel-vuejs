<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function orderProduct()
    {
        return $this->belongsToMany(OrderProduct::class);
    }
}
