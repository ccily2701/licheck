<?php
namespace Shf\Exceptions;

use Exception;

class LiCheckException extends Exception
{
    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }
}
