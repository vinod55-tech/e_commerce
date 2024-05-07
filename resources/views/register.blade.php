<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h3 class="text-center">Register Form</h3>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('register-form') }}" method="POST">
                            @csrf
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control">
                            <br>
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control">
                            <br>
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control">
                            <br>
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>