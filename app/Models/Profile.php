<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'story',
        'gender',
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
