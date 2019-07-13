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
     * @param array The original board.
     *
     * @return array The converted board.
     */
    public function convert(array $board): array
    {
        $return = [];
        reset($board);
        foreach ($board as $square) {
            if ($square == '-') {
                array_push($board, 0);
            } elseif ($square == 'x') {
                array_push($board, 1);
            } elseif ($square == 'o') {
                array_push($board, 2);
            } else {
                throw new Exception\UnexpectedValueException('The board is corrupt.');
            }
        }
        return $return;
    }

    /**
     * Convert the board back.
     *
     * @param array $board The converted board.
     *
     * @return array The original board.
     */
    public function convertBack($board): array
    {
        $return = [];
        reset($board);
        foreach ($board as $square) {
            if ($square == 0) {
                array_push($board, '-');
            } elseif ($square == 1) {
                array_push($board, 'x');
            } elseif ($square == 2) {
                array_push($board, 'o');
            } else {
                throw new Exception\UnexpectedValueException('The board is corrupt.');
            }
        }
        return $return;
    }
}
