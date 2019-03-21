<?php
define('EOL', "\r\n");
include "Stack.php";

class State {

    public $board;
    public $row;

    public function __construct(array $board, int $row)
    {
        $this->board = $board;
        $this->row = $row;
    }
}

/**
 * Class NQueens
 */
class NQueens
{
    public $numSolutions;
    private $size;

    public $executionTime;
    private $startTime;


    /**
     * NQueens constructor.
     */
    public function __construct($size = 8)
    {
        $this->size = $size;
        $this->startTime = microtime(true);
    }

    /**
     * Inicialización. El tablero se representa así [0,1,2,3,4,5,6,7].
     * Eso significa que en la primera fila, la reina está en la columna 0,
     * en la segunda fila, la reina está en la columna 1, etc etc....
     *
     * @return $this
     */
    public function main()
    {
        $this->generate();
        $this->executionTime = round(microtime(true) - $this->startTime, 2);
        return $this;
    }

    /**
     * Ésta función tiene que generar todos los tableros válidos. A cada tablero válido puedes invocar a draw para pintarlo
     *
     * @param $board
     * @param $row
     */
    private function generate()
    {
        $board = array_fill(0, $this->size, null);
        $stack = new Stack();
        $expandedNodes = [];
        $board[0] = 0;
        $stack->push(new State($board, 0));

        do {
            $currentState = $stack->pop();
            $expandedNodes[] = $currentState;
            if ($currentState->row >= $this->size) {
                $this->draw($currentState->board, true);
            }
            else {
                for ($i = 0; $i < $this->size; $i++) {
                    if ($this->canBePlaced($i, $currentState->row, $currentState->board)) {
                        $newBoard = $currentState->board;
                        $newBoard[$currentState->row] = $i;
                        $stack->push(new State($newBoard, $currentState->row + 1));
                    }
                }
            }
        } while(!$stack->isEmpty());
    }


    /**
     * Ésta función puede ser usada desde generate para comprobar si los tableros son válidos
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
     * Ésta función dibuja un tablero.
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
echo "Num Solutions: {$nQueens->numSolutions}. Execution time {$nQueens->executionTime}".EOL;
