<?php

use PHPUnit\Framework\TestCase;
use RemiDeBoer\PermutationPromenade\InputReader;
use RemiDeBoer\PermutationPromenade\FileNotFoundException;

/**
 * Description: small integration test to test if InputReader can correctly read
 * file and handle exceptions 
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class InputReaderTest extends TestCase{
    
    /**
     * @test
     */
    function testGetContentValidFile(){
        $testfile = 'test/resources/input_test.txt';
        
        $instance = new InputReader($testfile);
        $result = $instance->getContent();
        
        $expected = 'a b c word another sentence';
        $this->assertEquals($expected, $result);
    }
    
    /**
     * @test
     */
    function testGetContentFileNotFoundThrowsExceptionWithMessage(){
        $testfile = 'does_not_exist.txt';
        
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage("File named: [{$testfile}] does not exist");
        
        $instance = new InputReader($testfile);
        
         
    }
}
