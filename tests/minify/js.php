<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tests for js minification.
 * 
 * @package Minify
 * @category Tests
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency>
 */
class Minify_JS_Test extends Unittest_TestCase {
    
    /**
     * Javascript example taken from http://coffeescript.org
     * 
     * @var string 
     */
    private $js_example = '
        var cubes, list, math, num, number, opposite, race, square,
        __slice = [].slice;

        number = 42;

        opposite = true;

        if (opposite) {
          number = -42;
        }

        square = function(x) {
          return x * x;
        };

        list = [1, 2, 3, 4, 5];

        math = {
          root: Math.sqrt,
          square: square,
          cube: function(x) {
            return x * square(x);
          }
        };

        race = function() {
          var runners, winner;

          winner = arguments[0], runners = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
          return print(winner, runners);
        };

        if (typeof elvis !== "undefined" && elvis !== null) {
          alert("I knew it!");
        }

        cubes = (function() {
          var _i, _len, _results;

          _results = [];
          for (_i = 0, _len = list.length; _i < _len; _i++) {
            num = list[_i];
            _results.push(math.cube(num));
          }
          return _results;
        })();
    ';

    public function test_JShrink() {
        Minify_Driver::factory("JShrink")->minify($this->js_example);
    }

}

?>
