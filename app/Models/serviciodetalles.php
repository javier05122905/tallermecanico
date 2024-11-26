<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serviciodetalles extends Model
{
    use HasFactory;
    protected $primaryKey = 'idsd'; 
    protected $fillable=['idsd','idser','idserv','costo','descuento','total'];
}
