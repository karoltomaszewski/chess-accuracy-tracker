<?php


namespace App\Http\Controllers;


use App\Services\ChessWebApiService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ReportsController
{
    private const REPORT_GAMES_COUNT = 50;

    /**
     * @param string $nickname
     * @param ChessWebApiService $chessWebApiService
     * @return Application|Factory|View
     * @throws GuzzleException
     */
    public function show(string $nickname, ChessWebApiService $chessWebApiService): View|Factory|Application
    {
        $archives = $chessWebApiService->getPlayerCompleteMonthlyArchives($nickname);

        if (empty($archives)) {
            return view('no_games_found', [
               'nickname' => $nickname
            ]);
        }

        $archiveIndex = count($archives);
        $games = [];

        while (count($games) < self::REPORT_GAMES_COUNT && $archiveIndex > 0) {
            $archiveIndex--;

            $gamesFromArchive = $chessWebApiService->getGamesFromMonthlyArchive($archives[$archiveIndex], 50);
            $games = array_merge($games, $gamesFromArchive);
        }

        return view('report', [
            'nickname' => $nickname,
            'games' => $games
        ]);
    }
}
