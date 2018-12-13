@extends('layouts.menu')
@section('content')
    <div class="container">
        <div class="col-lg-12 categoryList">

    @foreach($category as $c)
            <form action="{{url("/selectProduct")}}" method="post">
                    <input id="submitCategory" type="submit" name="categoryName" value="{{$c->name}}">
                    <input type="hidden" name="categoryId" value="{{$c->id}}">
                    {{ csrf_field() }}
                </form>


        @endforeach
        </div>
</div>

@stop