<?php

use PHPUnit\Framework\TestCase;
use RemiDeBoer\PermutationPromenade\Permutator;

/**
 * Testing the Permutator moves: spin, exchange and partner
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class PermutatorTest extends TestCase {

    private $fullLineUp = "abcdefghijklmnop";
    
    /**
     * @test
     */
    public function spinFullLineUp(){
        $expected = "pabcdefghijklmno";
        $actual = Permutator::spin($this->fullLineUp);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function spinNoHardcodedReturn(){
        // first spin
        $lineUp = "abcde";
        $expected = "eabcd";
        $actual = Permutator::spin($lineUp);
        $this->assertEquals($expected, $actual);
        
        // second spin
        $lineUp = "eabcd";
        $expected = "deabc";
        $actual = Permutator::spin($lineUp);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function spinZeroStringThrowsInvalidArgumentExceptionWithMessage(){
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("can not spin a zero string");
        $input = "";
        Permutator::spin($input);
    }
    
    /**
     * @test
     */
    public function exchangeNoHardcodedReturn(){
        $lineUp = "eabcd";
        $expected = "eabdc";
        $positionA = 3;
        $positionB = 4;
        $actual = Permutator::exchange($lineUp, $positionA, $positionB);
        $this->assertEquals($expected, $actual);
        
        $lineUp = "eabdc";
        $expected = "baedc";
        $positionA = 0;
        $positionB = 2;
        $actual = Permutator::exchange($lineUp, $positionA, $positionB);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function exchangeFullLineUp(){
        $expected = "abcdenghijklmfop";
        $positionA = 5;
        $positionB = 13;
        $actual = Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function exchangePostionBOutOfPositiveBoundsThrowsInvalidArgumentExceptionWithMessage(){
        $positionA = 5;
        $positionB = strlen($this->fullLineUp);
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("The given position {$positionB} is out of string bounds");
        
        Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        
    }
    
    /**
     * @test
     */
    public function exchangePostionBOutOfNegativeBoundsThrowsInvalidArgumentExceptionWithMessage(){
        $positionA = 5;
        $positionB = -1;
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("The given position {$positionB} is out of string bounds");
        
        Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        
    }
    
    /**
     * @test
     */
    public function exchangePostionAOutOfPositiveBoundsThrowsInvalidArgumentExceptionWithMessage(){
        $positionA = strlen($this->fullLineUp);
        $positionB = 5;
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("The given position {$positionA} is out of string bounds");
        
        Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        
    }
    
    /**
     * @test
     */
    public function exchangePostionAOutOfNegativeBoundsThrowsInvalidArgumentExceptionWithMessage(){
        $positionA = -1;
        $positionB = 3;
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("The given position {$positionA} is out of string bounds");
        
        Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        
    }
    
    /**
     * @test
     */
    public function exchangePostionAIsHigherThenB(){
        $expected = "abcmefghijkldnop";
        $positionA = 12;
        $positionB = 3;
        $actual = Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function exchangePostionAIsEqualToB(){
        $expected = "abcdefghijklmnop";
        $positionA = strlen($this->fullLineUp)/2;
        $positionB = strlen($this->fullLineUp)/2;
        $actual = Permutator::exchange($this->fullLineUp, $positionA, $positionB);
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function exchangeZeroStringThrowsInvalidArgumentExceptionWithMessage(){
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("can not spin a zero string");
        $input = "";
        Permutator::exchange($input, 1, 2);
    }
}
