<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <p>Hi! {{ $name }}</p>
    <p>Here is your login credentials:</p>
    <div>
        <strong>Email: </strong><span>{{ $email }}</span>
    </div>
    <div>
        <strong>Password: </strong><span>{{ $password }}</span>
    </div>
</body>

</html>
