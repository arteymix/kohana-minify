<?php

defined('SYSPATH') OR die('No direct access allowed.');

/**
 *  // Minify given string
 *  $min = Minify::factory('js')->minify_input( $filecontents );
 *  $min = Minify::factory('css')->minify_input( $filecontents ); 
 *
 *  // Minify list of files; write result into media folder 
 *  Controller::after()  
 * 	$this->template->jsFiles = Minify::factory('js')->minify( $this->template->jsFiles, $build );
 * 	$this->template->cssFiles = Minify::factory('css')->minify( $this->template->cssFiles, $build );
 *
 *  View: 
 * 	foreach ($cssFiles as $css) {
 * 		if ( ! Kohana::config('minify.enabled') || $debug ) 
 * 			$css = "views/css/{$css}?{$build}";
 * 		echo HTML::style($css),"\n";
 * 	}
 * 	// application js files
 * 	foreach ($jsFiles as $js) { 
 * 		if ( ! Kohana::config('minify.enabled') || $debug ) 
 * 			$js = "views/jscript/{$js}?{$build}";
 * 		echo HTML::script($js),"\n";
 * 	}
 * 
 * @package Minify
 */
class Kohana_Minify {

    /**
     * Type of what's being minified.
     * @var string
     */
    protected $type;

    /**
     * Internal driver
     * @var Minify_Driver
     */
    protected $driver;

    /**
     * Output type once minified
     * @var string 
     */
    protected $output_type;

    /**
     * Separator for files.
     * 
     * @var string 
     */
    protected $separator = "\r\n";

    public function __construct($type) {

        // Set the input type
        $this->type = $type;

        $this->output_type = $type;

        // Set the output type, fallback to input type
        if ($output_type = Kohana::$config->load("minify.$type.output_type")) {
            $this->output_type = $output_type;
        }

        // Custom separator, can be blank
        if (Kohana::$config->load("minify.$type.separator") !== NULL) {
            $this->separator = Kohana::$config->load("minify.$type.separator");
        }

        // Load the driver and its options
        $driver = Kohana::$config->load("minify.$type.driver");
        $options = Kohana::$config->load("minify.$type.options");
        $this->driver = Minify_Driver::factory($driver, $options);
    }

    /**
     * 
     * @param string $type
     * @return \Minify_Core
     */
    public static function factory($type) {
        return new Minify($type);
    }

    public function minify(array $files, $build = '') {

        if (Kohana::$config->load('minify.enabled', FALSE)) {

            $this->file_modified_timestamps = array();

            foreach ($files as $file) {
                $this->file_modified_timestamps[$file] = array($file);
                if (file_exists(Kohana::$config->load("minify.$this->type.path") . $file)) {
                    $this->file_modified_timestamps[$file][] = filemtime(Kohana::$config->load("minify.$this->type.path") . $file);
                }
            }

            // Serialize the state of the minifier (include the state of the driver)
            $name = md5(serialize($this));

            $outfile = Kohana::$config->load('minify.media_path') . $name . $build . '.' . $this->output_type;

            if (!is_file($outfile)) {

                if (!is_array($files)) {
                    $files = array($files);
                }

                $minified = array();
                foreach ($files as $file) {
                    $_file = Kohana::$config->load("minify.$this->type.path") . $file;
                    if (is_file($_file)) {
                        $minified[] = $this->driver->minify(file_get_contents($_file));
                    }
                }

                // write minified file 
                $f = fopen($outfile, 'w');
                if ($f) {
                    fwrite($f, implode($this->separator, $minified));
                    fclose($f);
                }
            }

            return array($outfile);
        } else {
            foreach ($files as &$file) {
                if (substr($file, 0, 7) != "http://") {
                    $file = Kohana::$config->load("minify.$this->type.path") . $file;
                }
            }

            return $files;
        }
    }

    public function minify_input($input) {
        return $this->driver->minify($input);
    }

}
