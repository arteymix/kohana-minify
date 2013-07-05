# Kohana 3.0 Minify Module 

Simple Minify wrapper for Kohana 3. Yet basically tailored to suit my needs in a specific project.

## Usage

### Simplistic

    $minified = Minify::factory('css')->minify(array('foo.css', 'bar.css'));

    foreach ($minified as $file) {
        echo HTML::style($file);
    }

### Efficient

    class Controller_Template_Foo {

        protected $js = array('foo.js', 'bar.js');
        protected $css = array('foo.css', 'bar.css');

        public function after() {

            parent::after();

            $this->template->css = Minify::factory('css')->minify($this->css);
            $this->template->js = Minify::factory('css')->minify($this>js);
        }

    }

Then in your template..

    foreach ($css as $file) {
        echo HTML::style($file);
    }

    foreach ($js as $file) {
        echo HTML::script($file);
    }

### Any input..

    Minify::factory('css')->minify_input('foo {display:none}');

## Configuration

Minify is driver based. Some minification configurations are already setted in
the configuration file.

path: where the files can be found for this setup
type: extension of 

## Credits

Based on the Kohana 2 Minify Driver by Tom Morton 

Using jsmin by rgrove: http://code.google.com/p/jsmin-php 

Using cssmin by joe.scylla: http://code.google.com/p/cssmin

Using CoffeeScript compiler

Using lessphp compiler by leafo: https://github.com/leafo/lessphp
