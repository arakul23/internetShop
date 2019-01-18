@extends('layouts.menu')
@section('content')

    @foreach($productFilter[0] as  $filtProd)

       {{$filtProd->name}}
        <br>
    @endforeach
    @endsection