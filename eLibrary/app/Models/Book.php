<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class,"created_by_user_id");
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
