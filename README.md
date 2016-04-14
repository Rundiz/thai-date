# Thaidate Component

Display date in Thai by using same PHP `date()` and `strftime()` function attributes.

[![Latest Stable Version](https://poser.pugx.org/rundiz/thai-date/v/stable)](https://packagist.org/packages/rundiz/thai-date)
[![License](https://poser.pugx.org/rundiz/thai-date/license)](https://packagist.org/packages/rundiz/thai-date)
[![Total Downloads](https://poser.pugx.org/rundiz/thai-date/downloads)](https://packagist.org/packages/rundiz/thai-date)

```php
echo thaidate('วันlที่ j F พ.ศ.Y เวลาH:i:s');
// results: วันพฤหัสบดีที่ 12 พฤศจิกายน พ.ศ.2558 เวลา18:55:29
```

```php
echo sprintf(thaistrftime('%%s%A%%s %d %B %%s%Y %%s%H:%M:%S'), 'วัน', 'ที่', 'พ.ศ.', 'เวลา');
// results: วันพฤหัสบดีที่ 12 พฤศจิกายน พ.ศ.2558 เวลา18:56:06
```

For more details, please look in tests folder