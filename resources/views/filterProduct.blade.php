@extends('layouts.menu')
@section('content')
{{var_dump($a[0][0]->products->name)}}
{{die()}}
    @foreach($a[0]->products as  $filtProd)

       {{$filtProd->name}}
        <br>
    @endforeach
    @endsection