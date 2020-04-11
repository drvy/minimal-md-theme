<?php
/**
 * Initlialize all theme functionality and classes.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Main {
	private static $instance;
	private $instances;

	public $uri;


	/**
	 * Return the instance of this class (Singleton).
	 *
	 * @return Minimal_MD_Theme
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->initialize();
		}

		return self::$instance;
	}


	/**
	 * Initialize basic theme functionality and require necessary files.
	 *
	 * @return void
	 */
	public function initialize() {
		$this->uri       = trailingslashit( get_template_directory() );
		$this->instances = array();

		$this->load_instance( 'ThemeSupport', 'Theme_Support' );
	}


	/**
	 * Returns a secondary theme class. Throws Exception if the class hasn't
	 * been instancianted. Allows chaining.
	 *
	 * @param string $class
	 * @return object
	 */
	public function get( string $class ) {
		if ( ! isset( $this->instances[ $class ] ) ) {
			throw new \Exception( 'Invalid class: ' . $class );
		}

		return $this->instances[ $class ];
	}


	/**
	 * Requires and instanciates a class file following WP naming conventions.
	 *
	 * Example: load_intance( 'ThemeSupport', 'Theme_Support ) will load
	 * 'class-theme-support.php' and instanciate Theme_Support as ThemeSupport.
	 *
	 * Throws an Exception in case the path is not valid.
	 *
	 * @param string $as
	 * @param string $class
	 * @return void
	 */
	private function load_instance( string $as, string $class ) {
		$formated   = strtolower( str_replace( '_', '-', $class ) );
		$ns_class   = __NAMESPACE__ . "\\{$class}";
		$class_path = $this->uri . 'class/class-' . $formated . '.php';
		$realpath   = realpath( $class_path );

		if ( ! $realpath ) {
			throw new \Exception( 'Invalid class path: ' . $class_path, 404 );
		}

		require_once $realpath;
		$this->instances[ $as ] = new $ns_class( $this );
	}
}
