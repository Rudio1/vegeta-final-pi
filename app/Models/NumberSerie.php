<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class numeroSerie extends Model
{
    use HasFactory;

    protected $table = 'number_serie';
    public $timestamps = true;

    protected $fillable = [
        'product_id'
    ];
}
