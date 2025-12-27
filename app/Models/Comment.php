<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'post_id',  
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
