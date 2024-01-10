<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
