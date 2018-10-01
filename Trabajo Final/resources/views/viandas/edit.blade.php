@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <vianda-form :vianda_id="{{json_encode($vianda)}}"></vianda-form>
            </div>
        </div>
    </div>
@endsection
