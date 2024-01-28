<?php


namespace App\Helpers;


use Carbon\Carbon;

class Game
{
    private string $timeControl;

    private array $white = [
        'username' => '',
        'score' => '',
        'rating' => '',
        'accuracy' => '',
    ];

    private array $black = [
        'username' => '',
        'score' => '',
        'rating' => '',
        'accuracy' => '',
    ];

    private int $moves;
    private string $date;
    private string $url;

    public function __construct(private array $gameData)
    {
        $this->setValuesFromGameData();
    }

    private function setValuesFromGameData()
    {
        $this->setUrlFromGameData();
        $this->setTimeControlFromGameData();
        $this->setWhiteFromGameData();
        $this->setBlackFromGameData();
        $this->setDateFromGameData();
        $this->setMovesFromGameData();
    }

    private function getValueFromPGN(string $param): ?string
    {
        $startPos = strpos($this->gameData['pgn'], "[$param");

        if ($startPos === false) {
            return null;
        }

        $startPos += strlen("[$param ") + 1;
        $endPos = strpos($this->gameData['pgn'], "]", $startPos) - 1;

        if ($endPos === false) {
            return null;
        }

        return substr($this->gameData['pgn'], $startPos, $endPos - $startPos);
    }

    private function setDateFromGameData()
    {
        $this->date = Carbon::createFromFormat('Y.m.d', $this->getValueFromPGN('UTCDate'))->format('d.m.Y');
    }

    private function setUrlFromGameData()
    {
        $this->url = $this->gameData['url'];
    }

    private function setMovesFromGameData()
    {
        preg_match_all('/ .{0,2}?\d\./', $this->gameData['pgn'], $outputArray);

        // eg. " 1." or " 44." (without quotes)
        $lastEl = end($outputArray[0]);
        $moves = substr($lastEl, 1);
        $moves = (int) $moves;

        $this->moves = $moves;
    }

    private function setTimeControlFromGameData()
    {
        $timeControl = $this->gameData['time_control'];

        $explodedTimeControl = explode('+', $timeControl);
        $startTimeSecs = array_shift($explodedTimeControl);

        $startTimeMinutes = $startTimeSecs / 60;
        array_unshift($explodedTimeControl, $startTimeMinutes);

        $this->timeControl = implode('+', $explodedTimeControl);
    }

    private function setWhiteFromGameData()
    {
        $this->white['username'] = $this->gameData['white']['username'];
        $this->white['rating'] = $this->gameData['white']['rating'];
        $this->white['score'] = explode('-', $this->getValueFromPGN('Result'))[0];
    }

    private function setBlackFromGameData()
    {
        $this->black['username'] = $this->gameData['black']['username'];
        $this->black['rating'] = $this->gameData['black']['rating'];
        $this->black['score'] = explode('-', $this->getValueFromPGN('Result'))[1];
    }

    /**
     * @return string
     */
    public function getTimeControl(): string
    {
        return $this->timeControl;
    }

    /**
     * @return array|string[]
     */
    public function getWhite(): array
    {
        return $this->white;
    }

    /**
     * @return array|string[]
     */
    public function getBlack(): array
    {
        return $this->black;
    }

    /**
     * @return int
     */
    public function getMoves(): int
    {
        return $this->moves;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
