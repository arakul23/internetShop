@extends('layouts.menu')
@section('content')
    <html>
    <head>
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
            <form>
                <label>Введите имя</label>
                <input name="userName" placeholder="Имя" class="form-control input-sm" minlength="3" maxlength="15"
                       required>

                <label>Введите фамилию</label>
                <input name="userSurname" placeholder="Фамилия" class="form-control input-sm" minlength="3"
                       maxlength="15" required>

                <label>Введите отчество</label>
                <input name="userPatronymic" placeholder="Отчество" class="form-control input-sm" minlength="3"
                       maxlength="15" required>

                <label>Введите номер телефона</label>
                <input name="userPhoneNumber" placeholder="Номер телефона" class="form-control input-sm" minlength="13"
                       maxlength="13" required>

                <label>Выберите отделение</label>

                <select class="form-control input-sm" id="postOffice" name="postOffice" onchange="setPostOfficeOnMap()" required>

                    @foreach($listOffice as $list)
                        <option name="office" id="office" value= {{$list->id}}>{{$list->name}}</option>

                    @endforeach
                </select>

                <input type="submit" name="submitOrder" value="Подтвердить заказ">

                {!! csrf_field() !!}


            </form>


        </div>
        <div id="map"></div>

    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWctn7VsbRPkBeS1cdFpAFuaWPeMw8_2o&callback=initMap"
            async defer>

    </script>

    </body>
    </html>
@stop