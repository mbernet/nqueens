<?php
define('EOL', "\r\n");

/**
 * Class NQueens
 */
class NQueens
{
    const SIZE = 8;
    public $numSolutions;
    public $executionTime;

    private $startTime;


    /**
     * NQueens constructor.
     */
    public function __construct()
    {
        $this->startTime = microtime(true);
    }

    /**
     * @return $this
     */
    public function main()
    {
        $board = array_fill(0, self::SIZE, null);
        $this->generate($board, 0);
        $this->executionTime = round(microtime(true) - $this->startTime, 2);
        return $this;
    }

    /**
     * @param $board
     * @param $row
     */
    private function generate($board, $row)
    {
        if ($row == self::SIZE) {
            $this->draw($board, true);
        } else {
            for ($i = 0; $i < self::SIZE; $i++) {
                if ($this->canBePlaced($i, $row, $board)) {
                    $board[$row] = $i;
                    $this->generate($board, $row + 1);
                }
            }
        }
    }


    /**
     * @param $col
     * @param $row
     * @param $board
     *
     * @return bool
     */
    private function canBePlaced($col, $row, $board)
    {
        for ($i=0; $i < $row; $i++) {
            if ($board[$i] !== null) {
                if ($board[$i] === $col) {
                    return false;
                }
                if ($board[$i] + $i === $col + $row || $board[$i] - $i === $col - $row) {
                    return false;
                }
            }
        }
        return true;
    }


    /**
     * @param $board
     * @param bool $isCorrect
     */
    private function draw($board, $isCorrect = false)
    {
        if ($isCorrect) {
            $this->numSolutions++;
            echo " * Drawing solution {$this->numSolutions} * ".EOL;
        } else {
            echo "Drawing board: ".EOL;
        }
        $z=0;
        for ($i=0; $i<self::SIZE; $i++) {
            for ($j=0; $j<self::SIZE; $j++) {
                if ($j == 0) {
                    echo self::SIZE - $i;
                }
                if ($board[$i] === $j) {
                    echo ' ♕ ';
                } else {
                    echo $z%2 == 0 ? ' ■ ': ' · ';
                }
                $z++;
            }
            $z++;
            echo EOL;
        }
        echo "*";
        for ($i=0; $i<self::SIZE; $i++) {
            $char = chr(ord('a')+$i);
            echo " $char ";
        }
        echo EOL.EOL;
    }
}

$nQueens = (new NQueens())->main();
echo "Num Solutions: {$nQueens->numSolutions}. Time elapsed: {$nQueens->executionTime}".EOL;
