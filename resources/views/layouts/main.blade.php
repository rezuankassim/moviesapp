<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle', config('app.name'))</title>

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <livewire:styles>
</head>
<body class="font-sans bg-gray-900 text-white relative">
    <x-navbar/>

    @if ($errors->any())
        <x-alert textColor="text-red-600" backgroundColor="bg-red-200" hoverTextColor="text-red-800"/>
    @endif
{{--    
    @if ($errors->any())
        <livewire:alert textColor="text-red-600" backgroundColor="bg-red-200" hoverTextColor="text-red-800"> --}}
    

    @yield('content')

    <script src="{{ asset('js/app.js') }}" defer></script>
    <livewire:scripts>
</body>
</html>