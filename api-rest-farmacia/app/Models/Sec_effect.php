<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Sec_effect extends Model
{
    use HasFactory;
    protected $table = "sec_effects";

    protected $fillable = [
        "id",
        "name",
        "user_id",
        "created_at",
        "updated_at"
    ];

    // relacion de muchos datos a un usuario. 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
