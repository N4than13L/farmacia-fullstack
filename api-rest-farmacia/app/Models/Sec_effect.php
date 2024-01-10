<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
