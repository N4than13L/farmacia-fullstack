<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $table = "medicine";

    protected $fillable = [
        "id",
        "name",
        "user_id",
        "type_medicine_id",
        "sec_effects_id",
        "supplier_id",
        "created_at",
        "updated_at"
    ];
}
