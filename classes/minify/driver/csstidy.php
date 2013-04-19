<?php

require_once Kohana::find_file("vendor", "CSSTidy/class.csstidy");

/**
 * CSSTidy minification driver.
 * 
 * @see http://csstidy.sourceforge.net/
 * 
 * @package Minify
 * @category Drivers
 * @license LGPL 2.1
 */
class Minify_Driver_CSSTidy extends Minify_Driver {
    
    public function minify($input) {
        $compiler = new csstidy();
        $compiler->parse($input);
        return $compiler->print->formatted();
    }    
}

?>
