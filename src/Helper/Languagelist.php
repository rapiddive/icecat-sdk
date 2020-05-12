<?php
/**
 * Languagelist
 *
 * @copyright Copyright © 2020 Firebear Studio. All rights reserved.
 * @author    fbeardev@gmail.com
 */

namespace Rapiddive\Icecat\Helper;

/**
 * Class Languagelist
 * @package Rapiddive\Icecat\Helper
 */
class Languagelist
{
    /**
     * @var string[]
     */
    public static $languages = [
        'ES_AR',
        'DE_AT',
        'NL_BE',
        'FR_BE',
        'DE_BE',
        'BR',
        'BG',
        'FR_CA',
        'ZH',
        'HR',
        'CZ',
        'DK',
        'ET',
        'FI',
        'FR',
        'KA',
        'DE',
        'EL',
        'HU',
        'EN_IN',
        'KN',
        'HI',
        'TA',
        'TE',
        'EN_ID',
        'ID',
        'FA',
        'EN_IE',
        'HE',
        'IT',
        'JA',
        'LV',
        'LT',
        'EN_MY',
        'ES_MX',
        'NL',
        'EN_NZ',
        'MK',
        'NO',
        'PL',
        'PT',
        'RO',
        'RU',
        'EN_SA',
        'SR',
        'EN_SG',
        'SK',
        'SL',
        'EN_ZA',
        'KO',
        'ES',
        'CA',
        'SV',
        'FR_CH',
        'DE_CH',
        'ZH_TW',
        'TH',
        'TR',
        'RU_UA',
        'UK',
        'AR',
        'EN',
        'US',
        'VI',
    ];

    public static function getLanguageList($lang)
    {
        return array_values(static::$languages)[$lang] ?? 'US';
    }
}