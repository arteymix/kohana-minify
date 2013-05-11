<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Base class for minification drivers.
 * 
 * @package Minify
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
abstract class Kohana_Minify_Driver {

    protected $options;

    /**
     * 
     * @param array $options
     */
    public function __construct(array $options) {
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
