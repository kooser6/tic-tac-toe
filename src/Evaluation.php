<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe;

use Phoenix\Zero\NeuralNetwork\Classifier;

use function reset;
use function array_push;
use function random_int;
use function count;

use const true;

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
    public function predict(array $board, int $turn = 1, bool $isLearning = true): array
    {
        $news = [];
        $wins = [];
        $draw = [];
        $lost = [];
        reset($board);
        foreach ($board as $id => $square) {
            if ($square === 0) {
                $boardAlt = $board;
                $boardAlt[$id] = $turn;
                $result = $this->classifier->predict([$boardAlt]);
                if ($result[0] === '-') {
                    if ($isLearning = true) {
                        array_push($news, $boardAlt);
                    } else {
                        array_push($draw, $boardAlt);
                    }
                } elseif ($result[0] === 'x') {
                    if ($turn === 2) {
                        array_push($wins, $boardAlt);
                    } else {
                        array_push($lost, $boardAlt);
                    }
                } elseif ($result[0] === 'o') {
                    if ($turn === 2) {
                        array_push($wins, $boardAlt);
                    } else {
                        array_push($lost, $boardAlt);
                    }
                } else {
                    array_push($draw, $boardAlt);
                }
            }
        }
        $news_num = count($news);
        $wins_num = count($wins);
        $lost_num = count($lost);
        $draw_num = count($draw);
        if ($news_num > 0) {
            $boardChange = $news[random_int(0, $news_num - 1)];
            return $boardChange;
        } elseif ($wins_num > 0) {
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
