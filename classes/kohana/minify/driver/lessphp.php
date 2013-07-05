<?php

defined('SYSPATH') OR die('No direct access allowed.');

require_once Kohana::find_file('vendor', 'lessphp/lessc.inc');

/**
 * Minifier less using lessphp.
 * 
 * @link http://leafo.net/lessphp/
 * 
 * @package  Minify
 * @category Drivers
 * @author   Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @license  GPL3/MIT
 */
class Kohana_Minify_Driver_lessphp extends Minify_Driver {

    /**
     * less compiler.
     * 
     * @var lessc 
     */
    private $compiler;

    public function __construct(array $options) {
        parent::__construct($options);
        $this->compiler = new lessc();
        $this->compiler->setFormatter('compressed');
    }

    public function minify($input) {
        return $this->compiler->compile($input);
    }

}

?>
