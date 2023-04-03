<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categoria_fale_conosco';

    protected $fillable = [
        'nome'
    ];

    public $timestamps = false;
}
