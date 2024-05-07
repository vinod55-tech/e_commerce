<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change Password</title>
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
                    <h3 class="text-center">Change Password</h3>
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('update_password') }}" method="POST">
                            @csrf
                            
                            <label for="password">Old Password:</label>
                            <input type="password" name="old_password" class="form-control">
                            <br>
                            <label for="confirm_password">New Password:</label>
                            <input type="password" name="new_password" class="form-control">
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