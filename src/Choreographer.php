<?php

namespace RemiDeBoer\PermutationPromenade;

use InvalidArgumentException;

/**
 * Performs the permatution promenade dance based on a given input
 *
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class Choreographer {

    private const MINIMUM_COMMAND_LENGTH = 2;
    private const COMMAND_POSITION = 0;
 
    private const SPIN_PARAMETER = 1;
    private const PARAMETER_DELIMITER = "/";
    private const PARAMETER_START = 1;
    private const FIRST_PARAMETER = 0;
    private const SECOND_PARAMETER = 1;
    
    // available commands
    private const SPIN_COMMAND = 's';
    private const EXCHANGE_COMMAND = 'x';
    private const PARTNER_COMMAND = 'p';

    /**
     * Holds the current program line up
     * @var string 
     */
    private $currentLineUp = "abcdefghijklmnop";

    /**
     * Holds a string array containin moves to be executed 
     * @var array 
     */
    private $moveList;

    public function __construct(string $moves) {
        $this->moveList = explode(',', trim($moves));
    }

    /**
     * Perform the Permutation Promenade dance based on given input string
     * and returns the end positions
     * @return string
     */
    public function performDance(): string {
        // iterate through dance and execute move
        // must contain valid moves
        foreach ($this->moveList as $move) {
            if (strlen($move) >= self::MINIMUM_COMMAND_LENGTH) {

                $this->performMove($move);
                
            } else {
                $command = strlen($move > 0) ? $move[self::COMMAND_POSITION] : $move;
                throw new InvalidArgumentException("The given move [{$command}] is unknown");
            }
        }
        return $this->currentLineUp;
    }

    /**
     * Performs move command
     * @param type $move
     * @throws InvalidArgumentException
     */
    private function performMove(string $move) {
        
        if ($move{self::COMMAND_POSITION} === self::SPIN_COMMAND) {
            // we have spin
            $this->doSpin($move);
            
        } elseif ($move{self::COMMAND_POSITION} === self::EXCHANGE_COMMAND) {

            $this->doExchange($move);
            
        } elseif ($move{self::COMMAND_POSITION} === self::PARTNER_COMMAND) {
            
            $this->doPartner($move);
            
        } else {
            throw new InvalidArgumentException(
                    "The given move [{$move[self::COMMAND_POSITION]}] is unknown");
        }
    }

    /**
     * Parses input and performs spin permutation
     * @param string $move
     */
    private function doSpin(string $move) {
        // get spin size from second character
        $size = $move{self::SPIN_PARAMETER};
        $this->currentLineUp = Permutator::spin($this->currentLineUp, $size);
    }

    /**
     * Parses input and performs exchange permutation
     * @param string $move
     */
    private function doExchange(string $move) {
        // we have exchange, split again for positions
        $positions = explode(self::PARAMETER_DELIMITER, substr($move, self::PARAMETER_START));
        
        $this->currentLineUp = Permutator::exchange($this->currentLineUp, 
                $positions[self::FIRST_PARAMETER], $positions[self::SECOND_PARAMETER]);
    }

    /**
     * Parses input and performs partner permutation
     * @param string $move
     */
    private function doPartner(string $move) {
        // we have partner, split again for characters to swap
        $characters = explode(self::PARAMETER_DELIMITER, substr($move, self::PARAMETER_START));
        
        $this->currentLineUp = Permutator::partner($this->currentLineUp, 
                $characters[self::FIRST_PARAMETER], $characters[self::SECOND_PARAMETER]);
    }

}
