# Thaidate Component

Display date in Thai by using same PHP `date()` and `strftime()` function attributes.

Tested up to PHP 8.4.

[![Latest Stable Version](https://poser.pugx.org/rundiz/thai-date/v/stable)](https://packagist.org/packages/rundiz/thai-date)
[![License](https://poser.pugx.org/rundiz/thai-date/license)](https://packagist.org/packages/rundiz/thai-date)
[![Total Downloads](https://poser.pugx.org/rundiz/thai-date/downloads)](https://packagist.org/packages/rundiz/thai-date)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/rundiz/thai-date)
![GitHub repo size](https://img.shields.io/github/repo-size/rundiz/thai-date)
![GitHub all releases](https://img.shields.io/github/downloads/Rundiz/thai-date/total?style=social)

```php
echo thaidate('วันlที่ j F พ.ศ.Y เวลาH:i:s');
// results: วันพฤหัสบดีที่ 12 พฤศจิกายน พ.ศ.2558 เวลา18:55:29
```

```php
echo sprintf(thaistrftime('%%s%A%%s %d %B %%s%Y %%s%H:%M:%S'), 'วัน', 'ที่', 'พ.ศ.', 'เวลา');
// results: วันพฤหัสบดีที่ 12 พฤศจิกายน พ.ศ.2558 เวลา18:56:06
```

```php
echo sprintf(intlDate('cccc\'%1$s\' d MMMM Gyyyy \'%2$s\'H:mm:ss'), 'ที่', 'เวลา');
// results: วันพฤหัสบดีที่ 12 พฤศจิกายน พ.ศ.2558 เวลา18:56:06
```

For more details, please look in tests folder
