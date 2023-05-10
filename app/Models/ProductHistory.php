<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    
    protected $table = 'product_selleds_history';
    public $timestamps = true;

    protected $fillable = [
        'old_user_id',
        'new_user_id',
        'product_selleds_id',
    ];

}
