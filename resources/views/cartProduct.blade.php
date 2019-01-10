
@extends('layouts.menu')
@section('content')

<style>
.closeBtn {
    size: 29px;
}
</style>
@if(!isset($product))
Корзина пуста

@else
<div class="container">
    @foreach ($product as $prod)

    <form class="col-lg-4 productCart">
        <button type="button" class="close" aria-label="Close" onclick="deleteFromCart(this)">
            <span aria-hidden="true" style="color: #ff0a33" class="closeBtn">&times;</span>
        </button>
        <p>
            <h3>{{$prod->name}}</h3></p>
            @if(isset($prod->image))
            <p><img src="{{$prod->image}}" width="200" height="200"></p>
            @endif
            <h3><p align="inherit" value="{{$prod->price}}" id="prodCount">Цена: {{$prod->price}}
                Количество:{{$prod->quantity}} </p></h3>
                <input type="hidden" name="idProductCart" value="{{$prod->id}}">
                <input type="hidden" name="productPrice" value="{{$prod->price}}">

                {{csrf_field()}}

            </form>
            @endforeach
        </div>
        @endif

        @endsection