<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory,SoftDeletes;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function author()
    {
        return $this->hasMany(Author::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,"created_by_user_id");
    }
}
