<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculos extends Model
{
    use HasFactory;
    protected $primaryKey = 'idve'; 
    protected $fillable=['idve','nombre','telefono','direccion','coreo','fecha','placa','grua','cilindro','idt','idco','activo','foto','control_vehicular'];
}
