<?php

namespace RemiDeBoer\PermutationPromenade;

/**
 * Thrown when a file can not be found
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class FileNotFoundException extends \Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
