<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function shop()
    {
        return $this->belongsTo(BiodataShop::class, 'id_client', 'id_clients');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_products');
    }
    protected $table = 'transaction';

    public $timestamps = false;

    protected $fillable = ['code', 'id_cart', 'id_client', 'id_user', 'status', 'date'];
}

    