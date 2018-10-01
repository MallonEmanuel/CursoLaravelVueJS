@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <persona-form :persona_id={{json_encode($persona)}}></persona-form>
            </div>
        </div>
    </div>
@endsection
