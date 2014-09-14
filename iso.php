<?php
class ISO7064_1271_36 {
    private static $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXZY";
    private static $modulus = 1271;
    private static $radix = 36;
    
    
    function __construct() {
        ;
    }
    
    /**
     * Return a protected code for the give string
     * 
     * @param type $string
     * @return string 
     */
    function valid($string) {
        $digits = self::compute($string);
        
        return $string . $digits;
    }
    
    
    /**
     * Verify if the given string is a protected code with valid check characters
     * 
     * @param type $string
     * @return boolean
     */
    function verify($string) {
        $seed = substr($string, 0, strlen($string) - 2);
        
        $digits = self::compute($seed);
        if ($digits == substr($string, -2)) {
            return true;
        }
        return false;
    }
    
    /**
     * Compute check characters for the given string
     * 
     * @param type $string
     * @return string Two chars of string
     * @throws Exception
     */
    public static function compute($string) {
        $string = strtoupper($string);
        $p = 0;
        
        for ($n = 0; $n < strlen($string); $n++) {
            $position = strpos(self::$chars, $string[$n]);
            if ($position === false)          
                throw new Exception('Found illegal characters in string: ' . $string);
            
            $p = (($p + $position) * self::$radix) % self::$modulus;
        }
        
        //If we want a double check characters in return, we perform one additional pass with position value equal 0
        $p = ($p * self::$radix) % self::$modulus;
        
        $checksum = (self::$modulus - $p + 1) % self::$modulus;
        
        $second = $checksum % self::$radix;
        $first = ($checksum - $second) / self::$radix;
        
        return self::$chars[$first] . self::$chars[$second];
    }
}