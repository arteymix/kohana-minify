<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 *  // Minify given string
 *  $min = Minify::factory('js')->set( $filecontents )->min();
 *  $min = Minify::factory('css')->set( $filecontents )->min(); 
 *
 *  // Minify list of files; write result into media folder 
 *  Controller::after()  
 *	$this->template->jsFiles = Minify::factory('js')->minify( $this->template->jsFiles, $build );
 *	$this->template->cssFiles = Minify::factory('css')->minify( $this->template->cssFiles, $build );
 *
 *  View: 
 * 	foreach ($cssFiles as $css) {
 *		if ( ! Kohana::config('minify.enabled') || $debug ) 
 * 			$css = "views/css/{$css}?{$build}";
 * 		echo HTML::style($css),"\n";
 * 	}
 * 	// application js files
 * 	foreach ($jsFiles as $js) { 
 * 		if ( ! Kohana::config('minify.enabled') || $debug ) 
 * 			$js = "views/jscript/{$js}?{$build}";
 * 		echo HTML::script($js),"\n";
 * 	}
 */
class Kohana_Minify {
    
       /**
        *
        * @var Minify_Driver
        */
        protected $driver;
	
	protected $type;
	protected $file;
	protected $input       = '';
	protected $inputLength = 0;

	public function __construct($type)
	{
		$this->type = $type;
                $driver = Kohana::$config->load("minify.driver.$type");
                $class = "Minify_Driver_$driver";
                $options = Kohana::$config->load("minify.options.$driver");
                $this->driver = new $class($options);
	}
	
        /**
         * 
         * @param string $type
         * @return \Minify_Core
         */
	public static function factory($type)
	{
                return new Minify($type);		
	}

	public function minify($files, $build = '')
	{
		if (Kohana::$config->load('minify.enabled', FALSE))
		{
			$m_files = array();
			foreach($files as $file)
			{
				$m_files[$file] = array($file);
				if (file_exists(Kohana::$config->load('minify.path.'.$this->type).$file))
				{
					$m_files[$file][] = filemtime(Kohana::$config->load('minify.path.'.$this->type).$file);
				}
			}
			$name = md5(json_encode($m_files));
			$outfile = Kohana::$config->load('minify.path.media').$name.$build.'.'.$this->type;
			if ( ! is_file($outfile))
			{
				if ( ! is_array($files))
				{
					$files = array( $files );
				}
				$output = ''; 
				foreach($files as $file)
				{
					$this->file = Kohana::$config->load('minify.path.'.$this->type).$file;
					if (is_file($this->file))
					{
						$this->set(file_get_contents($this->file));
						$output .= $this->min() . "\r\n";
					}
				}
				
				// write minified file 
				$f = fopen($outfile, 'w');
				if ($f)
				{
					fwrite($f, $output);
					fclose($f);
				}
			}
			return array($outfile);
		}
		else
		{
			$m_files = array();
			foreach($files as &$file)
			{
				if(substr($file, 0, 7) != "http://")
				{
					$file = Kohana::$config->load('minify.path.' . $this->type) . $file;
				}
			}
			return $files;
		}
	}

	// text an minifier Übergeben (per member variable)
	public function set($input)
	{
		$this->input       = str_replace("\r\n", "\n", $input);
		$this->inputLength = strlen($this->input);
		return $this;
	}       
        	
	// text komprimieren (abgeleitete Klasse)
	public function min()
	{
                return $this->driver->minify($this->input);
	}
        
}
