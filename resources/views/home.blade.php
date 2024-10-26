<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    @auth
    <form action="/logout" method="POST" class="gap-1 d-flex justify-content-end">
        @csrf
        <button type="submit" class="btn btn-danger m-3">Log Out</button>
    </form>

    @else
    <p class="gap-1 d-flex justify-content-end">
        <button class="btn btn-warning m-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Log In
        </button>
    </p>
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

    <!--<p class="gap-1 d-flex justify-content-end">
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
    </div> -->

    @endauth

</body>
</html>