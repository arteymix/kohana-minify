<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Minify
 * 
 * Minify given string
 * 
 *     $min = Minify::factory('js')->minify_input( $filecontents );
 *     $min = Minify::factory('css')->minify_input( $filecontents ); 
 *
 * Controller
 * 
 *     protected $js = array('foo.js', 'bar.js');
 *     protected $css = array('foo.css', 'bar.css')
 *   
 *     after:
 *         $this->template->js = Minify::factory('js')->minify($this->js);
 *         $this->template->css = Minify::factory('css')->minify($this->css);
 *
 * View
 * 
 *     foreach ($js as $file) {
 *         echo HTML::script($file);      
 *     }
 * 
 *     foreach ($css as $file) {
 *         echo HTML::style($file);      
 *     }
 * 
 * @package Minify
 * @author  Su nombre <>
 * @author  Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Minify {

    /**
     * Create a minifier for a given type.
     *
     * @param  string $type
     * @return Minify
     */
    public static function factory($type) {
        return new Minify($type);
    }

    public function __construct($name) {

        $this->extension = Kohana::$config->load("minify.$name.extension");
        $this->separator = Kohana::$config->load("minify.$name.separator");
        $this->path = Kohana::$config->load("minify.$name.path");

        // Load the driver and its options
        $driver = Kohana::$config->load("minify.$name.driver");
        $options = Kohana::$config->load("minify.$name.driver_options");
        $this->driver = Minify_Driver::factory($driver, $options);
    }

    /**
     * Minifies a given array of files.
     * 
     * @param  array  $files
     * @param  string $build is a custom build identifier
     * @return array  a list of minified files
     */
    public function minify(array $files, $build = '') {

        $timestamps = array();

        foreach ($files as &$file) {
            if (strpos('://', $file) === FALSE) {
                $file = $this->path . $file;
                
                $timestamp = filemtime($file);

                if($timestamp === FALSE) {
                    throw new Kohana_Exception('Could not get a timestamp for file :file.', array(':file' => $file));   
                }

                $timestamps[] = filemtime($file);
            }
        }

        if (Kohana::$config->load('minify.enabled') === FALSE) {
            return $files;
        }

        // Serialize the state of the minifier including files and driver options
        $name = sha1(serialize($this->driver->options) . serialize($timestamps));

        $extension = rtrim('.', '.' . $this->extension); // '.' becomes ''

        $outfile = Kohana::$config->load('minify.path') . $name . $build . $extension;

        if (!file_exists($outfile)) {

            // Generates an minified file

            $minified = array();

            foreach ($files as $file) {

                $file = $this->path . $file;

                if (file_exists(($file))) {
                    $minified[] = $this->minify_input(file_get_contents($file));
                }
            }

            $minified = implode($this->separator, $minified);

            if (!file_put_contents($outfile, $minified)) {
                throw new Kohana_Exception('Could not write to file :outfile.', array(':outfile' => $outfile));
            }
        }

        return array($outfile);
    }

    /**
     * Minify a given input.
     * 
     * @param  string $input 
     * @return string the input minified.
     */
    public function minify_input($input) {
        return $this->driver->minify($input);
    }
}
