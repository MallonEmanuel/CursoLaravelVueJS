<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['fecha_solicitud', 'fecha_entrega', 'vianda_id', 'persona_id'];
}
 
