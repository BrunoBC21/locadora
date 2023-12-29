<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    public function reservas(){
        return $this->hasMany("App\Models\Reserva");
    }
    public function cancelados(){
        return $this->hasMany("App\Models\Cancelar");
    }
}
