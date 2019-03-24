<?php

require_once '../vendor/autoload.php';

use RemiDeBoer\PermutationPromenade\InputReader;
use RemiDeBoer\PermutationPromenade\Choreographer;

try {
    $path = '..\resources\Opdracht_1_Input_Remi_de_Boer.txt';
    
    $reader = new InputReader($path);
    $choreographer = new Choreographer($reader->getContent());
    
    echo $choreographer->performDance();
    
} catch (Exception $ex) {
    
    echo $ex->getMessage();
    
}



