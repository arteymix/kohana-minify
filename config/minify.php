<?php

defined('SYSPATH') OR die('No direct access allowed.');

return array(
    'enabled' => TRUE,
    'path' => array(
        'js' => 'js/',
        'css' => 'css/',
        'less' => 'less/',
        'media' => 'media/',
    ),
    // Binds file type to minification driver
    'driver' => array(
        'js' => 'JShrink',
        'css' => 'cssmin',
        'less' => 'lessphp'
    ),
    // Additional options per driver
    'options' => array(
        'JShrink' => array(),
        'cssmin' => array(),
        'lessphp' => array(),
        'CSSTidy' => array()
    ),
);