<?php


namespace App\Helpers;


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
    }

    private function setUrlFromGameData()
    {
        $this->url = $this->gameData['url'];
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
    }

    private function setBlackFromGameData()
    {
        $this->black['username'] = $this->gameData['black']['username'];
        $this->black['rating'] = $this->gameData['black']['rating'];
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
