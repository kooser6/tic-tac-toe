<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe\Test;

use PHPUnit\Framework\TestCase;

use Phoenix\Zero\TicTacToe\Game;
use Phoenix\Zero\NeuralNetwork\Classifier;

use Phpml\Classification\MLPClassifier;

/**
 * @class StatusTest.
 */
class StatusTest extends TestCase
{
    /**
     * @function testConstruction.
     */
    public function testConstruction()
    {
        $pre_classifier = new MLPClassifier(9, [1], ['x', 'o', '-']);
        $classifier = new Classifier($pre_classifier);
        $controller = new Game($classifier);
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 0));
        $controller->moveAI();
        var_dump($controller->board->get());
        exit;
        $status = $controller->getStatus();
        $this->assertTrue(($status['status'] == 1));
        $controller->reset();
        $this->assertTrue(($status['status'] == 0));
    }
}
