<?php
/**
 * This is test file. You can remove this.
 */

require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';

header('Content-Type: text/html; charset=UTF-8');
echo '<meta charset="utf-8">' . PHP_EOL;

echo 'Begin test <code>\IntlDateFormatter();</code>.' . "<br>\n";
echo '<code>time();</code> = ' . time() . "<br>\n";
echo 'Current date/time use <code>date();</code> = ' . date('Y-m-d H:i:s') . "<br>\n";
if (class_exists('\IntlDateFormatter')) {
    $IntlDateFormatter = new \IntlDateFormatter(null, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    echo 'Current date/time use <code>\IntlDateFormatter();</code> = ' . $IntlDateFormatter->format(time()) . "<br>\n";
} else {
    echo 'Class <code>IntlDateFormatter()</code> is not exits.<br>' . "\n";
}
echo '----------------------------------' . "<br>\n";

$Thaidate = new Rundiz\Thaidate\Thaidate();
$Thaidate->buddhist_era = true;
$Thaidate->locale = 'th';

echo 'Thai date test.' . "<br>\n";
echo '12 Months' . "<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo $Thaidate->intlDate('EEEE d MMMM yyyy', strtotime(date('Y') . '-' . $i . '-01')) . "<br>\n";
}
echo '---------------------' . "<br>\n";
echo '12 Months in short' . "<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo $Thaidate->intlDate('E d MMM yyyy', strtotime(date('Y') . '-' . $i . '-01')) . "<br>\n";
}
echo '---------------------' . "<br>\n";
echo 'Full long date with time' . "<br>\n";
echo sprintf($Thaidate->intlDate('EEEE\'%1$s\' d MMMM Gyyyy \'%2$s\'H:mm:ss'), 'ที่', 'เวลา') . "<br>\n";

echo '---------------------' . "<br>\n";
echo 'current default timezone: <code>' . date_default_timezone_get() . "</code><br>\n";
$pattern = 'EEEE d MMMM Gyyyy HH:mm:ss xxxxx';
echo 'using <code>\IntlDateFormatter</code> pattern: <code>\'' . $pattern . '\'</code><br>' . "\n";
echo 'Result: ' . $Thaidate->intlDate($pattern) . "<br>\n";
date_default_timezone_set('UTC');
echo '&gt; Set default timezone to <code>UTC</code><br>' . "\n";
echo 'Current default timezone: <code>' . date_default_timezone_get() . "</code><br>\n";
echo 'Result: ' . $Thaidate->intlDate($pattern) . "<br>\n";
echo 'Override option <code>timezone</code>: ' . $Thaidate->intlDate($pattern, '', array('timezone' => 'Asia/Bangkok')) . "<br>\n";

