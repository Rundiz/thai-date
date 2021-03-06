<?php


namespace Rundiz\Thaidate\Tests;

class ThaidateTest extends \PHPUnit\Framework\TestCase
{


    public function testThaidateFunctions()
    {
        $timestamp = 1460619637;

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', thaidate('วันlที่ j F พ.ศ.Y', $timestamp));
        if (version_compare(PHP_VERSION, '5.4.0', '>=') && version_compare(PHP_VERSION, '5.5.0', '<') && stripos(PHP_OS, 'WIN') === 0) {
            $this->assertEquals('พฤ. 14 เม.ย. 59', thaistrftime('%a %d %b %y', $timestamp, true, 'Thai'));
        } else {
            $this->assertEquals('พฤ. 14 เม.ย. 59', thaistrftime('%a %d %b %y', $timestamp, true, array('th', 'th_TH.utf8', 'th_TH.UTF8', 'th_TH.utf-8', 'th_TH.UTF-8', 'th_TH', 'th-TH')));
        }
    }// testThaidate


    public function testThaidateClass()
    {
        $timestamp = 1460619637;
        $Thaidate = new \Rundiz\Thaidate\Thaidate();

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', $Thaidate->date('วันlที่ j F พ.ศ.Y', $timestamp));
        if (version_compare(PHP_VERSION, '5.4.0', '>=') && version_compare(PHP_VERSION, '5.5.0', '<') && stripos(PHP_OS, 'WIN') === 0) {
            $this->assertEquals('พฤ. 14 เม.ย. 59', $Thaidate->strftime('%a %d %b %y', $timestamp, true, 'Thai'));
        } else {
            $this->assertEquals('พฤ. 14 เม.ย. 59', $Thaidate->strftime('%a %d %b %y', $timestamp, true, array('th', 'th_TH.utf8', 'th_TH.UTF8', 'th_TH.utf-8', 'th_TH.UTF-8', 'th_TH', 'th-TH')));
        }
    }// testThaidateClass


}
