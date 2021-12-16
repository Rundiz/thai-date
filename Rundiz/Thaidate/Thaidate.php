<?php
/** 
 * 
 * @package Thaidate
 * @version 2.1.1
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
     * @param int $timestamp The optional timestamp is an integer Unix timestamp.
     * @return string Return the formatted date/time string.
     * @throws \InvalidArgumentException Throw the exception if invalid argument type is specify.
     */
    public function date($format, $timestamp = '')
    {
        if (!is_string($format)) {
            throw new \InvalidArgumentException('The argument $format must be string.');
        }

        if (!is_numeric($timestamp)) {
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
     * Thai date use `\IntlDateFormatter()` class.
     * 
     * @since 2.1.0
     * @see https://www.php.net/manual/en/class.intldateformatter.php
     * @param string $format The format or pattern as **same** as ICU format. See https://unicode-org.github.io/icu/userguide/format_parse/datetime/
     * @param int $timestamp The optional timestamp is an integer Unix timestamp.
     * @return string Return the formatted date/time string.
     * @throws \InvalidArgumentException Throw the exception if invalid argument type is specify.
     */
    public function intlDate($format, $timestamp = '')
    {
        if (!is_string($format)) {
            throw new \InvalidArgumentException('The argument $format must be string.');
        }

        if (!is_numeric($timestamp)) {
            $timestamp = time();
        }

        if ($this->buddhist_era === true) {
            $calendar = \IntlDateFormatter::TRADITIONAL;
        } else {
            $calendar = null;
        }
        $locale = $this->locale;
        if (is_array($this->locale)) {
            $localeVals = array_values($locale);
            $locale = array_shift($localeVals);
            unset($localeVals);
        } elseif (!is_scalar($this->locale)) {
            $locale = 'th';
        }
        $IntlDateFormatter = new \IntlDateFormatter($locale, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL, null, $calendar);
        $IntlDateFormatter->setPattern($format);
        return $IntlDateFormatter->format($timestamp);
    }// intlDate


    /**
     * Thai date use strftime() function.
     * 
     * Function `strftime()` is deprecated since PHP 8.1. This method will be here to keep it working from old projects to new.<br>
     * However, please validate the result that it really is correct once PHP removed this function in version 9.0.<br>
     * Use other method instead of this is recommended.
     * 
     * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.strftime.php
     * @param int $timestamp The optional timestamp is an integer Unix timestamp.
     * @return string Return the formatted date/time string.<br>
     *              This method will be show the notice if function `strftime()` is deprecated or removed from currently running PHP version.
     * @throws \InvalidArgumentException Throw the exception if invalid argument type is specify.
     */
    public function strftime($format, $timestamp = '')
    {
        if (!function_exists('strftime') || version_compare(PHP_VERSION, '8.1', '>=')) {
            // if function `strftime` is not exists or deprecated (since PHP 8.1).
            // notice the developers to upgrade their code.
            // this method can keep running with new version of PHP but need more attention about format/pattern.
            // so, use notice instead of warning, error, deprecated level.
            trigger_error(
                'Function `strftime()` is deprecated 
                    and method `\Rundiz\Thaidate\Thaidate::strftime()` is using replacement which may return incorrect result.
                    Please update your code to use `\Rundiz\Thaidate\Thaidate::intlDate()` instead.', 
                E_USER_NOTICE
            );

            if (class_exists('\IntlDateFormatter')) {
                return $this->intlDate($this->strftimeFormatToIntlDatePattern($format), $timestamp);
            }
            // if IntlDateFormatter is not exists then let it run and error occur.
        }

        if (!is_string($format)) {
            throw new \InvalidArgumentException('The argument $format must be string.');
        }

        if (!is_numeric($timestamp)) {
            $timestamp = time();
        }

        setlocale(LC_TIME, $this->locale);

        // if use Buddhist era, convert the year (y, Y).
        if ($this->buddhist_era === true) {
            if (mb_strpos($format, '%Y') !== false) {
                $year = (@strftime('%Y', $timestamp)+543);
                $format = str_replace('%Y', $year, $format);
            } elseif (mb_strpos($format, '%y') !== false) {
                $year = (@strftime('%y', $timestamp)+43);
                $format = str_replace('%y', $year, $format);
            }
            unset($year);
        }

        $converted_datetime = @strftime($format, $timestamp);
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


    /**
     * Convert from `strftime()` format to `\IntlDateFormatter()` that use ICU pattern.
     * 
     * There are no patterns that has no word 'วัน' from day of week.
     * 
     * @since 2.1.0
     * @see https://unicode-org.github.io/icu/userguide/format_parse/datetime/ See more about ICU pattern.
     * @param string $format The date format that used by `strftime()` function.
     * @return string Return converted format.
     */
    protected function strftimeFormatToIntlDatePattern($format)
    {
        $output = $format;

        $replaces = array(
            '%a' => 'E',
            '%A' => 'EEEE',
            '%d' => 'dd',
            '%e' => 'd',
            '%j' => 'D',
            '%u' => 'e',// not 100% correct
            '%w' => 'c',// not 100% correct
            '%U' => 'w',
            '%V' => 'ww',// not 100% correct
            '%W' => 'w',// not 100% correct
            '%b' => 'MMM',
            '%B' => 'MMMM',
            '%h' => 'MMM',// alias of %b
            '%m' => 'MM',
            '%C' => 'yy',// no replace for this
            '%g' => 'yy',// no replace for this
            '%G' => 'Y',// not 100% correct
            '%y' => 'yy',
            '%Y' => 'yyyy',
            '%H' => 'HH',
            '%k' => 'H',
            '%I' => 'hh',
            '%l' => 'h',
            '%M' => 'mm',
            '%p' => 'a',
            '%P' => 'a',// no replace for this
            '%r' => 'hh:mm:ss a',
            '%R' => 'HH:mm',
            '%S' => 'ss',
            '%T' => 'HH:mm:ss',
            '%X' => 'HH:mm:ss',// no replace for this
            '%z' => 'ZZ',
            '%Z' => 'v',// no replace for this
            '%c' => 'd/M/YYYY HH:mm:ss',// Buddhist era may not converted.
            '%D' => 'MM/dd/yy',
            '%F' => 'yyyy-MM-dd',
            '%s' => '',// no replace for this
            '%x' => 'd/MM/yyyy',// Buddhist era may not converted.
            '%n' => "\n",
            '%t' => "\t",
            '%%' => '%',
        );

        // replace 1 single quote that is not following visible character or single quote and not follow by single quote or word or number.
        // example: '
        // replace with 2 single quotes. example: ''
        $output = preg_replace('/(?<![\'\S])(\')(?![\'\w])/u', "'$1", $output);
        // replace 1 single quote that is not following visible character or single quote and follow by word.
        // example: 'xx
        // replace with 2 single quotes. example: ''xx
        $output = preg_replace('/(?<![\'\S])(\')(\w+)/u', "'$1$2", $output);
        // replace 1 single quote that is following word (a-z 0-9) and not follow by single quote.
        // example: xx'
        // replace with 2 single quotes. example: xx''
        $output = preg_replace('/([\w]+)(\')(?!\')/u', "$1'$2", $output);
        // replace a-z (include upper case) that is not following %. example xxx.
        // replace with wrap single quote. example: 'xxx'.
        $output = preg_replace('/(?<![%a-zA-Z])([a-zA-Z]+)/u', "'$1$2'", $output);

        // escape %%x with '%%x'.
        $output = preg_replace('/(%%[a-zA-Z]+)/u', "'$1'", $output);

        foreach ($replaces as $strftime => $intl) {
            $output = preg_replace('/(?<!%)(' . $strftime . ')/u', $intl, $output);
        }// endforeach;
        unset($intl, $strftime);

        unset($replaces);
        return $output;
    }// strftimeFormatToIntlDatePattern


}
