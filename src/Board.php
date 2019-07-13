<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe;

use function reset;
use function array_push;

/**
 * @class Board.
 */
class Board
{

    /** @var array $board The tic tac toe board. */
    private $board = [
        '-', '-', '-',
        '-', '-', '-',
        '-', '-', '-',
    ];

    /**
     * Reset the board.
     *
     * @return void Returns nothing.
     */
    public function reset(): void
    {
        $this->board = [
            '-', '-', '-',
            '-', '-', '-',
            '-', '-', '-',
        ];
    }

    /**
     * Get the board.
     *
     * @return array The current tic tac toe board.
     */
    public function get(): array
    {
        return $this->board;
    }

    /**
     * Set the board.
     *
     * @return void Returns nothing.
     */
    public function set(array $board): void
    {
        $this->board = $board;
    }

    /**
     * Convert the board.
     *
     * @return array The converted board.
     */
    public function convert(): array
    {
        $return = [];
        reset($this->board);
        foreach ($this->board as $square) {
            if ($square == '-') {
                array_push($this->board, 0);
            } elseif ($square == 'x') {
                array_push($this->board, 1);
            } elseif ($square == 'o') {
                array_push($this->board, 2);
            } else {
                throw new Exception\UnexpectedValueException('The board is corrupt.');
            }
        }
        return $return;
    }
}
