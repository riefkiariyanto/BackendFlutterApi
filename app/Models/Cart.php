<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Cart extends Model
    {
        use HasFactory;

        protected $table = 'cart';

        protected $fillable =[
         'id','id_products', 'id_biodata_toko', 'id_user','qty','date', 'status'
        ];

        public function product()
        {
            return $this->belongsTo(Product::class, 'id_products');
        }

    }
