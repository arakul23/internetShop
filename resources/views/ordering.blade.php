@extends('layouts.menu')
@section('content')
    <html>
    <head>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
              integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
              crossorigin=""/>
        <title>
            Оформление заказа
        </title>
        <style>
            #map {
                width: 60%;
                height: 400px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="col-lg-4">
            <form action="{{url('/addOrder')}}" method="post">
                <label>Введите ФИО </label>
                <input name="userName" placeholder="ФИО" class="form-control input-sm" minlength="15" maxlength="40"
                       required>
                <label>Введите Email </label>
                @if(Auth()->user())
                    <input name="userEmail" placeholder="Email" class="form-control input-sm" minlength="10"
                           maxlength="50"
                           value="{{Auth()->user()->email}}" required>
                @else
                    <input name="userEmail" placeholder="Email" class="form-control input-sm" minlength="10"
                           maxlength="50" required>
                @endif

                <label>Введите номер телефона</label>
                <input name="userPhoneNumber" placeholder="Номер телефона" class="form-control input-sm" minlength="10"
                       maxlength="13" required>

                <label>Выберите способ оплаты</label>
                <select name='payment' class="form-control">
                    <option value="COD">Наложенный платёж</option>
                    <option value="paypal">PayPal</option>
                </select>
                <label>Выберите способ доставки</label>

                <select name='delivery' class="form-control">
                    @foreach($delivery as $value)
                        <option value='{{$value->id}}'>{{$value->name}}</option>
                    @endforeach
                </select>
                <label>Введите адрес доставки</label>
                <input name="addressOrder" class="form-control">

                <input type="submit" name="submitOrder" value="Подтвердить заказ">
                {{csrf_field()}}

            </form>

        </div>
        <style>
            #map {
                height: 400px;
                width: 400px;
            }
        </style>
        <div class="col-lg-4 pull-right" id="additionalInfo">
            <h3>Сумма заказа: {{$fullPrice}} грн.</h3>
            <div id="map"></div>


        </div>

    </div>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <script>
        var mymap = L.map('map').setView([46.4858883, 30.68365101], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYXJha3VsIiwiYSI6ImNqcnAyMHJobzE5bXI0M256eWE5NWRscG4ifQ.bwzYpDXgJEstN17KMbg6Gg', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'your.mapbox.access.token'
        }).addTo(mymap);

        var marker = L.marker([46.4858883, 30.68365101]).addTo(mymap);

    </script>
    </body>
    </html>
@stop