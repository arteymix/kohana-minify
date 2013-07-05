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
 * @author  and Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Minify {

    /**
     *
     * @var string
     */
    protected $name = '';

    /**
     * Extension for the minified file.
     * 
     * @var string
     */
    protected $extension;

    /**
     * Separator for files.
     * 
     * @var string 
     */
    protected $separator = "\r\n";

    /**
     * Minification driver.
     * 
     * @var Minify_Driver
     */
    protected $driver;

    public function __construct($name) {

        // Set the input type
        $this->extension = $name;

        if ($type = Kohana::$config->load("minify.$type.extension")) {
            $this->extension = $extension;
        }

        // Custom separator, can be blank
        if (Kohana::$config->load("minify.$name.separator") !== NULL) {
            $this->separator = Kohana::$config->load("minify.$name.separator");
        }

        // Load the driver and its options
        $driver = Kohana::$config->load("minify.$name.driver");
        $options = Kohana::$config->load("minify.$name.options");
        $this->driver = Minify_Driver::factory($driver, $options);
    }

    /**
     * 
     * @param  string $type
     * @return Minify
     */
    public static function factory($type) {
        return new Minify($type);
    }

    /**
     * Minifies a given array of files.
     * 
     * @param  array  $files
     * @param  string $build is a custom build identifier
     * @return array  a list of minified files
     */
    public function minify(array $files, $build = '') {

        if (Kohana::$config->load('minify.enabled', FALSE) === TRUE) {

            $timestamps = array();

            // Store files timestamps in this object
            foreach ($files as $file) {
                if (file_exists(($file))) {
                    $timestamps[$file] = filemtime(Kohana::$config->load("minify.$this->name.path") . $file);
                }
            }

            // Serialize the state of the minifier including files and driver
            $name = sha1(serialize($this) . serialize($timestamps));

            $outfile = Kohana::$config->load('minify.path') . $name . $build . '.' . $this->extension;

            if (!file_exists($outfile)) {

                // Generates an minified file

                $minified = array();

                foreach ($files as $file) {
                    $file = Kohana::$config->load("minify.$this->name.path") . $file;
                    if (file_exists(($file))) {
                        $minified[] = $this->driver->minify(file_get_contents($file));
                    }
                }

                if (!file_put_contents($outfile, implode($this->separator, $minified))) {
                    throw new Kohana_Exception('Could not write to file :outfile.', array(':outfile' => $outfile));
                }
            }

            return array($outfile);
        }

        foreach ($files as &$file) {
            if (!preg_match('/^\w+::\/\//', $file)) {
                $file = Kohana::$config->load("minify.$this->name.path") . $file;
            }
        }

        return $files;
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
