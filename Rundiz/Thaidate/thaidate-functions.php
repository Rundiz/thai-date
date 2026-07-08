<?php
/* 
 * 
 * @author Vee W.
 * @license http://opensource.org/licenses/MIT
 * 
 */


/**
 * Thai date use date() function.
 * 
 * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.date.php
 * @param int $timestamp The optional timestamp is an integer Unix timestamp.
 * @param bool $buddhist_era Use Buddhist era? set to true to use that or false not to use.
 * @return string Return the formatted date/time string.
 */
function thaidate($format, $timestamp = '', $buddhist_era = true)
{
    if (!is_bool($buddhist_era)) {
        $buddhist_era = true;
    }

    $thaidate = new \Rundiz\Thaidate\Thaidate();
    $thaidate->buddhist_era = $buddhist_era;
    return $thaidate->date($format, $timestamp);
}// thaidate


/**
 * Thai date use IntlDateFormatter() class.
 * 
 * @param string $format The format or pattern as **same** as ICU format. See https://unicode-org.github.io/icu/userguide/format_parse/datetime/
 * @param int $timestamp The optional timestamp is an integer Unix timestamp.
 * @param bool $buddhist_era Use Buddhist era? set to true to use that or false not to use.
 * @param array|string $locale The locale that will be use in `IntlDateFormatter::__construct()` function. See https://www.php.net/manual/en/intldateformatter.create.php
 * @param array $options The options:  
 *      `timezone` IntlTimeZone|DateTimeZone|string|null Accept timezone the same as in `IntlDateFormatter::__construct`. This option is available since 2.1.4.  
 * @return string Return the formatted date/time string.
 */
function thaiIntlDate($format, $timestamp = '', $buddhist_era = true, $locale = 'th', $options = array())
{
    if ($locale == null) {
        $locale = 'th';
    }

    if (!is_bool($buddhist_era)) {
        $buddhist_era = true;
    }

    $thaidate = new \Rundiz\Thaidate\Thaidate();
    $thaidate->buddhist_era = $buddhist_era;
    $thaidate->locale = $locale;
    return $thaidate->intlDate($format, $timestamp, $options);
}// thaiIntlDate


/**
 * Thai date use strftime() function.
 * 
 * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.strftime.php
 * @param int $timestamp The optional timestamp is an integer Unix timestamp.
 * @param bool $buddhist_era Use Buddhist era? set to true to use that or false not to use.
 * @param array|string $locale The locale that will be use in setlocale() function. See http://php.net/setlocale
 * @return string Return the formatted date/time string.
 */
function thaistrftime($format, $timestamp = '', $buddhist_era = true, $locale = 'th')
{
    if ($locale == null) {
        $locale = 'th';
    }

    if (!is_bool($buddhist_era)) {
        $buddhist_era = true;
    }

    $thaidate = new \Rundiz\Thaidate\Thaidate();
    $thaidate->buddhist_era = $buddhist_era;
    $thaidate->locale = $locale;
    return $thaidate->strftime($format, $timestamp);
}// thaistrftime