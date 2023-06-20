<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'description',
        'product_image',
        'link_yt',
        'link_manual', 
        'link_driver'
    ];

    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
