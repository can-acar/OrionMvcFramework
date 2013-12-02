<?php
namespace  OrionMvc;
/**
 * This is class IgnorantRecursiveDirectoryIterator
 *
 */
class IgnorantRecursiveDirectoryIterator extends \RecursiveDirectoryIterator { 
    function getChildren() { 
        try { 
            return new \IgnorantRecursiveDirectoryIterator($this->getPathname()); 
        } catch(UnexpectedValueException $e) { 
            return new \RecursiveArrayIterator(array()); 
        } 
    } 
}
?>