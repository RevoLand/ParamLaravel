<?php

namespace RevoLand\ParamLaravel;

if (!function_exists('Param_XmlStringOlustur'))
{
    // Param'ın mevcut XML yapısından SimpleXMLElement oluşturalım.
    // https://github.com/PARAMPOS/param-php/blob/ce394dd52d6ec232e611eaeb7d0c07eed97a6a16/src/Bin.php#L58
    function Param_XmlStringOlustur($icerik)
    {
        try
        {
            $xmlIcerigi = str_replace(['diffgr:', 'msdata:'], '', $icerik);

            return simplexml_load_string('<?xml version=\'1.0\' standalone=\'yes\'?><root>' . $xmlIcerigi . '</root>');
        }
        catch (\Exception $ex)
        {
            return false;
        }
    }
}
