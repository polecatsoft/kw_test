<?php

class Requests
{
    static function getSendVar($name, $default = '')
    {
        if (isset($_GET[$name])) {
            return self::getGetVar($name, $default);
        } else {
            return self::getPostVar($name, $default);
        }
    }

    static function getGetVar($name, $default_val = null, $escape = false)
    {
        if (isset($_GET[$name])) {
            if ($escape) {
                return addslashes($_GET[$name]);
            }
            return $_GET[$name];
        } else {
            return $default_val;
        }
    }

    static function getPostVar($name, $default_val = null, $escape = false)
    {
        if (isset($_POST[$name])) {
            if ($escape) {
                return addslashes($_POST[$name]);
            }
            return $_POST[$name];
        } else {
            return $default_val;
        }
    }
}