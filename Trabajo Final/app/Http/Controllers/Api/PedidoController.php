<?php

namespace App\Http\Controllers\Api;

use App\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
      public function index(){
          // $viandas = Vianda::paginate(20);
          $pedidos = DB::table('pedidos')->orderBy('fecha_solicitud', 'desc')->get();
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
          $pedido->persona_id = $request->persona_id;
          $pedido->vianda_id = $request->vianda_id;
          $pedido->fecha_solicitud = $request->fecha_solicitud;
          $pedido->fecha_entrega = $request->fecha_entrega;
          // $pedido->update($request->all());
          $pedido->save();
          return new PedidoResource($pedido);
      }

      public function destroy($id){
          $pedido = Pedido::find($id);
          // var_dump($pedido);
          if($pedido == null){
            return ["error"=>"No existe el Pedido"];
          }else{
            Pedido::destroy($id);
            return new PedidoResource($pedido);
          }
      }
}
