<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    use HasFactory;
    protected $primaryKey = 'idserv'; 
    protected $fillable=['idserv','nombre','costo','idcat','fotoser'];
}