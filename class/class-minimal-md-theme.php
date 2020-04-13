<?php
/**
 * Initlialize all theme functionality and classes.
 *
 * @package WordPress
 * @subpackage minimal-md-theme
 * @since Minimal MD Theme 1.0
 */

namespace MinimalMDTheme;

class Minimal_MD_Theme {
	private static $instance;
	private static $instances;

	public $uri;


	/**
	 * Return the instance of this class (Singleton).
	 *
	 * @return Minimal_MD_Theme
	 */
	public static function get_instance(): Minimal_MD_Theme {
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
	public function initialize(): void {
		$this->uri       = trailingslashit( get_template_directory() );
		$this->instances = array();

		$this->load_instance( 'Enqueues', 'Enqueues' );
		$this->load_instance( 'Icons', 'SVG_Icons' );
		$this->load_instance( 'Initialize', 'Initialize' );
	}


	/**
	 * Returns a secondary theme class. Throws Exception if the class hasn't
	 * been instancianted. Allows chaining.
	 *
	 * @param string $class
	 * @return object
	 */
	public static function get( string $class ): object {
		if ( ! isset( self::$instances[ $class ] ) ) {
			throw new \Exception( 'Invalid class: ' . $class );
		}

		return self::$instances[ $class ];
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
	private function load_instance( string $as, string $class ): void {
		$formated   = strtolower( str_replace( '_', '-', $class ) );
		$ns_class   = __NAMESPACE__ . "\\{$class}";
		$class_path = $this->uri . 'class/class-' . $formated . '.php';
		$realpath   = realpath( $class_path );

		if ( ! $realpath ) {
			throw new \Exception( 'Invalid class path: ' . $class_path, 404 );
		}

		require_once $realpath;
		self::$instances[ $as ] = new $ns_class( $this );
	}
}
