@extends('layouts.menu')
@section('content')
    <div class="container">
        <div class="searchProducts">
            @foreach($result as $prod)
                <div class="col-lg-3">
                    <p style="text-align: center">{{$prod->name}}</p>
                    @if(isset($prod->image))
                        <img src='{{$prod->image}}'>

                    @endif
                </div>
            @endforeach
        </div>
    </div>
@stop