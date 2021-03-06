
@extends('layouts.menu')
@section('content')
<style>
.closeBtn {
    size: 29px;
}
</style>



@if(empty($product[0]))

Корзина пуста

@else

    <div class="container">

    @foreach ($product as $key => $prod)

    <form class="col-lg-4 productCart">
        <button type="button" class="close" aria-label="Close" onclick="deleteFromCart(this)">
            <span aria-hidden="true" style="color: #ff0a33" class="closeBtn">&times;</span>
        </button>
  
            <div class = nameProduct>
            <h3>{{$prod[0]->name}}</h3>
                <b class = "pull-right">{{$prod[0]->quantity}}</b>
           
        </div>
            @if(isset($prod[0]->images[0]))
            <p><img src="{{$prod[0]->images[0]->url}}" width="200" height="200"></p>
            @endif
            <div></div>
            <p align="inherit" value="{{$prod[0]->price}}" id="prodCount">Цена: {{$prod[0]->price}}
                <input type="hidden" name="idProductCart" value="{{$prod[0]->id}}">
                <input type="hidden" name="productPrice" value="{{$prod[0]->price}}">

                {{csrf_field()}}

            </form>
            @endforeach
        </div>
        @endif

        @endsection

