<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    protected $primarykey ='idu';
    protected $fillable=['idu','nombre','apellido','correo','pasword','tipo','activo','fechavigencia','bloqueo'];
}
