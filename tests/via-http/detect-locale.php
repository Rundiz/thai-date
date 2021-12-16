<?php
/** 
 * @license http://opensource.org/licenses/MIT MIT
 */


// The locale on `setlocale()` function may accepted different value depend on PHP version.
// Read more at https://stackoverflow.com/a/40963241/128761

// The process below will be test what locale that your server will be accepted.
// Set you possibility locales here.
$locales = array(
    'th_TH.utf-8',
    'th_TH.utf8',
    'th_th.utf-8',
    'th_th.utf8',

    'th-TH.utf-8',
    'th-TH.utf8',
    'th-th.utf-8',
    'th-th.utf8',

    'th.utf-8',
    'th.utf8',

    'th_TH',
    'th_th',
    'th-TH',
    'th-th',
    'th',
);


$result = setlocale(LC_ALL, $locales);

echo 'The accepted locale is <code style="background-color: #eee; padding: 2px 5px;">' . print_r($result, true) . '</code><br>' . PHP_EOL;
echo 'PHP version: <strong>' . PHP_VERSION . '</strong><br>' . PHP_EOL;

