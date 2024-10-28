<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-dark">

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
        <div class="card card-body d-flex align-items-center" style="background-color: #343a40">
            <form action="/addproduct" method="POST" id="productForm" class="col-8 col-xl-6">
                @csrf
                <div class="mb-3">
                    <label for="ean" class="form-label text-light">International Article Number</label>
                    <input type="text" class="form-control" maxlength="13" name="ean" id="ean" placeholder="1728336952832">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label text-light">Product Name</label>
                    <input type="text" class="form-control" maxlength="50" name="name" id="name" placeholder="New Modern Sofa">
                </div>
                <select id="category" name="category" class="form-select" aria-label="Select category">
                    <option selected value="Sofa">Sofa</option>
                    <option value="Bed">Bed</option>
                    <option value="Chair">Chair</option>
                    <option value="Table">Table</option>
                </select>
                <div class="row mb-3 mt-3">
                    <div class="col-6">
                        <label for="price" class="form-label text-light">Product Price (€)</label>
                        <input type="number" min="0" max="9999.99" step="0.01" class="form-control" name="price" id="price" placeholder="399.99">
                    </div>
                    <div class="col-6">
                        <label for="stock" class="form-label text-light">Product Stock</label>
                        <input type="number" min="0" max="2000" step="1" class="form-control" name="stock" id="stock" placeholder="129">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label text-light">Product Description</label>
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
        <div class="card card-body" style="background-color: #343a40">
            <form action="/login" method="POST" class="d-flex flex-column align-items-center">
                @csrf
                <div class="form-floating mb-3 mt-4 col-6 col-xl-4">
                    <input name="loginname" type="text" class="form-control" id="floatingInput" placeholder="Username" value="">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating col-6 col-xl-4">
                    <input name="loginpassword" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid gap-1 col-2 mx-auto my-4">
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
        <div class="card card-body" style="background-color: #343a40">
            <form class="d-flex flex-column align-items-center" action="/register" method="POST">
                @csrf
                <div class="form-floating mb-3 mt-4 col-6 col-xl-4">
                    <input name="name" type="text" class="form-control" id="floatingInput" placeholder="Username" value="">
                    <label for="floatingInput">Username</label>
                </div>
                <div class="form-floating col-6 col-xl-4">
                    <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid gap-1 col-2 mx-auto my-4">
                    <button class="btn btn-primary">Sign Up</button>
                </div>
            </form>
        </div>
    </div>

    @endauth

    <!-- Price range filter -->
    <form action="/products" method="GET" class="row g-2 align-items-center justify-content-center" style="margin: 0">
        <div class="col-auto">
            <label for="min_price" class="form-label mb-0">Min Price:</label>
            <input class="form-control" type="number" name="min_price" id="min_price" step="0.01" min="0" value="{{ request('min_price') }}">
        </div>
    
        <div class="col-auto">
            <label for="max_price" class="form-label mb-0">Max Price:</label>
            <input class="form-control" type="number" name="max_price" id="max_price" step="0.01" min="0" value="{{ request('max_price') }}">
        </div>
    
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mt-4">Filter</button>
        </div>
    </form>
    
    

    <!-- Make and display product elements -->
    <div class="container mt-5">
        <div class="row">
            @foreach($products as $product)
            <a href="/show-product/{{$product['id']}}" class="col-md-4 mb-4" style="text-decoration: none">
                <div class="card h-100" style="background-color: #2b3035"> <!-- Use h-100 to ensure equal height for cards -->
                    <div class="card-body">
                        <h5 class="card-title text-light">{{ $product['name'] }}</h5>
                        <h6 class="card-subtitle mb-4 text-light fw-light">{{ $product['category'] }}</h6>
                        <h5 class="card-text text-end text-light">{{ number_format($product['price'], 2) }}€</h5>
                        <!-- If loged in (admin) then display the Edit Product function link -->
                        @auth
                        <a class="card-text text-light" href="edit-product/{{$product['id']}}">Edit Product</a>
                        @endauth
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

</body>
</html>