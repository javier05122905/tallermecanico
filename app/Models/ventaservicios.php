<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventaservicios extends Model
{
    use HasFactory;
    protected $primaryKey = 'idser'; 
    protected $fillable=['idser','idcli','idu','fecha'];
}
