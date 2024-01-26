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

        <div class="games">
            @foreach($games as $game)
                <div class="game">
                    <div class="time-control">
                        {{ $game->getTimeControl() }}
                    </div>

                    <div class="nicknames">
                        <div class="nickname-white">
                            {{ $game->getWhite()['username'] }} ({{ $game->getWhite()['rating'] }})
                        </div>
                        <div class="nickname-black">
                            {{ $game->getBlack()['username'] }} ({{ $game->getBlack()['rating'] }})
                        </div>
                    </div>

                    <div class="score">
                        <div class="score-white">
                            {{ $game->getWhite()['score'] }}
                        </div>
                        <div class="score-black">
                            {{ $game->getBlack()['score'] }}
                        </div>
                    </div>

                    <div class="accuracy">
                        <div class="accuracy-white"></div>
                        <div class="accuracy-black"></div>
                    </div>

                    <div class="moves">

                    </div>

                    <div class="date">

                    </div>

                    <div class="link">
                        <a href="{{ $game->getUrl() }}">View game</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
