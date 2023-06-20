<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSelledHistoric extends Model
{
    use HasFactory;

    
    protected $table = 'product_selled_historic';
    public $timestamps = false;

    protected $fillable = [
        'old_user_id',
        'new_user_id',
        'product_selleds_id',
    ];

}
