<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Base class for minification drivers.
 * 
 * @package Minify
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
abstract class Minify_Driver {

    /**
     * 
     * @param string $name
     * @param array $options
     * @return \Minify_Driver
     */
    public static function factory($name, array $options = array()) {

        $class = "Minify_Driver_$name";

        return new $class($options);
    }

    protected $options;

    /**
     * 
     * @param array $options
     */
    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    /**
     * Minifies the given input
     * 
     * @param string $input a string containing data to be minified.
     * @return string the minified $input
     */
    public abstract function minify($input);
}

?>
