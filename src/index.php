<?php

require_once '../vendor/autoload.php';

use RemiDeBoer\PermutationPromenade\InputReader;

$path = '..\resources\Opdracht_1_Input_Remi_de_Boer.txt';

try {

    $reader = new InputReader($path);
    echo $reader->getContent();
    
} catch (Exception $ex) {
    echo $ex->getMessage();
}



