<?php

namespace RemiDeBoer\PermutationPromenade;

/**
 * Reads the input of a given text file
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class InputReader {
    
    private $file;

    public function __construct($file){
        if(file_exists($file)){
            $this->file = $file; 
        } else {
            throw new FileNotFoundException("File named: [{$file}] does not exist");
        }
    }
    
    /**
     * Retrives the contents of the file
     * @return string
     */
    public function getContent(): string{
        return file_get_contents($this->file); 
    }
}
