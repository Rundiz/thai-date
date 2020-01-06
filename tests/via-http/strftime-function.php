<?php



header('Content-Type: text/html; charset=UTF-8');


$locale = 'th';
setlocale(LC_ALL, $locale);


$datetime = strftime('%#d %B %Y');
echo ' <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> ' . PHP_EOL;
$encodings = mb_list_encodings();
foreach ($encodings as $encoding) {
    $detect_encoding = mb_detect_encoding($datetime, $encoding, true);
    echo 'detect ' . $encoding . ' =&gt; <code style="color: #999;">' . ($detect_encoding !== false ? 'true' : 'false') . '</code><br>' . PHP_EOL;
    if ($detect_encoding !== false) {
        echo ' &nbsp; &nbsp;<strong>' . iconv($detect_encoding, 'UTF-8', $datetime) . '</strong>';
        echo '<br style="margin-bottom: 20px;">' . PHP_EOL;
    }
}
echo '<p>force using TIS-620 as charset.</p>' . PHP_EOL;
$datetime = iconv('TIS-620', 'UTF-8', $datetime);
echo $datetime . '<br>' . PHP_EOL;