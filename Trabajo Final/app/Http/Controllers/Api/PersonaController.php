<?php

namespace App\Http\Controllers\Api;

use App\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PersonaResource;

class PersonaController extends Controller
{

      public function index(){
          // $viandas = Vianda::paginate(20);
          $personas = Persona::all();
          return PersonaResource::collection($personas);
      }

      public function show(Persona $persona){
          return new PersonaResource($persona);
      }


      public function store(Request $request)
      {
          $persona = $this->validate($request, [
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required'
          ]);

          $persona = Persona::create($persona);

          return new PersonaResource($persona);
      }

      public function update(Request $request, $id){
          $this->validate($request,[
            'nombre'=>'required',
            'apellido'=>'required',
            'email'=>'required'
          ]);

          $persona = Persona::find($id);

          $persona->update($request->all());

          return new PersonaResource($persona);
      }
}
