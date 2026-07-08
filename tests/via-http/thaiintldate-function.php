<?php
/**
 * This is test file. You can remove this.
 */

require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';
require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/thaidate-functions.php';


header('Content-Type: text/html; charset=UTF-8');
echo '<meta charset="utf-8">' . PHP_EOL;

echo 'Begin test <code>thaiIntlDate();</code>.' . "<br>\n";
echo '<code>time();</code> = ' . time() . "<br>\n";
echo 'Current date/time use <code>date();</code> = ' . date('Y-m-d H:i:s') . "<br>\n";
if (class_exists('IntlDateFormatter')) {
    $Formatter = new \IntlDateFormatter(null, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    echo 'Current date/time use <code>\IntlDateFormatter();</code> = ' . $Formatter->format(time()) . "<br>\n";
    unset($Formatter);
} else {
    echo 'Class <code>\IntlDateFormatter()</code> is not exists.<br>' . "\n";
}
echo '----------------------------------' . "<br>\n";
echo 'Thai date test.' . "<br>\n";
echo '12 Months' . "<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaiIntlDate('EEEE d MMMM yyyy', strtotime(date('Y') . '-' . $i . '-01')) . "<br>\n";
}
echo '---------------------' . "<br>\n";
echo '12 Months in short' . "<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaiIntlDate('E d MMM yyyy', strtotime(date('Y') . '-' . $i . '-01')) . "<br>\n";
}
echo '---------------------' . "<br>\n";
echo 'Full long date with time' . "<br>\n";
echo sprintf(thaiIntlDate('EEEE\'%2$s\' d MMMM Gyyyy \'%4$s\'HH:mm:ss'), 'วัน', 'ที่', 'พ.ศ.', 'เวลา') . "<br>\n";

echo '---------------------' . "<br>\n";
echo 'Current default timezone: <code>' . date_default_timezone_get() . "</code><br>\n";
$pattern = 'EEEE d MMMM Gyyyy HH:mm:ss xxxxx';
echo 'Using <code>\IntlDateFormatter</code> pattern: <code>\'' . $pattern . '\'</code><br>' . "\n";
echo 'Result: ' . thaiIntlDate($pattern) . "<br>\n";
date_default_timezone_set('UTC');
echo '&gt; Set default timezone to <code>UTC</code><br>' . "\n";
echo 'Current default timezone: <code>' . date_default_timezone_get() . "</code><br>\n";
echo 'Result: ' . thaiIntlDate($pattern) . "<br>\n";
echo 'Override option <code>timezone</code>: ' . thaiIntlDate($pattern, '', true, 'th', array('timezone' => 'Asia/Bangkok')) . "<br>\n";

