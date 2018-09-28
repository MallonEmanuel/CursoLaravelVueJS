<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Vianda;
use App\Persona;

class PedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_entrega' => $this->fecha_entrega,
            'vianda' => Vianda::find($this->vianda_id),
            'persona' =>Persona::find($this->persona_id),
        ];
    }
} 
