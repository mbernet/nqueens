<?php
define('EOL', "\r\n");

/**
 * Class NQueens
 */
class NQueens
{
    public $numSolutions;
    private $size;


    /**
     * NQueens constructor.
     */
    public function __construct($size = 8)
    {
        $this->size = $size;
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
        // Ejemplo draw:
        $this->draw([0,1,2,3,4,5,6,7], false);
        $board = array_fill(0, $this->size, null);
        $this->generate($board, 0);

        return $this;
    }

    /**
     * Ésta función tiene que generar todos los tableros válidos. A cada tablero válido puedes invocar a draw para pintarlo
     *
     * @param $board
     * @param $row
     */
    private function generate($board, $row)
    {

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
        // check if queen can be placed here
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
echo "Num Solutions: {$nQueens->numSolutions}.".EOL;
