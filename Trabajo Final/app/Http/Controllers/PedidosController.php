<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\Api\PedidoController;
use App\Pedido;
use App\Http\Resources\PedidoResource;
class PedidosController extends Controller
{
    public function index()
    {
        return view('pedidos.index');
    }

    public function edit($id)
    {
 
        if($id == 'nuevo'){
          return view('pedidos.edit', ['pedido' => null]);
        }else{
          // $pedidoResource = new PedidoResource($pedido);
          return view('pedidos.edit', ['pedido' => $id]);
        }
    }
}
