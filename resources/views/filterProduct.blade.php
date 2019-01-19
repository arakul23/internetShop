@extends('layouts.menu')
@section('content')
    {{var_dump($data)}}
    {{die()}}
    @foreach($productFilter[0] as  $filtProd)

       {{$filtProd->name}}
        <br>
    @endforeach
    @endsection