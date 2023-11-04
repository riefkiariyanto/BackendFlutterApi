<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable =[
        'idclient', 'name','category','price','image','description','qty'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'idclient', 'idclient');
    }
    public function shop()
    {
        return $this->belongsTo(BiodataShop::class, 'idclient', 'id_clients');
    }
  
}
  