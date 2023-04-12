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
        'email_user',
        'product_id',
        'count_assessment',
        'avg_assessment'
    ];

    public $timestamps = true;
    
    public function userforeign(){
        return $this->belongsTo(User::class, 'email_user', 'email');
    }

    public function productForeign(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
