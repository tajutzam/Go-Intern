<?php

namespace LearnPhpMvc;

use PHPUnit\Framework\TestCase;

class RegexTestTest extends TestCase
{
    public function testRegex()
    {

        $username = "am";

        if(preg_match('~^\p{Lu}~u', $username)){
            echo "oke";
        }else{
            echo "aku";
        }
    }


}
