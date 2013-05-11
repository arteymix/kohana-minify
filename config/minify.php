<?php

defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'enabled' => TRUE,
    'path' => array(
        'js' => 'js/',
        'css' => 'css/',
        'less' => 'less/',
        'coffee' => 'coffee/',
        'media' => 'media/',
    ),
    'driver' => array(
        'js' => 'JShrink',
        'css' => 'cssmin',
        'less' => 'lessphp',
        'coffee' => 'coffeescript',
    ),
    // Extension for outputted format
    'output_type' => array(
        'less' => 'css',
        'coffee' => 'js',
    ),
    // Additional options per driver
    'options' => array(
        'JShrink' => array(),
        'cssmin' => array(),
        'lessphp' => array(),
        'CSSTidy' => array(),
        'coffeescript' => array(),
    ),
);