<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_medicine extends Model
{
    use HasFactory;
    protected $table = "type_medicine";

    protected $fillable = [
        "id",
        "name",
        "user_id",
        "created_at",
        "updated_at"
    ];
}
