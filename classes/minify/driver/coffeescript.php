<?php

require_once Kohana::find_file("vendor", "coffeescript/src/CoffeeScript/Init");

// Load manually
CoffeeScript\Init::load();

/**
 * CoffeeScript minification driver.
 * 
 * @link 
 * 
 * @package Minify
 * @category Drivers
 * 
 */
class Minify_Driver_CoffeeScript extends Minify_Driver_JShrink {

    public function minify($input) {
        return parent::minify(CoffeeScript\Compiler::compile($input));
    }

}

?>
