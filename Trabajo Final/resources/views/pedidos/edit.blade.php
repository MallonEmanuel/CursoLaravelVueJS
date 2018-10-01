@extends('master')

@section('content')
    <div class="container">
        <div class="row">
          <!-- <h1>Hello, {{$pedido}}</h1> -->
            <div class="col-md-12 ">
                <pedido-form :pedido_id="{{json_encode($pedido)}}">

                </pedido-form>
            </div>
        </div>
    </div>
@endsection
