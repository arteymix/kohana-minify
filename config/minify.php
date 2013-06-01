<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Configuration for Minify.
 * 
 * @package Minify
 */
return array(
    'enabled' => TRUE,
    'media_path' => 'media/',
    // Per-type configurations
    'coffee' => array(
        'path' => 'coffee/',
        'output_type' => 'js',
        'driver' => 'coffeescript',
        'options' => array() // Options for driver
    ),
    'css' => array(
        'path' => 'less/',
        'separator' => '', // No file separator required for css
        'driver' => 'cssmin',
        'options' => array()
    ),
    'js' => array(
        'path' => 'js/',
        'driver' => 'JShrink',
        'options' => array(
            'flaggedComments' => FALSE, // Remove comments
        )
    ),
    'less' => array(
        'path' => 'less/',
        'output_type' => 'css',
        'driver' => 'lessphp',
        'options' => array()
    ),
);