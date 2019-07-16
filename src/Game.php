<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe;

use Phoenix\Zero\NeuralNetwork\Classifier;
use Phoenix\Zero\NeuralNetwork\Manager;

use function count;
use function in_array;
use function array_push;

/**
 * @class Game.
 */
class Game
{

    /** @var Classifier $classifier The neural network classifier. */
    private $classifier;

    /** @var Evaluation $evaluation The evaluation function for the self-learning AI. */
    public $evaluation;

    /** @var Status $status The game status handler. */
    public $status;

    /** @var Board $board The game board handler. */
    public $board;

    /** @var int $turn Whos turn is it to play. */
    public $turn;

    /**
     * Construct a new game controller.
     *
     * @param Classifier $classifier The neural network classifier.
     *
     * @return void Returns nothing.
     */
    public function __construct(Classifier $classifier)
    {
        $this->classifier = $classifier;
        $this->evaluation = new Evaluation($classifier);
        $this->status = new Status();
        $this->board = new Board();
        $this->turn = 1;
    }

    /**
     * Reset the board.
     *
     * @return void Returns nothing.
     */
    public function reset(): void
    {
        $this->board->reset();
    }

    /**
     * Make the AI move.
     *
     * @return void Returns nothing.
     */
    public function moveAI(): void
    {
        $status = $this->getStatus();
        if ($status['status'] === 0) {
            $board = $this->board->get();
            $converted = $this->board->convert($board);
            $predictedBoard = $this->evaluation->predict($board, $this->turn);
            $convertedBack = $this->board->convertBack($predictedBoard);
            $this->board->set($convertedBack);
            if ($this->turn === 1) {
                $this->turn = 2;
            } else {
                $this->turn = 1;
            }
        }
    }

    /**
     * Make a move.
     *
     * @param int $key The array key to place piece.
     *
     * @return void Returns nothing.
     */
    public function move(int $key): void
    {
        $keys = [
            0, 1, 2,
            3, 4, 5,
            6, 7, 8,
        ];
        $key = $key - 1;
        $status = $this->getStatus();
        if (in_array($key, $keys) && $status['status'] === 0) {
            $board = $this->board->get();
            $converted = $this->board->convert($board);
            if ($converted[$key] === 0) {
                $converted[$key] = $this->turn;
                $convertedBack = $this->board->convertBack($converted);
                $this->board->set($convertedBack);
                if ($this->turn === 1) {
                    $this->turn = 2;
                } else {
                    $this->turn = 1;
                }
            }
        }
    }

    /**
     * Get the board status.
     *
     * @return array The board status.
     */
    public function getStatus(): array
    {
        $board = $this->board->get();
        $converted = $this->board->convert($board);
        return $this->status->gameOver($converted);
    }

    /**
     * Allow the AI to self play games and train the neural network.
     *
     * @param int $numberOfGames The number of games to play.
     *
     * @return void Returns nothing.
     */
    public function selfPlay(int $numberOfGames = 10): void
    {
        for ($i = 1; $i <= $numberOfGames; $i++) {
            $frames = [];
            $this->reset();
            $board = $this->board->get();
            $converted = $this->board->convert($board);
            array_push($frames, $converted);
            $status = 0;
            $statusAlt = [];
            while ($status !== 1) {
                $board = $this->board->get();
                $converted = $this->board->convert($board);
                $this->moveAI();
                array_push($frames, $converted);
                $statusAlt = $this->getStatus();
                $status = $statusAlt['status'];
            }
            if (empty($statusAlt)) {
                exit;
            }
            $result = $statusAlt['result'];
            if ($result === 1) {
                $resultAlt = 'x';
            } elseif ($result === 2) {
                $resultAlt = 'o';
            } else {
                $resultAlt = 'd';
            }
            $frames_num = count($frames);
            $result_arr = [];
            for ($x = 1; $x <= $frames_num; $x++) {
                array_push($result_arr, $resultAlt);
            }
            $this->classifier->train($frames, $result_arr);
        }
        $manager = new Manager($this->classifier->returnInstance());
        $manager->setPath('networks');
        $manager->save('tic-tac-toe');
    }
}
