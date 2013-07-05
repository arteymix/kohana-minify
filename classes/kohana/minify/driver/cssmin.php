<?php

defined('SYSPATH') OR die('No direct access allowed.');

require_once Kohana::find_file("vendor", "cssmin/source/CssMin");

/**
 * Minification driver for css using cssmin.
 * 
 * @see http://code.google.com/p/cssmin/
 * 
 * @package  Minify
 * @category Drivers
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @license  http://opensource.org/licenses/mit-license.php
 */
class Kohana_Minify_Driver_cssmin extends Minify_Driver {

    public function minify($input) {
        return CssMin::minify($input);
    }

}

?>
