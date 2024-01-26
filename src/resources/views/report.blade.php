<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/styles.css')
    @vite('resources/js/app.js')

    <title>Chess Accuracy Tracker</title>
</head>
<body>
    <div class="app">
        <h1>{{ $nickname }}</h1>
    </div>
</body>
</html>
