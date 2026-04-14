<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    
class Products extends Model

    
{
    protected $fillable = [
            'vendor_id',
            'product_title',
            'product_description',
            'product_quantity',
            'product_price',
            'product_category',
            'product_image'


            

        ];
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
