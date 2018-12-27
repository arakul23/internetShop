<html>
<head>

<link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

<!-- Bootstrap -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../../../public/css/owl.carousel.css">
<link rel="stylesheet" href="../../../public/css/style.css">
<link rel="stylesheet" href="../../../public/css/responsive.css">
<link rel="stylesheet" href="../../../public/css/mineStyle.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]-->
</head>
<body>
<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="logo">
                    <h1><a href={{url("/")}}><span>Не розетка</span></a></h1>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="searchForm">
                    <form action="{{url('searchProduct')}}">
                        <input name="searchQuery" class="form-control">
                        <input type="submit" id="searchBtn" value="Поиск">
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shopping-item">
                    <a href={{url("cartProduct")}}>Общая стоимость: <span class="cart-amunt" id="product-price">{{session("fullPrice")}}
                            грн</span> <i
                                class="fa fa-shopping-cart"></i>
                        <span class="product-count"
                              id="product-count">@if((session("fullCountProd"))) {{session("fullCountProd")}} @else {{0}}@endif</span></a>

                   
                    <div>

                    </div>

                    <div>
                        @if(!empty(session('product')))
                            <form action="{{url('clearCart')}}">
                                <button type="submit"><h5>Очистить корзину</h5></button>
                            </form>
                            <form action={{url("ordering")}} method = 'post' class="form-order">
                                <button type="submit" class="button-order"><h5>Оформить заказ</h5></button>
                                                         {{ csrf_field() }}

                            </form>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href={{url("/discounts")}}>Товары со скидкой</a></li>
                    <li><a href={{url("/category")}}>Категории</a></li>
                    @if(!Auth::user())

                        <li><a href={{url("/auth")}}>Авторизация</a></li>
                    @else
                        <li><a href={{url("/logout")}}>Выйти</a></li>


                    @endif

                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="../../../public/js/handler.js"></script>
<script src="../../../public/js/googleMap.js"></script>
</body>
</html>
@yield('content')
