<?php

namespace RemiDeBoer\PermutationPromenade;

use InvalidArgumentException;

/**
 * Responsible for executing single permutating moves
 * on a non-unicode string
 * @author Rémi de Boer <remideboer@yahoo.com>
 */
class Permutator {

    const ZERO_STRING_EXCEPTION = "can not spin a zero string";
    const FIRST_CHAR_POSITION = 0;
    const LAST_CHAR_POSITION = -1;

    /**
     * Takes the last character of the incoming string puts it into
     * the front of the string and shifts al remaining up
     * abcde -> takes last e in front -> eabcd
     * @param string $string non-unicode
     * @return string
     */
    public static function spin(string $string): string {

        Permutator::validateNonZeroString($string);
        
        return $string[self::LAST_CHAR_POSITION]
                . substr($string, self::FIRST_CHAR_POSITION, self::LAST_CHAR_POSITION);
    }

    /**
     * Swaps characters in given positions in the supplied string 
     * positions are zero based
     * @param string $string non-unicode string in which positions will be swapped
     * @param int $positionA char at given index that needs to be swapped with char at $positionB
     * @param int $positionB char at given index that needs to be swapped with char at $positionA
     * $return string
     */
    public static function exchange(string $string, int $positionA, int $positionB): string {
        
        Permutator::validateNonZeroString($string);
        Permutator::validatePosition($string, $positionA);
        Permutator::validatePosition($string, $positionB);

        // get chars at positions
        $charA = $string{$positionA};
        $charB = $string{$positionB};

        // convert to char array
        $chars = str_split($string);

        // put chars in the swapped place
        $chars[$positionA] = $charB;
        $chars[$positionB] = $charA;

        return implode("", $chars);
    }
    
    /**
     * Validates if the given positions is within string bounds
     * @param string $string
     * @param int $position
     * @throws InvalidArgumentException
     */
    private static function validatePosition(string $string, int $position){
        if ($position < 0 || $position > strlen($string) - 1) {
            throw new InvalidArgumentException("The given position {$position} is out of string bounds");
        }
    }
    
    /**
     * Validates if the supplied string is of non-zero length
     * @param string $str
     * @throws InvalidArgumentException
     */
    private function validateNonZeroString(string $str){
        if (strlen($str) <= 0) {
            throw new InvalidArgumentException(self::ZERO_STRING_EXCEPTION);
        }
    }

}
