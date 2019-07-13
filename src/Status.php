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
        $status['status'] = 0;
        reset($board);
        if (($board[0] === 1 && $board[4] === 1 && $board[8] === 1)
            || ($board[0] === 1 && $board[1] === 1 && $board[2] === 1)
            || ($board[0] === 1 && $board[3] === 1 && $board[6] === 1)
            || ($board[1] === 1 && $board[4] === 1 && $board[7] === 1)
            || ($board[2] === 1 && $board[5] === 1 && $board[8] === 1)
            || ($board[2] === 1 && $board[4] === 1 && $board[6] === 1)
            || ($board[3] === 1 && $board[4] === 1 && $board[5] === 1)
            || ($board[6] === 1 && $board[7] === 1 && $board[8] === 1)) {
            $status['status'] = 1;
            $status['result'] = 1;
        } elseif (($board[0] === 1 && $board[4] === 1 && $board[8] === 1)
            || ($board[0] === 2 && $board[1] === 2 && $board[2] === 2)
            || ($board[0] === 2 && $board[3] === 2 && $board[6] === 2)
            || ($board[1] === 2 && $board[4] === 2 && $board[7] === 2)
            || ($board[2] === 2 && $board[5] === 2 && $board[8] === 2)
            || ($board[2] === 2 && $board[4] === 2 && $board[6] === 2)
            || ($board[3] === 2 && $board[4] === 2 && $board[5] === 2)
            || ($board[6] === 2 && $board[7] === 2 && $board[8] === 2)) {
            $status['status'] = 1;
            $status['result'] = 2;
        } else {
            reset($board);
            foreach ($board as $square) {
                if ($square == 0) {
                    $status['result'] = null;
                    return $status;
                }
            }
        }
        return $status;
    }
}
