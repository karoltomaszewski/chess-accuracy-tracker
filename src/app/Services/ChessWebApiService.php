<?php


namespace App\Services;


use App\Helpers\Game;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ChessWebApiService
{
    /**
     * @throws GuzzleException
     */
    public function getPlayerCompleteMonthlyArchives(string $nickname): array
    {
        $client = new Client();

        $res = $client->request('GET', 'https://api.chess.com/pub/player/' . $nickname . '/games/archives');

        return json_decode($res->getBody(), true)['archives'];
    }

    /**
     * @throws GuzzleException
     */
    public function getGamesFromMonthlyArchive(string $archiveUrl, int $maxNumberOfGames): array
    {
        $client = new Client();

        $res = $client->request('GET', $archiveUrl);

        $games = json_decode($res->getBody(), true)['games'];
        $gamesCount = count($games);

        if ($maxNumberOfGames < $gamesCount) {
            array_splice($games, 0, $gamesCount - $maxNumberOfGames);
        }

        $gamesCount = min($gamesCount, $maxNumberOfGames);
        $gamesObjects = [];

        for ($i = $gamesCount - 1; $i >= 0; $i--) {
            $gamesObjects[] = new Game($games[$i]);
        }

        return $gamesObjects;
    }
}
