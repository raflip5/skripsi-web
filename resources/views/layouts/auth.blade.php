<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bullying Web')</title>
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="bg-slate-100 h-screen flex flex-col items-center justify-center">
    @yield('content')
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>