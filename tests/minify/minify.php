<?php

class Minify_Test extends Unittest_TestCase {

    public function test_minify() {
        
        $this->assertTrue(Kohana::$config->load('minify.enabled'));
        
        Minify::factory('css')->minify_input('');
        
    }

}

?>
