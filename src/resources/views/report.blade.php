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
    <div id="app">
        <h1>{{ $nickname }}</h1>

        <table class="games">
            @foreach($games as $game)
                <tr class="game">
                    <td class="time-control">
                        {{ $game->getTimeControl() }}
                    </td>

                    <td class="nicknames">
                        <div class="nickname-white">
                            {{ $game->getWhite()['username'] }} ({{ $game->getWhite()['rating'] }})
                        </div>
                        <div class="nickname-black">
                            {{ $game->getBlack()['username'] }} ({{ $game->getBlack()['rating'] }})
                        </div>
                    </td>

                    <td class="score">
                        <div class="score-white">
                            {{ $game->getWhite()['score'] }}
                        </div>
                        <div class="score-black">
                            {{ $game->getBlack()['score'] }}
                        </div>
                    </td>

                    <td class="accuracy">
                        <div class="accuracy-white"></div>
                        <div class="accuracy-black"></div>
                    </td>

                    <td class="moves">

                    </td>

                    <td class="date">
                        {{ $game->getDate() }}
                    </td>

                    <td class="link">
                        <a href="{{ $game->getUrl() }}" target="_blank">View game</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
