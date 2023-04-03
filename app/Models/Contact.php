<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;


    protected $table = 'contacts';

    protected $fillable = [
        'name',
        'category_id',
        'description'
    ];

    public $timestamps = false;

    // function __construct(){
    //     dd('a');
    // }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
