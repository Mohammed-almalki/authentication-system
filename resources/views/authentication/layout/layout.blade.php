<!DOCTYPE html>
<html {{ session('locale') == 'ar' ? 'lang=ar dir=rtl' : 'lang=en' }}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('head')
</head>

<body>
    @yield('body')
</body>

</html>
