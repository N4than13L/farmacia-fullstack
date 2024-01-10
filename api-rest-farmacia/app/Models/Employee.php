<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employee";

    protected $fillable = [
        "id",
        "name",
        "surname",
        "email",
        "phone",
        "address",
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
