<?php
class Test{
    private static $cmp =0;
    function __construct(){
        self :: $cmp++;
    }
    function despl(){
        echo self::$cmp;
    }
}

$ob1 = new Test();
$ob1->despl();
$ob2 = new Test();
$ob2->despl();
