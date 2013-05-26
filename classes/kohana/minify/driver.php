<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Base class for minification drivers.
 * 
 * @package Minify
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
abstract class Kohana_Minify_Driver {

    /**
     * Factory method for minification drivers.
     * 
     * @param string $name is the minification driver name. It has to match
     * the driver exactly.
     * @param array $options are additionnal options to pass to the driver.
     * @return \Minify_Driver
     */
    public static function factory($name, array $options = array()) {

        $class = "Minify_Driver_$name";

        return new $class($options);
    }

    /**
     * Array of custom options passed to the minifier.
     * 
     * @var array 
     */
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
