<?php
/** 
 * 
 * @package Thaidate
 * @version 2.0.5
 * @author Vee W.
 * @license http://opensource.org/licenses/MIT
 * 
 */

namespace Rundiz\Thaidate;

/**
 * Format date in Thai locale.
 */
class Thaidate
{


    /**
     * Use Buddhist Era? (พ.ศ.)
     * @var boolean Set to true to use or false not to use.
     */
    public $buddhist_era = true;

    /**
     * Locale to use in setlocale() function. Some server support different locales, with .UTF8, or without .UTF8. Detect and use at your own.
     * @var string|array See more about `$locale` parameter of `setlocale()` function at http://php.net/manual/en/function.setlocale.php .
     */
    public $locale = 'th';

    public $month_long = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
    public $month_short = array('ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.');

    public $day_long = array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์');
    public $day_short = array('อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.');


    /**
     * Thai date() function.
     * 
     * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.date.php
     * @param integer $timestamp The optional timestamp is an integer Unix timestamp.
     * @return string Return the formatted date/time string.
     */
    public function date($format, $timestamp = '')
    {
        if ($timestamp == null) {
            $timestamp = time();
        }

        // if use Buddhist era, convert the year.
        if ($this->buddhist_era === true) {
            if (mb_strpos($format, 'o') !== false) {
                $year = (date('o', $timestamp)+543);
                $format = str_replace('o', $year, $format);
            } elseif (mb_strpos($format, 'Y') !== false) {
                $year = (date('Y', $timestamp)+543);
                $format = str_replace('Y', $year, $format);
            } elseif (mb_strpos($format, 'y') !== false) {
                $year = (date('y', $timestamp)+43);
                $format = str_replace('y', $year, $format);
            }
            unset($year);
        }

        // replace format that will be convert month into name (F, M) to Thai.
        if (mb_strpos($format, 'F') !== false || mb_strpos($format, 'M') !== false) {
            $month_num = (date('n', $timestamp)-1);
            if (mb_strpos($format, 'F') !== false && array_key_exists($month_num, $this->month_long)) {
                $format = str_replace('F', $this->month_long[$month_num], $format);
            } elseif (mb_strpos($format, 'M') !== false && array_key_exists($month_num, $this->month_short)) {
                $format = str_replace('M', $this->month_short[$month_num], $format);
            }
            unset($month_num);
        }

        // replace format that will be convert day into name (D, l) to Thai.
        if (mb_strpos($format, 'l') !== false || mb_strpos($format, 'D') !== false) {
            $day_num = date('w', $timestamp);
            if (mb_strpos($format, 'l') !== false && array_key_exists($day_num, $this->day_long)) {
                $format = str_replace('l', $this->day_long[$day_num], $format);
            } elseif (mb_strpos($format, 'D') !== false && array_key_exists($day_num, $this->day_short)) {
                $format = str_replace('D', $this->day_short[$day_num], $format);
            }
            unset($day_num);
        }

        return date($format, $timestamp);
    }// date


    /**
     * Thai date use strftime() function.
     * 
     * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.strftime.php
     * @param integer $timestamp The optional timestamp is an integer Unix timestamp.
     * @return string Return the formatted date/time string.
     */
    public function strftime($format, $timestamp = '')
    {
        if ($timestamp == null) {
            $timestamp = time();
        }

        setlocale(LC_TIME, $this->locale);

        // if use Buddhist era, convert the year (y, Y).
        if ($this->buddhist_era === true) {
            if (mb_strpos($format, '%Y') !== false) {
                $year = (strftime('%Y', $timestamp)+543);
                $format = str_replace('%Y', $year, $format);
            } elseif (mb_strpos($format, '%y') !== false) {
                $year = (strftime('%y', $timestamp)+43);
                $format = str_replace('%y', $year, $format);
            }
            unset($year);
        }

        $converted_datetime = strftime($format, $timestamp);
        $detect_encoding = mb_detect_encoding($converted_datetime, mb_detect_order(), true);
        if ($detect_encoding === false) {
            // if some server cannot detect encoding at all.
            // in this case, i assume that the encoding from `strfime()` is thai (base on locale).
            if (is_string($this->locale) && stripos($this->locale, 'th') !== false) {
                $detect_encoding = 'TIS-620';
            } elseif (is_array($this->locale)) {
                foreach ($this->locale as $locale) {
                    if (is_string($locale) && stripos($locale, 'th') !== false) {
                        $detect_encoding = 'TIS-620';
                        break;
                    }
                }// endforeach;
                unset($locale);
            }
        }

        if ($detect_encoding !== false) {
            // if detect encoding with no problem.
            return iconv($detect_encoding, 'UTF-8', $converted_datetime);
        } else {
            // if detect encoding found some problem, return as-is.
            return $converted_datetime;
        }
    }// strftime


}
