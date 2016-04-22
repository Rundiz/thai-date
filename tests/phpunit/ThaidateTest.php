<?php


namespace Rundiz\Thaidate\Tests;

class ThaidateTest extends \PHPUnit_Framework_TestCase
{


    public function testThaidateFunctions()
    {
        $timestamp = 1460619637;

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', thaidate('วันlที่ j F พ.ศ.Y', $timestamp));
    }// testThaidate


    public function testThaidateClass()
    {
        $timestamp = 1460619637;
        $Thaidate = new \Rundiz\Thaidate\Thaidate();

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', $Thaidate->date('วันlที่ j F พ.ศ.Y', $timestamp));
    }// testThaidateClass


}
