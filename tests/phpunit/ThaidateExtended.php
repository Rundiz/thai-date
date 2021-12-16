<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundiz\Thaidate\Tests;


class ThaidateExtended extends \Rundiz\Thaidate\Thaidate
{


    public function strftimeFormatToIntlDatePattern($format)
    {
        return parent::strftimeFormatToIntlDatePattern($format);
    }// strftimeFormatToIntlDatePattern


}
