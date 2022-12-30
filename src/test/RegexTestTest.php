<?php

namespace LearnPhpMvc;

use DateTime;
use DateTimeZone;
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

    public function testAddd6Month(){
        $date = new DateTime('now');
        $date->modify('+1 month'); // or you can use '-90 day' for deduct
        $date = $date->format('Y-m-d');
        echo $date;
    }


    public function testDateAdd(){
        date_default_timezone_set("Asia/jakarta");
        // $expire_stamp = date('Y-m-d H:i:s', strtotime("+15 min"));
        echo "The time is " . date("h:i:sa");
    }

}
