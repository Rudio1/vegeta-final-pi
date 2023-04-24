<?php

namespace App\Models;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;

    public function contact(){
        return $this->belongsTo(Contact::class);
    }
}
