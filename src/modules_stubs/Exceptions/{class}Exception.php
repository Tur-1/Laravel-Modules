<?php

namespace {namespace};

use Exception; 

class {class}Exception extends Exception
{
    /**
     * Handle "Record Not Found" exception.
     *
     * @return self
     */
    public static function notFound(): self
    {
        return new self("{modelVariable} not found.", 404);
    }

}
