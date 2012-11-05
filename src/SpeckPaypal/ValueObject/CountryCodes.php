<?php
namespace SpeckPaypal\ValueObject;

class CountryCodes
{
    /*
     * Valid Country name to country code for Paypal
     * commented country names are currently not support by paypal
     */
    static private $countryCodes = array(
        'ÅLAND ISLANDS' => 'AX',
        'ALBANIA' => 'AL',
        //'ALGERIA *' => 'DZ *',
        'AMERICAN SAMOA' => 'AS',
        'ANDORRA' => 'AD',
        'ANGUILLA' => 'AI',
        //'ANTARCTICA *' => 'AQ *',
        'ANTIGUA AND BARBUDA' => 'AG',
        'ARGENTINA' => 'AR',
        'ARMENIA' => 'AM',
        'ARUBA' => 'AW',
        'AUSTRALIA' => 'AU',
        'AUSTRIA' => 'AT',
        'AZERBAIJAN' => 'AZ',
        'BAHAMAS' => 'BS',
        'BAHRAIN' => 'BH',
        'BANGLADESH' => 'BD',
        'BARBADOS' => 'BB',
        'BELGIUM' => 'BE',
        'BELIZE' => 'BZ',
        'BENIN' => 'BJ',
        'BERMUDA' => 'BM',
        'BHUTAN' => 'BT',
        'BOSNIA-HERZEGOVINA' => 'BA',
        'BOTSWANA' => 'BW',
        //'BOUVET ISLAND *' => 'BV *',
        'BRAZIL' => 'BR',
        //'BRITISH INDIAN OCEAN TERRITORY *' => 'IO *',
        'BRUNEI DARUSSALAM' => 'BN',
        'BULGARIA' => 'BG',
        'BURKINA FASO' => 'BF',
        'CANADA' => 'CA',
        'CAPE VERDE' => 'CV',
        'CAYMAN ISLANDS' => 'KY',
        //'CENTRAL AFRICAN REPUBLIC *' => 'CF *',
        'CHILE' => 'CL',
        'CHINA' => 'CN',
        //'CHRISTMAS ISLAND *' => 'CX *',
        'COCOS (KEELING) ISLANDS' => 'CC',
        'COLOMBIA' => 'CO',
        'COOK ISLANDS' => 'CK',
        'COSTA RICA' => 'CR',
        'CYPRUS' => 'CY',
        'CZECH REPUBLIC' => 'CZ',
        'DENMARK' => 'DK',
        'DJIBOUTI' => 'DJ',
        'DOMINICA' => 'DM',
        'DOMINICAN REPUBLIC' => 'DO',
        'ECUADOR' => 'EC',
        'EGYPT' => 'EG',
        'EL SALVADOR' => 'SV',
        'ESTONIA' => 'EE',
        'FALKLAND ISLANDS (MALVINAS)' => 'FK',
        'FAROE ISLANDS' => 'FO',
        'FIJI' => 'FJ',
        'FINLAND' => 'FI',
        'FRANCE' => 'FR',
        'FRENCH GUIANA' => 'GF',
        'FRENCH POLYNESIA' => 'PF',
        'FRENCH SOUTHERN TERRITORIES' => 'TF',
        'GABON' => 'GA',
        'GAMBIA' => 'GM',
        'GEORGIA' => 'GE',
        'GERMANY' => 'DE',
        'GHANA' => 'GH',
        'GIBRALTAR' => 'GI',
        'GREECE' => 'GR',
        'GREENLAND' => 'GL',
        'GRENADA' => 'GD',
        'GUADELOUPE' => 'GP',
        'GUAM' => 'GU',
        'GUERNSEY' => 'GG',
        'GUYANA' => 'GY',
        //'HEARD ISLAND AND MCDONALD ISLANDS *' => 'HM *',
        'HOLY SEE (VATICAN CITY STATE)' => 'VA',
        'HONDURAS' => 'HN',
        'HONG KONG' => 'HK',
        'HUNGARY' => 'HU',
        'ICELAND' => 'IS',
        'INDIA' => 'IN',
        'INDONESIA' => 'ID',
        'IRELAND' => 'IE',
        'ISLE OF MAN' => 'IM',
        'ISRAEL' => 'IL',
        'ITALY' => 'IT',
        'JAMAICA' => 'JM',
        'JAPAN' => 'JP',
        'JERSEY' => 'JE',
        'JORDAN' => 'JO',
        'KAZAKHSTAN' => 'KZ',
        'KIRIBATI' => 'KI',
        'KOREA, REPUBLIC OF' => 'KR',
        'KUWAIT' => 'KW',
        'KYRGYZSTAN' => 'KG',
        'LATVIA' => 'LV',
        'LESOTHO' => 'LS',
        'LIECHTENSTEIN' => 'LI',
        'LITHUANIA' => 'LT',
        'LUXEMBOURG' => 'LU',
        'MACAO' => 'MO',
        'MACEDONIA' => 'MK',
        'MADAGASCAR' => 'MG',
        'MALAWI' => 'MW',
        'MALAYSIA' => 'MY',
        'MALTA' => 'MT',
        'MARSHALL ISLANDS' => 'MH',
        'MARTINIQUE' => 'MQ',
        'MAURITANIA' => 'MR',
        'MAURITIUS' => 'MU',
        'MAYOTTE' => 'YT',
        'MEXICO' => 'MX',
        'MICRONESIA, FEDERATED STATES OF' => 'FM',
        'MOLDOVA, REPUBLIC OF' => 'MD',
        'MONACO' => 'MC',
        'MONGOLIA' => 'MN',
        'MONTENEGRO' => 'ME',
        'MONTSERRAT' => 'MS',
        'MOROCCO' => 'MA',
        'MOZAMBIQUE' => 'MZ',
        'NAMIBIA' => 'NA',
        'NAURU' => 'NR',
        //'NEPAL *' => 'NP *',
        'NETHERLANDS' => 'NL',
        'NETHERLANDS ANTILLES' => 'AN',
        'NEW CALEDONIA' => 'NC',
        'NEW ZEALAND' => 'NZ',
        'NICARAGUA' => 'NI',
        'NIGER' => 'NE',
        'NIUE' => 'NU',
        'NORFOLK ISLAND' => 'NF',
        'NORTHERN MARIANA ISLANDS' => 'MP',
        'NORWAY' => 'NO',
        'OMAN' => 'OM',
        'PALAU' => 'PW',
        'PALESTINE' => 'PS',
        'PANAMA' => 'PA',
        'PARAGUAY' => 'PY',
        'PERU' => 'PE',
        'PHILIPPINES' => 'PH',
        'PITCAIRN' => 'PN',
        'POLAND' => 'PL',
        'PORTUGAL' => 'PT',
        'PUERTO RICO' => 'PR',
        'QATAR' => 'QA',
        'REUNION' => 'RE',
        'ROMANIA' => 'RO',
        'RUSSIAN FEDERATION' => 'RU',
        'RWANDA' => 'RW',
        'SAINT HELENA' => 'SH',
        'SAINT KITTS AND NEVIS' => 'KN',
        'SAINT LUCIA' => 'LC',
        'SAINT PIERRE AND MIQUELON' => 'PM',
        'SAINT VINCENT AND THE GRENADINES' => 'VC',
        'SAMOA' => 'WS',
        'SAN MARINO' => 'SM',
        //'SAO TOME AND PRINCIPE *' => 'ST *',
        'SAUDI ARABIA' => 'SA',
        'SENEGAL' => 'SN',
        'SERBIA' => 'RS',
        'SEYCHELLES' => 'SC',
        'SINGAPORE' => 'SG',
        'SLOVAKIA' => 'SK',
        'SLOVENIA' => 'SI',
        'SOLOMON ISLANDS' => 'SB',
        'SOUTH AFRICA' => 'ZA',
        'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS' => 'GS',
        'SPAIN' => 'ES',
        'SURINAME' => 'SR',
        'SVALBARD AND JAN MAYEN' => 'SJ',
        'SWAZILAND' => 'SZ',
        'SWEDEN' => 'SE',
        'SWITZERLAND' => 'CH',
        'TAIWAN, PROVINCE OF CHINA' => 'TW',
        'TANZANIA, UNITED REPUBLIC OF' => 'TZ',
        'THAILAND' => 'TH',
        'TIMOR-LESTE' => 'TL',
        'TOGO' => 'TG',
        'TOKELAU' => 'TK',
        'TONGA' => 'TO',
        'TRINIDAD AND TOBAGO' => 'TT',
        'TUNISIA' => 'TN',
        'TURKEY' => 'TR',
        'TURKMENISTAN' => 'TM',
        'TURKS AND CAICOS ISLANDS' => 'TC',
        'TUVALU' => 'TV',
        'UGANDA' => 'UG',
        'UKRAINE' => 'UA',
        'UNITED ARAB EMIRATES' => 'AE',
        'UNITED KINGDOM' => 'GB',
        'UNITED STATES' => 'US',
        'UNITED STATES MINOR OUTLYING ISLANDS' => 'UM',
        'URUGUAY' => 'UY',
        'UZBEKISTAN' => 'UZ',
        'VANUATU' => 'VU',
        'VENEZUELA' => 'VE',
        'VIET NAM' => 'VN',
        'VIRGIN ISLANDS, BRITISH' => 'VG',
        'VIRGIN ISLANDS, U.S.' => 'VI',
        'WALLIS AND FUTUNA' => 'WF',
        'WESTERN SAHARA' => 'EH',
        'ZAMBIA' => 'ZM'
    );

    static public function getNameToCodeArray()
    {
        return self::$countryCodes;
    }

    static public function getCodeToNameArray()
    {
        return array_flip(self::$countryCodes);
    }

    static public function getCodeByName($country) {
        $key = strtoupper($country);
        if(!isset(self::$countryCodes[$key])) {
            return null;
        }
        return self::$countryCodes[$key];
    }

    static public function getNameByCode($code) {
        $key = strtoupper($code);
        $codes = self::getCodeToNameArray();
        if(!isset($codes[$key])) {
            return null;
        }

        return $codes[$key];
    }

    static public function isValid($code)
    {
        $country = self::getNameByCode($code);
        if(is_null($country)) {
            $country = self::getCodeByName($code);
        }

        if(is_null($country)) {
            return false;
        }

        return true;
    }
}