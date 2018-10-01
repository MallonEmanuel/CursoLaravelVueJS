<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonasController extends Controller
{
  public function index()
  {
      return view('personas.index');
  }

  public function edit($id)
  {
    if($id == 'nueva'){
      return view('personas.edit', ['persona' => null]);
    }else{
      // $pedidoResource = new PedidoResource($pedido);
      return view('personas.edit', ['persona' => $id]);
    }
  }
}
