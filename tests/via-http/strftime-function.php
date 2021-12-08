<?php



header('Content-Type: text/html; charset=UTF-8');


if (version_compare(PHP_VERSION, '8.1', '>=')) {
    echo '<div style="border-left: 5px solid #f00; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.6); font-size: 1em; margin: 0 0 20px; padding: 2px 5px;"><code>strftime()</code> is deprecated since PHP 8.1.</div>' . PHP_EOL;
}
if (!function_exists('strftime')) {
    die('<p><code>strftime()</code> function is not exists.<p>');
}

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
echo ' &nbsp; &nbsp;<strong>' . $datetime . '</strong><br>' . PHP_EOL;