@extends('layouts.menu')
@section('content')
        <!DOCTYPE html>
<html>
<head>
    <title>Удалить товар</title>
    <script>
        function getProduct() {
            var query = "deleteOperation";
            var new_options = '';
            var categoryId = document.getElementById('prodCategory').value;
            alert(categoryId);
            var html = '';

            $.ajax({
                dataType: "json",
                type: "POST",
                url: "selectProduct",
                data: {
                    "_token": "{{csrf_token()}}",
                    "categoryId": categoryId,
                    "query": query
                },

                success: function (result) {
                    console.log(result);
                    for (var i = 0; i < result.length; i++) {
                        $('#prodName').append('<option value="' + result[i]["name"] + '">' + result[i]["name"] + '</option>');

                        alert(result[i]['name']);
                    }
                },

                error: function (xhr, resp, text) {
                    console.log(xhr, resp, text);
                }
            })
        }
    </script>
</head>
<label for="prodCategory">Выберите категорию товара</label><br>
<select name="prodCategory" id="prodCategory" onchange="getProduct()" required>
    @foreach($category as $cat)
        <option name="{{$cat->name}}" id="prodCategoryOption" value="{{$cat->id}}">{{$cat->name}}</option>
    @endforeach
</select><br>
<select name="prodName" id="prodName" required>
    <option></option>
</select><br>
@stop
</html>