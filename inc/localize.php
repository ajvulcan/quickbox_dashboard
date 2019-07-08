<?php
    $locale = 'es_ES.UTF-8';
    $language = 'lang_es';
    setlocale(LC_ALL, es_ES.UTF-8);
    require ($_SERVER['DOCUMENT_ROOT']."/lang/lang_es");

    function T($str)
    {
        global $L;
        if (isset($L[$str]))
            return $L[$str];
        else
            return $str;
    }

?>
