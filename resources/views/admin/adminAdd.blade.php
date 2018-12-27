@extends('layouts.menu')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <meta name="csrf_token" content="{{ csrf_token() }}"/>

    <title>Админка</title>

</head>
<body>



<div class="container">
  <ul class="nav nav-tabs">
    <li><a data-toggle="tab" href="#add">Добавить</a></li>
    <li><a data-toggle="tab" href="#edit">Редактировать</a></li>
    <li><a data-toggle="tab" href="#delete">Удалить</a></li>
  </ul>

  <div class="tab-content">

    <div id="add" class="tab-pane fade">
  <div class = "row">

       <form action={{url('/addProd')}} method="post" class="col-lg-4" id="formProduct" enctype="multipart/form-data">
            <label><h3>Добавить товар</h3></label><br>

            <label for="prodName">Название товара</label><br>
            <input name="prodName" id="prodName" class="form-control input-sm" required><br>
            <label for="prodPrice">Стоимость товара</label><br>
            <input name="prodPrice" id="prodPrice" class="form-control input-sm" pattern="^[ 0-9]+$" required><br>
            <label for="prodCategory">Категория товара</label><br>
            <select name="prodCategory" id="prodCategory" class="form-control" required>
                @foreach($category as $cat)
                <option name={{$cat->name}} value= {{$cat->id}}>{{$cat->name}}</option>
                @endforeach
            </select><br>
            <label for="descriptionProd">Описание товара</label><br>
            <textarea name = "descriptionProd"></textarea>
            <input type="file"  id = "nameImage" name="nameImage">
            <input type="submit" value="Добавить" class="btn btn-primary">
            {!! csrf_field() !!}
        </form>



   <form action={{url('/addCat')}} method="post" class="col-lg-4">
            <label><h3>Добавить категорию</h3></label>

            <label for="categoryName">Название категории</label><br>
            <input id="categoryName" name="categoryName" class="form-control input-sm" onchange="validateCategoryName()" required>
            <label for="parentCategory">Родительская категория</label><br>
            <select name="parentCategory" id="parentCategory" class="form-control" required>
                <option value = 'Нет'>Нет</option>
                @foreach($category as $cat)
                <option name={{$cat->name}} value= {{$cat->id}}>{{$cat->name}}</option>
                @endforeach
            </select><br>

            <div id="warningMessage" class="alert-warning" style="display: none"><br>
                <h5>Введите минимум 5 символов</h5>
            </div>
            <input type="submit" value="Добавить" id="sendCategory" class="btn btn-primary">
            {{ csrf_field() }}
        </form>





      <form action="{{url('/addDiscount')}}" method = "post" class="col-lg-4">
                <label><h3>Добавить скидку на товар</h3></label><br>
                <label for="productId">Название товара</label><br>

<select class="form-control input-sm" name="productId" required>
                @foreach($product as $prod)
                <option name={{$prod->name}} value= {{$prod->id}}>{{$prod->name}}</option>
                @endforeach
            </select>
                            <label for="discountPercent">Процент скидки</label><br>

            <input id = "discountPercent" name = "discountPercent" class="form-control">
            <label for="dateStart">Начало скидки</label><br>
            <input type = "date" id = "dateStart" name = "dateStart"><br>
                        <label for="dateFinish">Конец скидки</label><br>

            <input type = "date" id = "dateFinish" name = "dateFinish">

               <input type="submit" value="Добавить" id="addDiscount" class="btn btn-primary">
            {{ csrf_field() }}
</form>
</div>


   <div class = "row">
     <form action={{url('/addCharacteristic')}} method="post" class="col-lg-4 pull-left" id="formAddPost">
            <label><h3>Добавить характеристику</h3></label>
            <label for="characteristicName">Название характеристики</label>
            <input id="characteristicName" name="characteristicName" class="form-control input-sm" required>

            <input type="submit" value="Добавить характеристику" class="btn btn-primary">

            {!! csrf_field() !!}
        </form>

</div>
  </div>
</div>
</div>
</div>



<!-------------------  ----------------------->

    <div class="container" style="padding: 2px">
        


        <form action={{url('/deleteProd')}} method="post" class="col-lg-3" id="formProduct">
            <label><h3>Удалить товар</h3></label>
            <label>Название товара</label>
            <select class="form-control input-sm" name="productId" required>
                @foreach($product as $prod)
                <option name={{$prod->name}} value= {{$prod->id}}>{{$prod->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Удалить товар" class="btn btn-primary">

            {!! csrf_field() !!}

        </form>


        <form action={{url('/deleteCategory')}} method="post" class="col-lg-3" id="formDeleteCat">
            <label><h3>Удалить категорию</h3></label>
            <label>Название категории</label>
            <select class="form-control input-sm" name="productId" required>
                @foreach($category as $cat)
                <option name="deleteCat" value= {{$cat->id}}>{{$cat->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Удалить категорию" class="btn btn-primary">

            {!! csrf_field() !!}
        </form>


        <form action={{url('/addPostOffice')}} method="post" class="col-lg-3" id="formAddPost">
            <label><h3>Добавить почтовое отделение</h3></label>
            <label for="postOfficeName">Название отделения</label>
            <input id="postOfficeName" name="postOfficeName" class="form-control input-sm" required>

            <label for="postOfficeAddress">Адрес отделения</label>
            <input id="postOfficeAddress" name="postOfficeAddress" class="form-control input-sm" required>


            <label>Координаты для карты</label><br>
            <label for="postOfficeLat">Широта</label>
            <input id="postOfficeLat" name="postOfficeLat" class="form-control input-sm" required>
            <label for="postOfficeLng">Длина</label>
            <input id="postOfficeLng" name="postOfficeLng" class="form-control input-sm" required>
            <label for="postOfficeTimeWorking">Время работы</label>
            <input id="postOfficeTimeWorking" name="postOfficeTimeWorking" class="form-control input-sm" required>

            <input type="submit" value="Добавить отделение" class="btn btn-primary">

            {!! csrf_field() !!}
        </form>


       

    </div>
</body>
@stop
</html>