<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Medicine;

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
        "clients_id",
        "created_at",
        "updated_at"
    ];

    // relacion de muchos datos a un usuario. 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relacion de muchos datos a un clientes. 
    public function clients()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    // relacion de muchos datos a un empleados. 
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // relacion de muchos datos a una medicina. 
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}
