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

    private $css_example = "
        .clearfix:after {
            clear: both;
          }

          .hide-text {
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
          }

          .input-block-level {
            display: block;
            width: 100%;
            min-height: 30px;
            -webkit-box-sizing: border-box;
               -moz-box-sizing: border-box;
                    box-sizing: border-box;
          }
    ";

    public function test_minify_input() {
        Minify::factory('css')->minify_input($this->css_example);
    }

    public function test_cssmin() {
        Minify_Driver::factory("cssmin")->minify($this->css_example);
    }

    public function test_CSSTidy() {
        Minify_Driver::factory("CSSTidy")->minify($this->css_example);
    }

}

?>
