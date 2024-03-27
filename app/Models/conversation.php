<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Message;

class conversation extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user', 'user_id', 'conversation_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
