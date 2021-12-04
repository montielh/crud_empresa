<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaventa extends Model
{
    use HasFactory;

    protected $table = 'notaventa';
    protected $fillable = [
        'fecha',
        'monto',
        'id_cliente'
        
    ];
    public $timestamps=false;
}
