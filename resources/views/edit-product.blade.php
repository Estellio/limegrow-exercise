<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit - {{$product['name']}}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column justify-content-center align-items-center bg-dark" style="height: 100vh; color: white">
    <!-- Edit Product form (product category can not be changed)-->
    <h1 class="mb-4">Edit Product</h1>
    <form class="col-8" action="/edit-product/{{$product['id']}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <input type="text" class="form-control" maxlength="13" name="ean" id="ean" value="{{$product['ean']}}">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" maxlength="50" name="name" id="name" value="{{$product['name']}}">
        </div>
        <div class="row mb-3 mt-3">
            <div class="col-6">
                <input type="number" min="0" max="9999.99" step="0.01" class="form-control" name="price" id="price" value="{{$product['price']}}">
            </div>
            <div class="col-6">
                <input type="number" min="0" max="2000" step="1" class="form-control" name="stock" id="stock" value="{{$product['stock']}}">
            </div>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" id="description" rows="4">{{$product['description']}}</textarea>
        </div>
        <!-- Submit the Product Changes button -->
        <div class="d-grid gap-1 col-4 mx-auto my-4">
            <button class="btn btn-success">Save Edit</button>
        </div>
    </form>
</body>
</html>