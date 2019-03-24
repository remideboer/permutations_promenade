<?php

use PHPUnit\Framework\TestCase;
use RemiDeBoer\PermutationPromenade\Choreographer;

/**
 * Test the Choreographer class that does the actual permatuation dance
 * based on a given input
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class ChoreographerTest extends TestCase {

    /**
     * @test
     */
    public function performDanceEmptyInputThrowsInvalidArgumentExceptionWithMessage(){
        $instance = new Choreographer("");
        
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The given move [] is unknown");

        $instance->performDance();
    }
    
    /**
     * @test
     */
    public function performDanceSingleSpinOnceValidDanceInput(){
        $instance = new Choreographer("s1");
        $expected = "pabcdefghijklmno";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performDanceSingleSpinTwiceValidDanceInput(){
        $instance = new Choreographer("s2");
        $expected = "opabcdefghijklmn";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performDanceDoubleSpinOnceValidDanceInput(){
        $instance = new Choreographer("s1,s1");
        $expected = "opabcdefghijklmn";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performDanceSingleExchangeValidDanceInput(){
        $instance = new Choreographer("x4/14");
        $expected = "abcdofghijklmnep";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performDanceSinglePartnerValidDanceInput(){
        $instance = new Choreographer("pf/m");
        $expected = "abcdemghijklfnop";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performSequanceOfMovesPartnerExchangeSpinValidDanceInput(){
        $instance = new Choreographer("pf/m,x4/14,s2");
        $expected = "epabcdomghijklfn";
        $actual = $instance->performDance();
        
        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function performDanceUnkownMoveThrowsThrowsInvalidArgumentExceptionWithMessage(){
        $instance = new Choreographer("qf/m");
        
        $this->expectException(InvalidArgumentException ::class);
        $this->expectExceptionMessage("The given move [q] is unknown");

        $instance->performDance();
    }
    
    /**
     * @test
     */
    public function performDanceMoveStringTooShortToContainValidMoveThrowsInvalidArgumentExceptionWithMessage(){
        $instance = new Choreographer("q");
        
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The given move [q] is unknown");

        $instance->performDance();
    }
    
}
