<?php

defined('SYSPATH') OR die('No direct access allowed.');

require_once Kohana::find_file('vendor', 'JShrink/src/JShrink/Minifier');

/**
 * JShrink minification driver.
 *
 * @link https://github.com/tedivm/JShrink
 *
 * @package  Minify
 * @category Drivers
 * @license  https://github.com/tedivm/JShrink/blob/master/LICENSE
 */
class Kohana_Minify_Driver_JShrink extends Minify_Driver {

    public function minify($input) {
        return JShrink\Minifier::minify($input, $this->options);
    }

}
