<?php

defined('SYSPATH') OR die('No direct access allowed.');

require_once Kohana::find_file('vendor', 'CSSTidy/class.csstidy');

/**
 * Minification driver for CSSTidy.
 * 
 * @package  Minify
 * @category Drivers
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Minify_Driver_CSSTidy extends Minify_Driver {

    public function minify($input) {
        $compiler = new csstidy();
        $compiler->parse($input);
        return $compiler->print->formatted();
    }

}
