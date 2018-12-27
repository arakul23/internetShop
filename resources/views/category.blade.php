@extends('layouts.menu')
@section('content')
    <div class="container">
        <div class="col-lg-12 categoryList">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    @foreach($category as $c)
            <form action="{{url("/selectProduct")}}" method="get">
                    <input id="submitCategory" type="submit" name="categoryName" value="{{$c->name}}">
                    <input type="hidden" name="categoryId" value="{{$c->id}}">
                    {{ csrf_field() }}
                </form>


        @endforeach
        </div>
</div>
<div class="col-lg-2 pull-left">
<nav id="menuVertical" class="form-control">
    <ul>
            @foreach($category as $c)
@if($c->parent_id == 0)

        <li class="form-control"><a href="#m1">{{$c->name}}</a>
        @endif
        <ul>
@foreach($category as $cat)
@if($cat->parent_id == $c->id)

                <li class = "form-control"><a href="#m3_1">{{$cat->name}}</a></li>
              
           
            @endif
@endforeach
 </ul>
    </li>
        @endforeach
    
</nav><!--menuVertical-->

</div>

@stop