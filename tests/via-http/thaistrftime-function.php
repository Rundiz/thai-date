<?php
/**
 * This is test file. You can remove this.
 */


require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';
require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/thaidate-functions.php';


header('Content-Type: text/html; charset=UTF-8');
echo '<meta charset="utf-8">' . PHP_EOL;

echo 'Begin test thaistrftime();.'."<br>\n";
echo 'time(); = '.time()."<br>\n";
echo 'Current date/time use date(); = '.date('Y-m-d H:i:s')."<br>\n";
if (function_exists('strftime')) {
    echo 'Current date/time use strftime(); = ' . @strftime('%#d %A %B %Y')."<br>\n";
    if (version_compare(PHP_VERSION, '8.1', '>=')) {
        echo '<div style="border-left: 5px solid #f00; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.6); font-size: 1em; margin: 0 0 20px; padding: 2px 5px;"><code>strftime()</code> is deprecated since PHP 8.1.</div>' . PHP_EOL;
    }
} else {
    echo 'Function strftime() is not exists.<br>' . "\n";
}
if (class_exists('IntlDateFormatter')) {
    $IntlDateFormatter = new \IntlDateFormatter(null, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    echo 'Current date/time use IntlDateFormatter(); = ' . $IntlDateFormatter->format(time()) . "<br>\n";
} else {
    echo 'Class IntlDateFormatter() is not exits.<br>' . "\n";
}
echo '----------------------------------'."<br>\n";
echo 'Thai date test.'."<br>\n";
echo '12 Months'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaistrftime('%A %d %B %Y', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo '12 Months in short'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaistrftime('%a %d %b %y', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo 'Full long date with time'."<br>\n";
echo sprintf(thaistrftime('%%s%A%%s %d %B %%s%Y %%s%H:%M:%S'), 'วัน', 'ที่', 'พ.ศ.', 'เวลา')."<br>\n";
