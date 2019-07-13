<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe\Test;

use PHPUnit\Framework\TestCase;

use Phoenix\Zero\TicTacToe\Board;
use Phoenix\Zero\TicTacToe\Exception\UnexpectedValueException;

use function is_array;

/**
 * @class BoardTest.
 */
class BoardTest extends TestCase
{

    /**
     * @function testConstruction.
     */
    public function testConstruction()
    {
        $board = new Board();
        $board_x = $board->get();
        $this->assertTrue(is_array($board_x));
        $converted = $board->convert($board_x);
        $this->assertTrue(is_array($converted));
        $this->assertTrue(!($converted === $board_x));
        $convertedBack = $boardconvertBack($converted);
        $this->assertTrue(is_array($convertedBack));
        $this->assertTrue(($convertedBack === $board_x));
        $board->reset();
    }
}
