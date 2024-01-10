<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = "clients";

    protected $fillable = [
        "id",
        "fullname",
        "address",
        "phone",
        "user_id",
        "created_at",
        "updated_at"
    ];
}
