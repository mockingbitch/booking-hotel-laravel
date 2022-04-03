<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (isset($msg))
        @php echo $msg; @endphp
    @endif
    <form action="" method="post">
        @csrf
        <input type="text" name="email" />
        <input type="password" name="password" />
        <input type="submit" />
    </form>
</body>
</html>