<?php
class NQueens {
    const SIZE = 8;
    public $numSolutions;


	public function generate($board, $column) {
		if($column == self::SIZE) {
			$this->draw($board);
		} else {
			for($i = 0; $i < self::SIZE; $i++) {
			    if($this->canBePlaced($i, $column, $board)) {
                    $board[$column] = $i;
                    $this->generate($board, $column + 1);
                }
            }
		}
	}

	

	private function canBePlaced($row, $column, $board) {
        for($i=0; $i < self::SIZE; $i++) {
            if($board[$i] !== null) {
                if($board[$i] === $row) {
                    return false;
                }
                if($board[$i] + $i === $row + $column || $board[$i] - $i === $row - $column) {
                    return false;
                }
            }
        }
        return true;
    }


	private function draw($board) {
	    $this->numSolutions++;
	    echo "Drawing solution {$this->numSolutions} \r\n";
        for($i=0; $i<self::SIZE; $i++) {
            for($j=0; $j<self::SIZE; $j++) {
                if($board[$i] === $j) {
                    echo 'X ';
                } else {
                    echo '0 ';
                }
            }
            echo "\r\n";
        }
    }
}



$board = [null, null , null , null, null , null , null , null];
(new NQueens())->generate($board, 0);