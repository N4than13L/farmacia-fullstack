<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = "bill";

    protected $fillable = [
        "id",
        "date",
        "user_id",
        "employee_id",
        "mediccine_id",
        "amount",
        "created_at",
        "updated_at"
    ];
}
