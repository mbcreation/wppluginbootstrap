<?php

/**
 *
 * Plugin Name: {PLUGIN_NAME}
 * Description: {PLUGIN_DESCRIPTION}
 * Version: {PLUGIN_VERSION}
 * Author: MB Création
 * Author URI: http://www.mbcreation.net
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( ! class_exists( 'MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}' ) ) {

class MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}{
		
		/**
    	 * @access public
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var string
    	 */
		public static $options_name = 'mbc-{PLUGIN_SLUG_NO_SPACE}-pb_options';
		
		/**
    	 * @access public
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var string
    	 */
		public static $options_group = 'mbc-{PLUGIN_SLUG_NO_SPACE}-pb_group';


		/**
    	 * @access protected
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var array
    	 */
		protected static $default_options  = array(

			'active' => 0,
			'version' => {PLUGIN_VERSION}
		
		);
		
		/**
    	 * Construct
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
         * @access public
         * 
    	 */
		public function __construct()
		{	
				
				// Activation
				register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

				// Uninstall
				register_uninstall_hook( __FILE__,  array( __CLASS__ , 'plugin_uninstall' )  );
	
				// Loader
				add_action( 'plugins_loaded' , array( $this , 'plugin_load' ) );

				



		} // __construct

		/**
		 *
		 * Activation
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
         * @access public
         * 
		 * @return void
		 */
		public function plugin_activation()
		{
        	
        	update_option( self::$options_name , $this->default_options );

					
		} // install



		/**
		 *
		 * Uninstall
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
         * @static
         * @access public
         * 
		 * @return void
		 */
		public static function plugin_uninstall()
		{

			
			delete_option( self::$options_name );

		
		} // uninstall


		/**
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
         * @access public
         * @static
         * 
		 * @return void
		 */
		public static function get_plugin_options()
		
		{

			return wp_parse_args( get_option(self::$options_name), self::$default_options );

		}

		/**
		 *
		 * Load plugin
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
         * @access public
         * 
		 * @return void
		 */
		public function plugin_load()
		{

		
			if( is_admin() && current_user_can('manage_options' ) ) :
			
				require_once('class.admin.php');
				$backend = new MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}_Backend();

			endif;

					
		}


	} // Plugin_Bootstrap

	$pb = new MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}();

}