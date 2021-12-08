<?php
/**
 * This is test file. You can remove this.
 */

require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';

header('Content-Type: text/html; charset=UTF-8');
echo '<meta charset="utf-8">' . PHP_EOL;

echo 'Begin test IntlDateFormatter();.'."<br>\n";
echo 'time(); = '.time()."<br>\n";
echo 'Current date/time use date(); = '.date('Y-m-d H:i:s')."<br>\n";
if (class_exists('\IntlDateFormatter')) {
    $IntlDateFormatter = new \IntlDateFormatter(null, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL);
    echo 'Current date/time use IntlDateFormatter(); = ' . $IntlDateFormatter->format(time()) . "<br>\n";
} else {
    echo 'Class IntlDateFormatter() is not exits.<br>' . "\n";
}
echo '----------------------------------'."<br>\n";

$Thaidate = new Rundiz\Thaidate\Thaidate();
$Thaidate->buddhist_era = true;
$Thaidate->locale = 'th';

echo 'Thai date test.'."<br>\n";
echo '12 Months'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo $Thaidate->intlDate('cccc d MMMM yyyy', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo '12 Months in short'."<br>\n";
for ($i = 1; $i <= 12; $i++) {
    echo $Thaidate->intlDate('ccc d MMM yyyy', strtotime(date('Y').'-'.$i.'-01'))."<br>\n";
}
echo '---------------------'."<br>\n";
echo 'Full long date with time'."<br>\n";
echo sprintf($Thaidate->intlDate('cccc\'%1$s\' d MMMM Gyyyy \'%2$s\'H:mm:ss'), 'ที่', 'เวลา')."<br>\n";