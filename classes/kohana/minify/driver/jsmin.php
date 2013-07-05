<?php

defined('SYSPATH') or die('No direct script access.');

require_once Kohana::find_file('vendor', 'JSMin/jsmin');

/**
 * JavsScript minifier using JSMin.
 * 
 * @link https://github.com/rgrove/jsmin-php/
 * 
 * @package  Minify
 * @category Drivers
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Minify_Driver_JSMin extends Minify_Driver {

    public function minify($input) {      
        return JSMin::minify($input);
    }

}

?>
