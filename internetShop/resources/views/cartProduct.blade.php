@extends('layouts.menu')
@section('content')

    <style>
        .closeBtn {
            size: 29px;
        }
    </style>
    @if(!isset($fullProdInfo))
        Корзина пуста

    @else
        <div class="container">

            @foreach ($fullProdInfo as $prod)
{{$prod}}
                <form class="col-lg-4 productCart">
                    <button type="button" class="close" aria-label="Close" onclick="deleteFromCart(this)">
                        <span aria-hidden="true" style="color: #ff0a33" class="closeBtn">&times;</span>
                    </button>
                    <p>
                    <h3>{{$prod[0]->name}}</h3></p>
                    @if(isset($prod[0]->image))
                        <p><img src="{{$prod[0]->image}}" width="200" height="200"></p>
                    @endif
                    <h3><p align="inherit" value="{{$prod[0]->price}}" id="prodCount">Цена: {{$prod[0]->price}}
                            Количество:{{$prod[0]->quantity}} </p></h3>
                    <input type="hidden" name="idProductCart" value="{{$prod[0]->id}}">
                    <input type="hidden" name="productPrice" value="{{$prod[0]->price}}">

                    {{csrf_field()}}

                </form>
            @endforeach
        </div>
    @endif

@endsection