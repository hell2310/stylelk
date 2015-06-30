<?php
require_once( dirname( __FILE__ ) . '/mm_html.php' );


class MmAdminPage extends MmHtml {

	protected $helptabs 	= array();
	protected $helpsidebar	= '';

	protected $tabs = array();
	protected $tab 	= '';

	
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_css_js' ) );

		add_filter( 'contextual_help', array( $this, 'plugin_help' ), 10, 3 );
		
		if ( isset( $_POST[ 'mm-tab' ] ) )
		{
			$_SESSION[ 'mm-tab' ] = $_POST[ 'mm-tab' ];
		}
		if ( isset( $_POST[ 'submit' ] ) )
		{
			$_SESSION[ 'submit' ] = $_POST[ 'submit' ];
		}
	}

	protected function get_current_tab()
	{
		if ( isset( $_SESSION[ 'mm-tab' ] ) )
		{
			$tab = $_SESSION[ 'mm-tab' ];
			unset( $_SESSION[ 'mm-tab' ] );
		}
		else
		{
			foreach( $this->tabs as $tab => $text )
			{
				break;
			}
		}
		$this->tab = $tab;
	}
	

	public function admin_css_js( $screen_id )
	{
		if ( $screen_id == $this->screen_id )
		{
			wp_enqueue_style( 'admin-css', plugins_url( '/css/admin.css', dirname( __FILE__ ) ) );
			wp_enqueue_script( 'admin-js' , plugins_url( '/js/admin.js', dirname( __FILE__ ) ), array( 'jquery' ) );
		}
	}

	public function plugin_help( $contextual_help, $screen_id, $screen )
	{
		if ( $screen_id == $this->screen_id )
		{
			if ( count( $this->helptabs ) > 0 )
			{
	            foreach ( $this->helptabs as $tab )
	            {
	                $screen->add_help_tab( $tab );
	            }
	            if ( $this->helpsidebar )
	            {
	            	$screen->set_help_sidebar( $this->helpsidebar );
	            }
			}
		}
		return '';
	}
}