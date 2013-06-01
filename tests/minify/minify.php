<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * General tests for Minify.
 * 
 * @package Minify
 * @category Tests
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Minify_Test extends Unittest_TestCase {

    public function test_minify() {

        $this->assertTrue(Kohana::$config->load('minify.enabled'));

        $this->assertFileExists(DOCROOT . Kohana::$config->load('minify.media_path'));
    }

}

?>
