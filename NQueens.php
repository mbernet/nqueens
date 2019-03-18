<?php
define('EOL', "\r\n");

/**
 * Class NQueens
 */
class NQueens
{
    public $numSolutions;
    public $executionTime;

    private $startTime;
    private $size;


    /**
     * NQueens constructor.
     */
    public function __construct($size = 8)
    {
        $this->size = $size;
        $this->startTime = microtime(true);
    }

    /**
     * @return $this
     */
    public function main()
    {
        $board = array_fill(0, $this->size, null);
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
        if ($row == $this->size) {
            $this->draw($board, true);
        } else {
            for ($i = 0; $i < $this->size; $i++) {
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
        for ($i=0; $i<$this->size; $i++) {
            for ($j=0; $j<$this->size; $j++) {
                if ($j == 0) {
                    echo $this->size - $i;
                }
                if ($board[$i] === $j) {
                    echo ' ♕ ';
                } else {
                    echo ($i+$j)%2 == 0 ? ' ■ ': ' · ';
                }
            }
            echo EOL;
        }
        echo "*";
        for ($i=0; $i<$this->size; $i++) {
            $char = chr(ord('a')+$i);
            echo " $char ";
        }
        echo EOL.EOL;
    }
}

$nQueens = (new NQueens(8))->main();
echo "Num Solutions: {$nQueens->numSolutions}. Time elapsed: {$nQueens->executionTime}".EOL;
