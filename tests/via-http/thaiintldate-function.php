<?php
/**
 * This is test file. You can remove this.
 */

require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';
require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/thaidate-functions.php';


header('Content-Type: text/html; charset=UTF-8');
echo '<meta charset="utf-8">' . PHP_EOL;

echo 'Begin test thaiIntlDate();.'."<br>\n";
echo 'time(); = '.time()."<br>\n";
echo 'Current date/time use date(); = '.date('Y-m-d H:i:s')."<br>\n";
if (class_exists('IntlDateFormatter')) {
    $Formatter = new \IntlDateFormatter('en', \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    $Formatter->setPattern('dd EEEE MMMM yyyy');
    echo 'Current date/time use IntlDateFormatter(); = ' . $Formatter->format(time())."<br>\n";
    unset($Formatter);
} else {
    echo 'Class IntlDateFormatter() is not exists.<br>' . "\n";
}
echo '----------------------------------'."<br>\n";
echo 'Thai date test.'."<br>\n";
echo '12 Months'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaiIntlDate('EEEE dd MMMM yyyy', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo '12 Months in short'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo thaiIntlDate('E dd MMM yy', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo 'Full long date with time'."<br>\n";
echo sprintf(thaiIntlDate('EEEE\'%2$s\' dd MMMM Gyyyy \'%4$s\'HH:mm:ss'), 'วัน', 'ที่', 'พ.ศ.', 'เวลา')."<br>\n";