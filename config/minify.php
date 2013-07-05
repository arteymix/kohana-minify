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
    'enabled' => TRUE, // If not enabled, files will be renamed with their paths and returned
    'path' => 'assets/media/', // Path for minified files
    // Per-type configurations
    'coffee' => array(
        'path' => 'assets/coffee/',
        'extension' => 'js', // Optional (defaulted to array key)
        'driver' => 'coffeescript',
        'options' => array() // Options for driver
    ),
    'css' => array(
        'path' => 'assets/less/',
        'separator' => '', // No file separator required for css
        'driver' => 'cssmin',
        'options' => array()
    ),
    'js' => array(
        'path' => 'assets/js/',
        'driver' => 'JShrink',
        'options' => array(
            'flaggedComments' => FALSE, // Remove comments
        )
    ),
    'less' => array(
        'path' => 'assets/less/',
        'extension' => 'css',
        'driver' => 'lessphp',
        'options' => array()
    ),
);