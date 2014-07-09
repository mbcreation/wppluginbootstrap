<?php



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( ! class_exists( 'MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}_Backend' ) ) {

class MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}_Backend {
		
		/**
    	 * @access protected
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var array
    	 */
		protected $plugin_options;

		/**
    	 * @access protected
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var string
    	 */
		protected $_setting_page_name;	

		/**
    	 * @access protected
    	 * @static
    	 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
    	 * @var string
    	 */
		protected $_setting_page_slug = 'page-{PLUGIN_SLUG}';


		/**
		 * Construct
		 *  
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
		 * @access public
		 */
		public function __construct(){

			$this->plugin_options = MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}::get_plugin_options();
			$this->_setting_page_name = __('Page name','{PLUGIN_SLUG}');
			$this->hooks();

		}

		public function hooks()
		{
			
			add_action( 'admin_menu', array( $this, 'add_plugin_menu' ) );
			add_action( 'admin_init', array( $this, 'options_init') );
			add_action( 'load-settings_page_'.$this->_setting_page_slug, array( $this, 'plugin_admin_boostrap' ) );

			add_filter( 'plugin_action_links_{PLUGIN_SLUG}/{PLUGIN_SLUG}.php', array($this,'action_links'), 10, 2 );
		
		} // hooks
		
		/**
		 * Menu plugin
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
		 * @access public
		 * 
		 * @return void
		 */
		public function add_plugin_menu()
		{

			add_options_page( $this->_setting_page_name, $this->_setting_page_name, 'manage_options', $this->_setting_page_slug, array( $this, 'options_panel' ) );
		
		} // add_plugin_menu


		/**
		 * Option init
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
		 * @access public
		 * 
		 * @return void
		 */
		public function options_init()
		{

			register_setting( MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}::$options_group, MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}::$options_name , array( $this, 'options_validate' ) );

		} // options_init

		public function plugin_admin_boostrap()
		{	

		

		} // plugin_admin_boostrap


		/**
		 * HTML Page admin
		 * 
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
		 * @access public
		 * 
		 * @return void
		 */
		public function options_panel()
		{ 
			if ( ! current_user_can( 'manage_options' ) )
			wp_die( __( 'You do not have sufficient permissions to manage options for this site.','{PLUGIN_SLUG}' ) );

		?>
			
			<div class="wrap">
			

				<h2>Panel</h2>
				<form method="post" action="options.php">
					<?php settings_fields( MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}::$options_group ); ?>

					
					


					<?php submit_button(); ?>
				</form>
			</div>




		<?php 

		} // option_panel

		/**
		 * Options validate
		 * 
		 * @param  array $inputs 
		 *
		 * @since {SINCE_VERSION}
         * @version {PLUGIN_VERSION}
		 * @access public
		 * 
		 * @return array         
		 */
		public function options_validate($options){

			return $options;
		
		} // Options validate


		public function action_links( $links, $file )
		{
			array_unshift( $links, '<a href="' . admin_url( 'admin.php?page=' . $this->_setting_page_slug ) . '">' . __( 'Go to {PLUGIN_NAME}', '{PLUGIN_SLUG}' ) . '</a>' );
			
			return $links;
		}

	
	} // MBC_{UCFIRST_PLUGIN_SLUG_NO_SPACE}_Backend


}

