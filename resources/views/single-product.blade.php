@extends('layouts.menu')
        @section('content')

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eElectronics - HTML eCommerce Template</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../public/css/owl.carousel.css">
    <link rel="stylesheet" href="../../public/style.css">
    <link rel="stylesheet" href="../../public/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<div class = "container">
    <div class = "row">
        <div class = "col-lg-8">
@foreach($product[0] as $prod)
    <label>{{$prod[0]->name}}</label>

    <h3><img src = "{{$prod[0]->image}}"></h3>
    <label>Описание</label>
 <p>{{$prod[0]->description}}></p>
<div class = "addCartButton">
  <button type="button" onclick="addProductInCart(this)">Добавить в корзину</button>
                <input type="hidden" name="idVal" value="{{$prod[0]->id}}">
                                <input type="hidden" name="priceVal" value="{{$prod[0]->price}}">

                                {{ csrf_field() }}

                
</div>
    @endforeach

</div>

 <div class = "col-lg-4">

<div id = "singleProdProperties">
    <label>Характеристики</label>
@foreach($product[1]['properties'] as $prod)
    <h4>{{$prod['name']}}:{{$prod['value']}}</h4>
    @endforeach
</div>
</div>
 </div>
</div>



   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="../../public/js/owl.carousel.min.js"></script>
    <script src="../../public/js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="../../public/js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="../../public/js/main.js"></script>
  </body>
@stop
</html>