<?php
define('EOL', "\r\n");

/**
 *
 * El problema de las ocho reinas es un pasatiempo que consiste en poner ocho reinas en el tablero de ajedrez sin que se amenacen
 *
 * Class NQueens
 */
class NQueens
{
    private $size;

    public function __construct($size = 8)
    {
        $this->size = $size;
    }

    /**
     * Ésta función tiene que mostrar al usuario todas las posibles soluciones.
     *
     * Como cada reina puede amenazar a todas las reinas que estén en la misma fila, cada una ha de situarse en una
     * fila diferente. Podemos representar las 8 reinas mediante un vector[1-8], teniendo en cuenta que cada índice del
     * vector representa una fila y el valor una columna
     *
     * Vamos a utilizar entonces un array PHP con el tamaño size para representar el tablero. por ejemplo:
     *
     * [0, 4, 7, 5, 2, 6, 1, 3] Representa un tablero así
     *
     *       ♕  ·  ■  ·  ■  ·  ■  ·
     *       ·  ■  ·  ■  ♕  ■  ·  ■
     *       ■  ·  ■  ·  ■  ·  ■  ♕
     *       ·  ■  ·  ■  ·  ♕  ·  ■
     *       ■  ·  ♕  ·  ■  ·  ■  ·
     *       ·  ■  ·  ■  ·  ■  ♕  ■
     *       ■  ♕  ■  ·  ■  ·  ■  ·
     *       ·  ■  ·  ♕  ·  ■  ·  ■
     *
     * Ya que la primera reina de la primera fila está en la posición 0,
     * La segunda reina de la segunda fila está en la posición 4,
     * etc
     * etc.
     *
     *
     * La función draw dibuja una representación gráfica de ésta estructura
     *
     * @return $this
     */
    public function main()
    {
        $board = array_fill(0, $this->size, null); // Inicializamos el tablero a 0 (sin reinas) y llamamos a la función para generar las soluciones
        $this->generate($board);
    }


    /**
     * La función generate puede llevar más argumentos si se necesitan.
     *
     * También se recomienda separar algo de lógica en una función auxiliar para saber si las reinas se matan entre si
     * o están en posición correcta.
     *
     * @param $board
     */
    private function generate($board)
    {

    }




    /**
     * @param $board
     */
    private function draw($board)
    {
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


/**
 * Llamamos al programa con un size de 8 reinas en un tablero de 8x8
 */
(new NQueens(8))->main();
