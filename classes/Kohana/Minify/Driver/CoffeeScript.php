<?php

defined('SYSPATH') OR die('No direct access allowed.');

require_once Kohana::find_file('vendor', 'coffeescript/src/CoffeeScript/Init');

/**
 * Load manually
 */
CoffeeScript\Init::load();

/**
 * CoffeeScript minification driver.
 * 
 * @link http://coffeescript.org/
 * 
 * @package  Minify
 * @category Drivers
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @license  MIT
 */
class Kohana_Minify_Driver_CoffeeScript extends Minify_Driver {

    public function minify($input) {
        return Minify::factory('js')->minify_input(CoffeeScript\Compiler::compile($input));
    }

}
