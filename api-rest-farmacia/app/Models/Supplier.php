<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "supplier";

    protected $fillable = [
        "id",
        "fullname",
        "address",
        "phone",
        "email",
        "rnc",
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
