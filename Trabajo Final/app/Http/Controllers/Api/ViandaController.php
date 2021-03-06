<?php

namespace App\Http\Controllers\Api;

use App\Vianda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ViandaResource;

class ViandaController extends Controller{

    public function index(){
        // $viandas = Vianda::paginate(20);
        // $viandas = Vianda::orderBy('id','DESC')->paginate(20);
        $viandas = Vianda::all();
        return ViandaResource::collection($viandas);
    }

    public function show(Vianda $vianda){
        return new ViandaResource($vianda);
    }


    public function store(Request $request)
    {
        $vianda = $this->validate($request, [
          'nombre'=>'required',
        	'descripcion'=>'required',
        	'precio'=>'required',
        	'vegetariana'=>'required'
        ]);

        $vianda = Vianda::create($vianda);

        return new ViandaResource($vianda);
    }

    public function update(Request $request, $id){
        //
        $this->validate($request,[
        	'nombre'=>'required',
        	'descripcion'=>'required',
        	'precio'=>'required',
        	'vegetariana' => 'required'
        ]);

        $vianda = Vianda::find($id);

        // $vianda->update($request->all());
        $vianda->nombre = $request->nombre;
        $vianda->descripcion = $request->descripcion;
        $vianda->precio = $request->precio;
        $vianda->vegetariana = $request->vegetariana;
        $vianda->save();

        return new ViandaResource($vianda);
    }

    public function destroy($id){
        $vianda = Vianda::find($id);
        if($vianda == null){
          return ["error"=>"No existe la vianda"];
        }else{
          Vianda::destroy($id);
          return new ViandaResource($vianda);
        }
    }
}
