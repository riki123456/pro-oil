<?php

namespace App\Helpers;

use Nette\Utils\Html;

/**
 * Format class
 * 
 * @author Jan Jadud
 */
final class Format {

    /**
     * Static class - cannot be instantiated.
     */
    final public function __construct() {
        throw new LogicException("Cannot instantiate static class " . get_class($this));
    }

    /**
     * Loads static helper
     * Register with Template in for example BasePresenter->createTemplate()
     * 
     * @param string $helper
     * @return NCallback|null
     */
    public static function loadHelper($helper) {
        $callback = $callback = __CLASS__ . '::' . $helper;
        $ret = NULL;

        if (is_callable($callback)) {
            $ret = $callback;
        }

        return $ret;
    }

    /**
     * Formats and splits given string according to $lengths and $functions
     *
     * @param string $subject
     * @param array|int $lengths
     * @param string $delimiter
     * @param array $functions
     * @return string
     */
    static public function format($subject, $lengths, $delimiter = ' ', $functions = array()) {
        $o = array();
        foreach ($functions as $function) {
            if (is_callable($function)) {
                $subject = $function($subject);
            }
        }
        if (is_array($lengths)) {
            foreach ($lengths as $length) {
                $o[] = substr($subject, 0, $length);
                $subject = substr($subject, $length, strlen($subject));
            }
            $o[] = $subject;
        } else {
            $o = str_split($subject, $lengths);
        }
        return implode($delimiter, $o);
    }

    /**
     * Format telephone number according to known SK and CZ specifics
     * @param string $telephone
     * @return string
     */
    static public function telephone($telephone) {
        $ret = "";

        if (String::startsWith($telephone, '02')) {
            $ret = self::format($telephone, array(2, 1, 2, 2, 2,));
        } elseif (String::startsWith($telephone, '0')) {
            $ret = self::format($telephone, array(3, 1, 2, 2, 2,));
        } elseif (strlen($telephone) === 10) {
            $ret = self::format($telephone, array(3, 1, 2, 2, 2,));
        } elseif (strlen($telephone) === 9) {
            $ret = self::format($telephone, array(3, 3, 3,));
        } else {
            $ret = self::format($telephone, array(1, 2, 2, 2,));
        }

        return $ret;
    }

    /**
     * Format mobile number according to known SK and CZ specifics
     * @param string $mobile
     * @return string
     */
    static public function mobile($mobile) {
        $ret = "";

        if (String::startsWith($mobile, '+')) {
            $ret = self::format($mobile, array(4, 3, 3, 3,));
        } elseif (String::startsWith($mobile, '00')) {
            $ret = self::format($mobile, array(5, 3, 3, 3,));
        } else {
            $ret = self::format($mobile, array(4, 3, 3,));
        }

        return $ret;
    }

    /**
     * Formats IBAN number
     * @param string $iban
     * @return string
     */
    static public function iban($iban) {
        return self::format($iban, 4);
    }

    /**
     * Unifies float numbers. All "," are replaced with "."
     *
     * @param string $float
     * @return string
     */
    static public function fixFloat($float) {
        return str_replace(',', '.', $float);
    }

    /**
     * Formats number (integer or float) SK, CZ locale default
     * 
     * @param mixed $number
     * @param int $decimals number of decimal places
     * @param string $decPoint decimal separator
     * @param string $thoudsandsSep thousands separator
     * @param bool $trimZeros trim right zeros from float numbers?
     * @return string
     */
    static public function number($number, $decimals = 2, $decPoint = ',', $thoudsandsSep = "\xc2\xa0", $trimZeros = FALSE) {
        $ret = "";
        $fixed = self::fixFloat($number);

        if (strpos($fixed, '.') === false) {
//int
            $number = (int) $number;
            $ret = number_format($number, 0, $decPoint, $thoudsandsSep);
        } else {
//float
            $number = (float) $fixed;
            $ret = ($trimZeros) ? rtrim(rtrim(number_format($number, $decimals, $decPoint, $thoudsandsSep), '0'), $decPoint) : number_format($number, $decimals, $decPoint, $thoudsandsSep);
        }

        return $ret;
    }

    /**
     * Formats given number as money with possible currency symbol
     * 
     * @param mixed $money
     * @param string|null $currency
     * @return string
     */
    static public function money($money, $currency = '€') {
        //$fixed = self::fixFloat($money);
        $formatted = self::number($money, 2);
        
        /** dle normy z roku 2015 se jiz ",-" nepouziva
        if (strpos($fixed, ',') === false) {
            $formatted .= ',-';
        }
         */
        
        return ($currency === NULL) ? $formatted : $formatted . ' ' . $currency;
    }

    /**
     * Formats value as checkbox state checked|notchecked
     * @param $value
     * @return \Nette\Utils\Html
     */
    static public function checkbox($value) {
        $class = ($value) ? 'tag-true' : 'tag-false';
        $text = ($value) ? '&bull;' : '&nbsp;';
        return Html::el('span')->setHtml($text)->addClass($class);
    }

    /**
     * Formats value as 3 state checkbox checked|notchecked|NA
     * @param $value
     * @return \Nette\Utils\Html
     */
    static public function checkbox3($value) {
        $ret = NULL;

        if (equals($value, 'na', -1, NULL)) {
            $ret = Html::el('span')->setText('n/a')->addClass('tag-na');
        } else {
            $ret = self::checkbox($value);
        }

        return $ret;
    }

    /**
     * Replaces value if equals NULL
     * @param mixed $value
     * @param mixed $replacement
     * @return mixed
     */
    static public function onNull($value, $replacement) {
        return ($value === NULL) ? $replacement : $value;
    }

    /**
     * Adds suffix
     * @param string $value
     * @param string $suffix
     * @return string
     */
    static public function suffix($value, $suffix) {
        return $value . $suffix;
    }

    /**
     * Adds prefix
     * @param string $value
     * @param string $prefix
     * @return string
     */
    static public function prefix($value, $prefix) {
        return $prefix . $value;
    }

}

function equals($subject, $toCompare) {
    $ret = false;
    
    if (func_num_args() > 2) {
        $toCompare = func_get_args();
        array_shift($toCompare);
    }

    if (is_array($toCompare)) {
        foreach ($toCompare as $comparison) {
            $result = (bool) ($subject === $comparison);
            if ($result === TRUE) {
                $ret = TRUE;
            }
        }
        $ret = FALSE;
    } else {
        $ret = (bool) ($subject === $toCompare);
    }
    
    return $ret;
}
