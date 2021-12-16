<?php


namespace Rundiz\Thaidate\Tests;

class ThaidateTest extends \PHPUnit\Framework\TestCase
{


    public function testStrftimeFormatToIntlDatePattern()
    {
        $Thaidate = new ThaidateExtended();
        $this->assertSame('D', $Thaidate->strftimeFormatToIntlDatePattern('%j'));
        $this->assertSame('EEEE @ dd MMMM yyyy HH:mm:ss', $Thaidate->strftimeFormatToIntlDatePattern('%A @ %d %B %Y %H:%M:%S'));
        $this->assertSame('\'\' $"', $Thaidate->strftimeFormatToIntlDatePattern('\' $"'));
        $this->assertSame('\'\' $', $Thaidate->strftimeFormatToIntlDatePattern('\'\' $'));
        $this->assertSame('\'\'\' $', $Thaidate->strftimeFormatToIntlDatePattern('\'\'\' $'));
        $this->assertSame('\'\'\'\' $', $Thaidate->strftimeFormatToIntlDatePattern('\'\'\'\' $'));
        $this->assertSame('\'\' $', $Thaidate->strftimeFormatToIntlDatePattern('\' $'));
        $this->assertSame('\'\'\'abc\'', $Thaidate->strftimeFormatToIntlDatePattern('\'abc'));
        $this->assertSame('\'\'\'abc\'$', $Thaidate->strftimeFormatToIntlDatePattern('\'abc$'));// $ is not in range for ICU pattern.
        $this->assertSame('\'xyz\'\'\'', $Thaidate->strftimeFormatToIntlDatePattern('xyz\''));
        $this->assertSame('\'xyz\'\'\' $', $Thaidate->strftimeFormatToIntlDatePattern('xyz\' $'));
        $this->assertSame('\'xyz\'\'\'$', $Thaidate->strftimeFormatToIntlDatePattern('xyz\'$'));
        $this->assertSame('\'xyz\'\'\'$\'abc\'', $Thaidate->strftimeFormatToIntlDatePattern('xyz\'$abc'));
        $this->assertSame('\'wrap\' \'me\'', $Thaidate->strftimeFormatToIntlDatePattern('wrap me'));
        $this->assertSame('HH \'%H\' HH%', $Thaidate->strftimeFormatToIntlDatePattern('%H %%H %H%'));
        $this->assertSame('EEEE dd MMMM yyyy HH:mm:ss "\'double\' \'quote\' \'\'\'single\' \'quote\'', $Thaidate->strftimeFormatToIntlDatePattern('%A %d %B %Y %H:%M:%S "double quote \'\'single quote'));
        $this->assertSame('EEEE dd MMMM yyyy HH:mm:ss \'%S\'', $Thaidate->strftimeFormatToIntlDatePattern('%A %d %B %Y %H:%M:%S %%S'));
    }// testStrftimeFormatToIntlDatePattern


    public function testThaidateFunctions()
    {
        $timestamp = 1460619637;

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', thaidate('วันlที่ j F พ.ศ.Y', $timestamp));
        if (version_compare(PHP_VERSION, '5.4.0', '>=') && version_compare(PHP_VERSION, '5.5.0', '<') && stripos(PHP_OS, 'WIN') === 0) {
            $this->assertEquals('พฤ. 14 เม.ย. 59', thaistrftime('%a %d %b %y', $timestamp, true, 'Thai'));
        } else {
            $this->assertEquals('พฤ. 14 เม.ย. 59', thaistrftime('%a %d %b %y', $timestamp, true, array('th', 'th_TH.utf8', 'th_TH.UTF8', 'th_TH.utf-8', 'th_TH.UTF-8', 'th_TH', 'th-TH')));
        }
        $this->assertEquals('พฤ. 14 เม.ย. 59', thaiIntlDate('EE d MMM yy', $timestamp));
        $this->assertEquals('วันพฤหัสบดี 14 เมษายน 2559', thaiIntlDate('EEEE d MMMM yyyy', $timestamp));// can't get rid of the word 'วัน' using pattern.
    }// testThaidate


    public function testThaidateClass()
    {
        $timestamp = 1460619637;
        $Thaidate = new \Rundiz\Thaidate\Thaidate();
        if (version_compare(PHP_VERSION, '5.4.0', '>=') && version_compare(PHP_VERSION, '5.5.0', '<') && stripos(PHP_OS, 'WIN') === 0) {
            $Thaidate->locale = 'Thai';
        } else {
            $Thaidate->locale = array('th', 'th_TH.utf8', 'th_TH.UTF8', 'th_TH.utf-8', 'th_TH.UTF-8', 'th_TH', 'th-TH');
        }

        $this->assertEquals('วันพฤหัสบดีที่ 14 เมษายน พ.ศ.2559', $Thaidate->date('วันlที่ j F พ.ศ.Y', $timestamp));
        $this->assertEquals('พฤ. 14 เม.ย. 59', $Thaidate->strftime('%a %d %b %y', $timestamp));
        $this->assertEquals('พฤ. 14 เม.ย. 59', $Thaidate->intlDate('EE d MMM yy', $timestamp));
        $this->assertEquals('วันพฤหัสบดี 14 เมษายน 2559', $Thaidate->intlDate('EEEE d MMMM yyyy', $timestamp));// can't get rid of the word 'วัน' using pattern.
    }// testThaidateClass


}
