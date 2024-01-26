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
        <div class="form-wrapper">
            <form id="reportForm">
                <input placeholder="Chess.com nickname" name="nickname" id="nicknameInput">
                <button type="submit">Get report</button>
            </form>
        </div>
    </div>
</body>
</html>
