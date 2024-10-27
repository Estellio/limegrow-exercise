<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$product['name']}}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-dark" style="color: white">

    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-8 col-xl-6">
            <h1 class="text-center">{{$product['name']}}</h1>
            <h4 class="fw-light mt-4">Left in stock: {{$product['stock']}}</h4>
            <h5 class="fw-light">Category: {{$product['category']}}</h5>
            <p class="text-center my-4" style="text-align: justify !important">{{$product['description']}}</p>
            <h3 class="ms-auto fw-light mt-4 text-end">{{$product['price']}}€</h3>
        </div>
    </div>

    @auth

    @else

    @endauth

</body>
</html>