<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Type_medicine;
use App\Models\Sec_effect;
use App\Models\Supplier;

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

    // relacion de muchos datos a un usuario. 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relacion de muchos datos al tipo de medicina
    public function type_medicine()
    {
        return $this->belongsTo(Type_medicine::class, 'type_medicine_id');
    }

    // relacion de muchos datos de los efectos secundarios 
    public function sec_effects()
    {
        return $this->belongsTo(Sec_effect::class, 'sec_effects_id');
    }

    // relacion de muchos datos al suplidor
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }
}
