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
            <form action="{{url('/addOrder')}}" method = "post">
                <label>Введите ФИО </label>
                <input name="userName" placeholder="ФИО" class="form-control input-sm" minlength="15" maxlength="40" required>

                <label>Введите номер телефона</label>
                <input name="userPhoneNumber" placeholder="Номер телефона" class="form-control input-sm" minlength="13"
                maxlength="13" required>
                <label>Выберите способ доставки</label>

                <select name = 'delivery' class = "form-control">
                    @foreach($delivery as $value)
                    <option value = '{{$value->id}}'>{{$value->name}}</option>
                    @endforeach
                </select>
                <input type="submit" name="submitOrder" value="Подтвердить заказ">
                {{csrf_field()}}

            </form>

        </div>
        <div class = "col-lg-4 pull-right" id = "additionalInfo">
            <h3>Сумма заказа: {{$fullPrice}} грн.</h3>
        </div>
        

    </body>
    </html>
    @stop