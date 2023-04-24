<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSelled extends Model
{
    use HasFactory;

    protected $table = 'product_selleds';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'user_id',
        'buy_date',
        'serie_number'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
