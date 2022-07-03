<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div>
        <form action="/login" method="post">
            @csrf
            <label>Username:</label>
            <input id="user_name" name="user_name" type="text">
            <label>Password:</label>
            <input id="password" name="password" type="password">
            <input class="btn1" type="Submit"  name="Login" value="Login">
        </form>
    </div>
    @if(session()->has('err'))
        <div class="alert alert-success">
            {{ session()->get('err') }}
        </div>
    @endif
</body>
</html>