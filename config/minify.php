<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Configuration for Minify.
 * 
 * @package  Minify
 * @category Configurations
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
return array(
    /**
     * Enable the minifier.
     */
    'enabled' => TRUE,
    'path' => 'assets/media/', // Path for minified files
    // Per-type configurations
    'coffee' => array(
        'path' => 'assets/coffee/',
        'separator' => "\r\n",
        'extension' => 'js',
        'driver' => 'CoffeeScript',
        'driver_options' => array()
    ),
    'css' => array(
        'path' => 'assets/css/',
        'separator' => '', // No file separator required for css
        'extension' => 'css',
        'driver' => 'cssmin',
        'driver_options' => array()
    ),
    'js' => array(
        'path' => 'assets/js/',
        'separator' => "\r\n",
        'extension' => 'css',
        'driver' => 'JShrink',
        'driver_options' => array(
            'flaggedComments' => FALSE, // Remove comments
        )
    ),
    'less' => array(
        'path' => 'assets/less/',
        'separator' => '',
        'extension' => 'css',
        'driver' => 'lessphp',
        'driver_options' => array()
    )
);
