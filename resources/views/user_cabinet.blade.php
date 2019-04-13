@extends('layouts.menu')
@section('content')
<div class="col-lg-4">
    <labeL>Имя</labeL>: {{Auth()->user()->name}}<br>
    <labeL>email</labeL>: {{Auth()->user()->email}}<br>
    <labeL>Дата и время регистрации</labeL>: {{Auth()->user()->created_at}}<br>
</div>
    <div class="pull-right" style="margin-right: 20px">
        <labeL>Последние заказанные товары</labeL><br>
        @foreach($items as $key => $item)

            <img src='{{$item[0]->images[0]->url}}' class="prod_img"><br>
            {{$item[0]->name}}<br>
        @endforeach
    </div>
@stop
