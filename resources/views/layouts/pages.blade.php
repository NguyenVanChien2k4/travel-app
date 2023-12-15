
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('./font/fontawesome-free-6.3.0-web/fontawesome-free-6.3.0-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Satisfy&family=Yantramanav:wght@100;300;400;500;700;900&display=swap">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="{{ asset('./css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('./css/footer.css') }}">
    <title>Trang chủ</title>
</head>
<body>
    <div class="">
        @include('layouts.header')

        @yield('content')
    </div>
</body>
</html>
