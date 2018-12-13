@extends('templates.top')
@section('content')
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

<div style="width: 10%">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="#">Item 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Item 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Item 3</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Item 4</a>
        </li>
    </ul>
</div>
</body>
</html>

    @stop