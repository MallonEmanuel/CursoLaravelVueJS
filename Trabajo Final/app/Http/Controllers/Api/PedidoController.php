<?php

namespace App\Http\Controllers\Api;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;

class PedidoController extends Controller
{
      public function index(){
          // $viandas = Vianda::paginate(20);
          $pedidos = Pedido::all();
          return PedidoResource::collection($pedidos);
      }

      public function show(Pedido $pedido){
          return new PedidoResource($pedido);
      }

      public function store(Request $request)
      {
          $pedido = $this->validate($request, [
            'persona_id'=>'required',
            'vianda_id'=>'required',
            'fecha_solicitud'=>'required',
            'fecha_entrega'=>'nullable'
          ]);

          $pedido = pedido::create($pedido);

          return new PedidoResource($pedido);
      }

      public function update(Request $request, $id){
          $this->validate($request,[
            'persona_id'=>'required',
            'vianda_id'=>'required',
            'fecha_solicitud'=>'required',
            'fecha_entrega'=>'nullable'
          ]);

          $pedido = Pedido::find($id);

          $pedido->update($request->all());

          return new PedidoResource($pedido);
      }

      public function destroy($id){
          $pedido = Pedido::find($id);
          if($pedido === undefined){
            return ["error"=>"Pedido no encontrado"];
          }
          Pedido::destroy($id);
          return new PedidoResource($pedido);
      }
}
