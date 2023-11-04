<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'biodata_toko';

    protected $fillable =[
        'id_clients', 'store_name','address','no_telp','latitude','longitude','logo', 'front_store'
    ];
}
