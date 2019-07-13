<?php declare(strict_types=1);

namespace Phoenix\Zero\TicTacToe\Exception;

use UnexpectedValueException as UnexpectedValueExceptionSpl;

/**
 * @class UnexpectedValueException.
 */
class UnexpectedValueException extends UnexpectedValueExceptionSpl implements ExceptionInterface
{
}
