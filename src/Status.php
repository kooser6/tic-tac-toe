<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe;

use function reset;

use const null;

/**
 * @class Status.
 */
class Status
{

    /**
     * Check to see if the board is finished and no more moves can be made.
     *
     * @param array $board The converted board.
     *
     * @return array Contains the current game status and game result.
     */
    public function gameOver(array $board): array
    {
        $status = [];
        $status['result'] = null;
        reset($board);
        $order = [
            [ 0, 1, 2, ],
            [ 0, 3, 6, ],
            [ 1, 4, 7, ],
            [ 2, 5, 8, ],
            [ 2, 4, 6, ],
            [ 0, 4, 8, ],
            [ 3, 4, 5, ],
            [ 6, 7, 8, ],
        ];
        $x = 1;
        runAgain:
        for ($e = 0; $e <= 7; $e++) {
            if ($board[$order[$e][0]] === $x && $board[$order[$e][1]] === $x && $board[$order[$e][2]] === $x) {
                $status['result'] = $x;
                goto skipSection;
            }
        }
        if ($x = 1) {
            $x = 2;
            goto runAgain;
        }
        skipSection:
        if (!is_null($status['result'])) {
            $status['status'] = 1;
            return $status;
        }
        $status['status'] = 1;
        reset($board);
        foreach ($board as $square) {
            if ($square == 0) {
                $status['status'] = 0;
            }
        }
        if ($status['status'] === 1) {
            $status['result'] = 0;
        }
        return $status;
    }
}
