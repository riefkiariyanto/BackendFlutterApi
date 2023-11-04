<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataShop extends Model
{
    use HasFactory;

    protected $table = 'biodata_toko';

    public $timestamps = false;
    
    protected $fillable =[
        'id_clients', 'store_name','no_telp','latitude','longtitude','logo','front_store'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'idclient', 'id_clients');
    }
    
    
}
