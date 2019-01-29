@extends('layouts.menu')
@section('content')
        <!DOCTYPE html>
<html>
<head>
    <title>Товары</title>
    @if(session()->has("productAddToCart"))
        {{session("productAddToCart")}}
    @endif
</head>
<body>
<style>
    .button {
        display: inline-block;
        padding: .69231em 1.46154em .61538em 1.76923em;
        text-indent: -9999px;
    }
</style>
<div class="col-lg-3">
    <div>
        <h3><label for="sortProducts">Сортировка</label></h3>
        <select name="sort" id="sortProducts" class="form-control">
            <option value="priceDesc">Цена по убыванию</option>
            <option value="priceAsc">Цена по возрастанию</option>
            <option value="alphabetic">По алфавиту</option>
        </select>
    </div>
<input type="hidden" name = "category" id = "categoryProduct" value = {{$category}}>
    @if(count($filter) > 0)
        <form action="{{action('getInfoController@filter')}}" method="post">
            <label>Производитель</label>
            <br>
            <input type="hidden" name="table[]" value="Производитель">

            @foreach($filter as $key => $filt)
                @if($filt->name == "Производитель")
                    <input type="checkbox" name="brand[]" value="{{$filt->value}}">{{$filt->value}}
                    <br>
                @endif
            @endforeach


            <label>ОЗУ</label>
            <br>
            @foreach($filter as $key => $filt)
                @if($filt->name == "ОЗУ")
                    <input type="hidden" name="table[]" value="{{$filt->name}}">

                    <input type="checkbox" name="RAM[]" value="{{$filt->value}}">{{$filt->value}}
                    <br>
                @endif
            @endforeach

            <input type="submit" value="Применить">
            {{ csrf_field() }}

        </form>
    @endif
</div>
<div class="col-lg-9">

    @foreach($product as $p)

        <form action="{{url('/singleProduct')}}" class="product-form">
            <div class="col-lg-4 product">
                <h3>{{$p->name}}</h3>
                @if(isset($p->images[0]))
                    <img src="{{$p->images[0]->url}}" width="200" height="200"><br>
                @endif
                @if(isset($p->oldPrice))

                    <h3>
                        <del>{{$p->oldPrice}} грн.</del>
                    </h3>
                @endif
                <h3> {{$p->price}} грн.</h3>
                <button type="button" onclick="addProductInCart(this)">Добавить в корзину</button>
                <input type="hidden" name="idVal" value="{{$p->id}}">
                <input type="hidden" name="priceVal" value="{{$p->price}}">
                <input type="submit" value="Открыть товар">

                {{ csrf_field() }}


            </div>

        </form>
    @endforeach
</div>
{{ $product->appends(['categoryId' => $category])->links() }}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="../../../public/js/handler.js"></script>
<script src="../../../public/js/googleMap.js"></script>
</body>
@endsection
</html>
