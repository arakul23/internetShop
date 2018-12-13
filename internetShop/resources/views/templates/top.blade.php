<html>
<head>
    <title>
        Интернет-магазин ITExpense
    </title>
    <link rel="stylesheet" href='../../../public/css/pageStyles.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
<div id = 'logo'>
<img src='../../../public/images/logo.png'>
</div>
<div id = 'searchForm'>
    <form action = {{url('searchProduct')}}>
        <input name="searchQuery">
        <input type="submit" class="btn">
    </form>
</div>

<div id = 'authButtons'>
    <input type="button" class="btm" value="Логин">
    <input type="button" class="btm" value="Регистрация">

</div>

</body>
</html>
@yield('content')

