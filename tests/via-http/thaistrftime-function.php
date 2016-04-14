<?php
/**
 * This is test file. You can remove this.
 */


require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/Thaidate.php';
require dirname(dirname(__DIR__)).'/Rundiz/Thaidate/thaidate-functions.php';


echo 'Begin test thaistrftime();.'."<br>\n";
echo 'time(); = '.time()."<br>\n";
echo 'Current date/time use date(); = '.date('Y-m-d H:i:s')."<br>\n";
echo 'Current date/time use strftime(); = '.strftime('%#d %A %B %Y')."<br>\n";
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
