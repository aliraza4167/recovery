<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suffer extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'suffer_user', 'user_id', 'suffer_id');
    }
}
