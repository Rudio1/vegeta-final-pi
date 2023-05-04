<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;


    protected $table = 'comments_posts';

    protected $fillable = [
        'comment',
        'assessment',
        'user_id',
        'product_id',
        'count_assessment',
        'avg_assessment'
    ];

    public $timestamps = true;
    
}
