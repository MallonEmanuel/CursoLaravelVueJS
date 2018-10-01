<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViandasController extends Controller
{
    public function index()
    {
        return view('viandas.index');
    }

    public function edit($id)
    {
      if($id == 'nueva'){
        return view('viandas.edit', ['vianda' => null]);
      }else{
        // $pedidoResource = new PedidoResource($pedido);
        return view('viandas.edit', ['vianda' => $id]);
      }
    }
}
