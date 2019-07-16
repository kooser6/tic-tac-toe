<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe;

use Phoenix\Zero\NeuralNetwork\Classifier;

use function reset;
use function array_push;
use function random_int;
use function count;

/**
 * @class Evaluation.
 */
class Evaluation
{

    /** @var Classifier $classifier The neural network. */
    private $classifier;

    /**
     * Consruct a new tic tac toe evaluation.
     *
     * @param Classifier $classifier The neural network.
     *
     * @return void Returns nothing.
     */
    public function __construct(Classifier $classifier)
    {
        $this->classifier = $classifier;
    }

    /**
     * Return the next best move based on neural netowork.
     *
     * @param array $board The tic tac toe board converted.
     * @param int   $turn  The current sides move.
     *
     * @return array The new board based on AI predictions.
     */
    public function predict(array $board, int $turn = 1): array
    {
        $wins = [];
        $draw = [];
        $lost = [];
        reset($board);
        $x = 0;
        foreach ($board as $square) {
            if ($square === 0) {
                $boardAlt = $board;
                $boardAlt[$x] = $turn;
                $result = $this->classifier->predict([$boardAlt]);
                var_dump(is_array($result));
                exit;
                if ($result === 'x') {
                    if ($turn === 1) {
                        array_push($wins, $boardAlt);
                    } else {
                        array_push($lost, $boardAlt);
                    }
                } elseif ($result === 'o') {
                    if ($turn === 2) {
                        array_push($wins, $boardAlt);
                    } else {
                        array_push($lost, $boardAlt);
                    }
                } else {
                    array_push($draw, $boardAlt);
                }
            }
            $x++;
        }
        $wins_num = count($wins);
        $lost_num = count($lost);
        $draw_num = count($draw);
        if ($wins_num > 0) {
            $boardChange = $wins[random_int(0, $wins_num - 1)];
            return $boardChange;
        } elseif ($draw_num > 0) {
            $boardChange = $draw[random_int(0, $draw_num - 1)];
            return $boardChange;
        } elseif ($lost_num > 0) {
            $boardChange = $lost[random_int(0, $lost_num - 1)];
            return $boardChange;
        } else {
            return $board;
        }
    }
}
