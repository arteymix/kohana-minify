<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tests for css minification.
 * 
 * @package Minify
 * @category Tests
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Minify_CSS_Test extends Unittest_TestCase {
   
    private $css_example = "";
            

    public function test_cssmin() {
        Minify_Driver::factory("cssmin")->minify($this->css_example);
    }
    
    public function test_CSSTidy() {
        Minify_Driver::factory("CSSTidy")->minify($this->css_example);
    }

}

?>
