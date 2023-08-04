<?php
namespace App\Exceptions;

use Exception;

class LiCheckException extends Exception
{
    public function render()
    {
        return $this->getMessage();
    }
}
