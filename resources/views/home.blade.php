<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="--bs-light-bg-subtle">

    @auth
    <!-- When loged in, display button to log out -->
    <form action="/logout" method="POST" class="gap-1 d-flex justify-content-end">
        @csrf
        <button type="submit" class="btn btn-danger m-3">Log Out</button>
    </form>

    <!-- Form to add product -->
    <p class="gap-1 d-flex justify-content-end">
        <button class="btn btn-primary m-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Add  A New Product
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="/addproduct" method="POST" id="productForm">
                @csrf
                <div class="mb-3">
                    <label for="ean" class="form-label">International Article Number</label>
                    <input type="text" class="form-control" maxlength="13" name="ean" id="ean" placeholder="1728336952832">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" maxlength="50" name="name" id="name" placeholder="New Modern Sofa">
                </div>
                <select id="category" name="category" class="form-select" aria-label="Select category">
                    <option selected value="Sofa">Sofa</option>
                    <option value="Bed">Bed</option>
                    <option value="Chair">Chair</option>
                    <option value="Table">Table</option>
                </select>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="price" class="form-label">Product Price (€)</label>
                        <input type="number" min="0" max="9999.99" step="0.01" class="form-control" name="price" id="price" placeholder="399.99">
                    </div>
                    <div class="col-6">
                        <label for="stock" class="form-label">Product Stock</label>
                        <input type="number" min="0" max="2000" step="1" class="form-control" name="stock" id="stock" placeholder="129">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Product Description</label>
                    <textarea class="form-control" name="description" id="description" rows="4"></textarea>
                </div>
                <div class="d-grid gap-1 col-4 mx-auto my-4">
                    <button class="btn btn-success">Add Product</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="d-flex justify-content-center">
    <div class="alert alert-success alert-dismissible fade show col-8 col-sm-4 col-xl-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    @endif


    @else
    <!-- When not loged in, display log in button to toggle login form-->
    <p class="gap-1 d-flex justify-content-end">
        <button class="btn btn-warning m-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Log In
        </button>
    </p>
    <!-- Login form -->
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="/login" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input name="loginname" type="text" class="form-control" id="floatingInput" placeholder="Username" value="">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input name="loginpassword" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid gap-1 col-4 mx-auto my-4">
                    <button class="btn btn-primary">Log In</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sugn up for user, only admins have accounts -->
    <p class="gap-1 d-flex justify-content-end">
        <button class="btn btn-secondary m-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
            Sign Up
        </button>
    </p>
    <div class="collapse" id="collapseExample2">
        <div class="card card-body">
            <form action="/register" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Username" value="">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid gap-1 col-4 mx-auto my-4">
                    <button class="btn btn-primary">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    @endauth

    <div>
        <h2>All Products</h2>
        @foreach ($products as $product)
        <div class="--bs-light-border-subtle">
            <p>{{$product['name']}}</p>
        </div>
            
        @endforeach
    </div>

</body>
</html>