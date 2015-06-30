<?php
/**
 * Plugin Name: mmenu - App look-alike menus for WordPress
 * Plugin URI: http://mmenu.frebsite.nl/wordpress-plugin.php
 * Description: The best WordPress plugin for app look-alike off-canvas mega menus with sliding submenus for your website.
 * Version: 1.0.1
 * Author: Fred Heusschen
 * Author URI: http://www.frebsite.nl
 */


require_once( dirname( __FILE__ ) . '/php/mm_adminpage.php' );


class MmenuAdminPage extends MmAdminPage {
	
	protected $version 		= '1.0.1';
	protected $screen_id 	= 'settings_page_mmenu';

	protected $tabs = array(
		'features'	=> 'Features',
		'looks' 	=> 'Look and feel',
		'usage'		=> 'Usage'//,
//		'preview'	=> 'Preview'
	);
	protected $options = array(
		'mm_version',
		'mm_features',
		'mm_looks',
		'mm_usage'
	);

	protected $helptabs = array(
		array(
			'id'        => 'mmenu-help-menus',
			'title'     => 'Creating Menus',
			'content'   => '<p>The mmenu plugin uses default menus (see "Appearances -> Menus" within your dashboard). After you\'ve created a new menu, added your pages and hit the "Create Menu" button, you will need to assign the menu to the "App look-alike menu" location.</p>
				<p>If you don\'t know how to create menus, see the <a target="_blank" href="http://codex.wordpress.org/WordPress_Menu_User_Guide">WordPress Menu User Guide</a>.</p>'
		),
		array(
			'id'        => 'mmenu-help-explanation',
			'title'     => 'Options explanation',
			'content'   => '<p>If you need more information about an option, simply click the <span class="dashicons dashicons-editor-help"></span> icon next to it and a detailed explanation of what the options does will appear.</p>'
		),
		array(
			'id'        => 'mmenu-help-fixed',
			'title'     => 'Fixed elements',
			'content'   => '<p>If you have a fixed element on your webpage that doesn\'t behave how you\'d expect when the menu is opened, try adding the classname "Fixed" to it.</p>'
		),
		array(
			'id'        => 'mmenu-help-hamburger',
			'title'     => 'Hamburger icon',
			'content'   => '<p>To open the menu on your webpage, you need to add an anchor in your HTML that targets the menu. Like this: <code>&lt;a href="#<span id="hamburger-icon-href">mmenu</span>"&gt;open menu&lt;/a&gt;</code>.</p>
				<p>If you want it to look like a hamburger icon, you\'ll need to <a target="_blank" href="http://css-tricks.com/three-line-menu-navicon">do that yourself</a>.</p>'
		)
    );

	protected $helpsidebar = '
		<p><strong>jQuery.mmenu</strong></p>
		<p>For more info about the jQuery.mmenu plugin, please visit <a target="_blank" href="http://mmenu.frebsite.nl">mmenu.frebsite.nl</a>.</p>';




	public function __construct()
	{
		parent::__construct();
		add_action( 'admin_init', array( $this, 'register_menu' ) );
	}


	/*
		The menu item + page
	*/
	public function add_menu_page()
	{
		add_options_page( 
			'mmenu',
			'mmenu',
			'manage_options',
			'mmenu',
			array( $this, 'create_admin_page' )//,
//			'dashicons-menu'
		);
	}
	public function create_admin_page()
	{
	    if ( !current_user_can( 'manage_options' ) )
	    {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	    }
	    
		$this->get_current_tab();
		if ( isset( $_SESSION[ 'submit' ] ) )
		{
			unset( $_SESSION[ 'submit' ] );
			$this->saveFrontend();
		}


		echo '
		<script type="text/javascript">var home_url = "' . get_home_url(). '";</script>
		<div class="wrap">';

		$this->echo_title( '<span>mmenu</span> App look-alike menu for WordPress <small>' .
			$this->version . '</small>', 'mmenu' );
		$this->echo_nav_tabs();

		$this->echo_form_opener( 'mmenu-settings' );

		$version = get_option( 'mm_version' );

		echo '
			<input name="mm_version" value="' . ( $version + 1 ) . '" type="hidden" />';



		/*
			Tab features
		*/

		$mm_features = get_option( 'mm_features', array() );
		$this->echo_tab_opener( 'features' );

		//	Introduction
		$this->echo_section_opener();
		echo '
			<p class="intro">Lets play with some of the features and create an unique menu.<br />
				Simply check the feature you want to use and edit its options.</p>';

		$this->echo_section_closer();

		//	verticalSubmenus option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Use vertical submenus?',
			$this->html_checkbox( array( $mm_features, 'mm_features', 'verticalsubmenus' ) ) .
				'<label for="mm_features_verticalsubmenus">Yes please!</label>',
			null,
			true
		);

		//	verticalSubmenus explanation
		$this->echo_form_table_row(
			'',
			'<p>With the <code>vertical submenus</code> feature enabled, submenus will expand below their parent item.
				With the feature disabled, submenus will come sliding in from the right.</p>
				<p>To expand a single submenu below its parent item, add the class "Vertical" to it.</p>',
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	counters option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Add counters for submenus?',
			$this->html_checkbox( array( $mm_features, 'mm_features', 'counters' ) ) .
				'<label for="mm_features_counters">Yes please!</label>',
			null,
			true
		);

		//	counters explanation
		$this->echo_form_table_row(
			'',
			'<p>With the <code>counters</code> feature enabled, links that open a submenu will get a counter that displays the number of menu items in the submenu.</p>' . 
				$this->moreInfoLink( 'documentation/addons/counters.html' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	navbars header and footer
		foreach( array( 'header', 'footer' ) as $nav )
		{

			//	nav option
			$this->echo_section_opener();
			$this->echo_form_table_opener();
			$this->echo_form_table_row(
				'Add a fixed ' . $nav . '?',
				$this->html_checkbox( array( $mm_features, 'mm_features', $nav ) ) .
					'<label for="mm_features_' . $nav . '">Yes please!</label>',
				null,
				true
			);

			//	nav explanation
			$this->echo_form_table_row(
				'',
				'<p>With the <code>' . $nav . '</code> feature enabled, a fixed ' . $nav . ' is ' . ( $nav == 'header' ? 'pre' : 'ap' ) . 'pended to the menu.</p>' . 
					$this->moreInfoLink( 'documentation/addons/navbars.html' ),
				'explanation'
			);

			//	nav back option
			$this->echo_form_table_row(
				'',
				$this->html_checkbox( array( $mm_features, 'mm_features', $nav . 'back' ) ) . 
					'<label for="mm_features_' . $nav . 'back">In submenus, add a button that links back to the parent menu.</label>',
				'suboptions'
			);

			//	header title option
			$this->echo_form_table_row(
				'',
				$this->html_checkbox( array( $mm_features, 'mm_features', $nav . 'title' ) ) . 
					'<label for="mm_features_' . $nav . 'title">Add a title ' . ( $nav == 'header' ? 'above' : 'below' ) . ' the menu.</label>',
				'suboptions parentsuboption'
			);

			//	header titletext option
			$this->echo_form_table_row(
				'',
				'<p>Specify the title ' . ( $nav == 'header' ? 'above' : 'below' ) . ' the main menu:</p>' .
					$this->html_input( array( $mm_features, 'mm_features', $nav . 'titletext' ), 'Menu' ),
				'suboptions subsuboption'
			);

			//	header custom buttons option
			$this->echo_form_table_row(
				'',
				$this->html_checkbox( array( $mm_features, 'mm_features', $nav . 'custom' ) ) . 
					'<label for="mm_features_' . $nav . 'custom">Add custom buttons.</label>',
				'suboptions parentsuboption'
			);
			$this->echo_form_table_row(
				'',
				'<p>Specify a jQuery selector that targets (the parent element of) a single or multiple anchors:</p>' . 
					'<p>' . $this->html_input( array( $mm_features, 'mm_features', $nav . 'customselector' ), 'ul.' . $nav . '-buttons' ) . '</p><br />' .
					'<p>Or type the HTML for the anchors manually:</p>' .
					$this->html_input( array( $mm_features, 'mm_features', $nav . 'customhtml' ), '&lt;a href=&quot;url&quot; class=&quot;classname&quot;&gt;text&lt;/a&gt;' ),
				'suboptions subsuboption'
			);

			//	header close option
			$this->echo_form_table_row(
				'',
				$this->html_checkbox( array( $mm_features, 'mm_features', $nav . 'close' ) ) .
					'<label for="mm_features_' . $nav . 'close">Add a button that closes the menu.</label>',
				'suboptions'
			);

			$this->echo_form_table_closer();
			$this->echo_section_closer();
		}

		//	searchfield option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Add a fixed searchfield?',
			$this->html_checkbox( array( $mm_features, 'mm_features', 'searchfield' ) ) .
				'<label for="mm_features_searchfield">Yes please!</label>',
			null,
			true
		);

		//	searchfield explanation
		$this->echo_form_table_row(
			'',
			'<p>With the <code>searchfield</code> feature enabled, a searchfield is prepended to the menu, enabling your visitors to search through the menu items.</p>' . 
				$this->moreInfoLink( 'documentation/addons/searchfield.html' ),
			'explanation'
		);

		//	searchfield placeholder option
		$this->echo_form_table_row(
			'',
			'<p>Specify the placeholder text for the searchfield:</p>' .
				$this->html_input( array( $mm_features,'mm_features', 'searchfieldplaceholder' ), 'Search' ),
			'suboptions'
		);

		//	searchfield no results option
		$this->echo_form_table_row(
			'',
			'<p>Specify the text (or HTML) to show when no results are found:</p>' .
				$this->html_input( array( $mm_features, 'mm_features', 'searchfieldnoresults' ), 'No results found.' ),
			'suboptions'
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();

		$this->echo_tab_closer();



		/*
			Tab look and feel
		*/

		$mm_looks = get_option( 'mm_looks', array() );
		$this->echo_tab_opener( 'looks' );

		//	Introduction
		$this->echo_section_opener();
		echo '
			<p class="intro">Lets see how we can style your menu so it has the right look and feel.<br />
				After that, you\'re all done and you can hit the "Save changes" button.</p>';

		$this->echo_section_closer();

		//	position option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Position the menu',
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'zposition' ),
				array(
					'' 			=> 'Behind the page',
					'next'		=> 'Next to the page',
					'front'		=> 'In front of the page'
				)
			) . '<br />' .
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'position' ),
				array(
					''			=> 'At the left',
					'right'		=> 'At the right',
					'top'		=> 'At the top',
					'bottom'	=> 'At the bottom'
				)
			),
			null,
			true
		);

		//	position explanation
		$this->echo_form_table_row(
			'',
			'<p>By default, the menu will always be positioned behind the page and slide the page out to the right. To change this behavior, select how you want your menu to be positioned.</p>
				<p>Note that a menu can only be positioned <em>at the top</em> or <em>at the bottom</em> when it is <em>in front of the page</em>.</p>' . 
				$this->moreInfoLink( 'documentation/extensions/positioning.html' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	themes option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Select a color theme',
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'theme' ),
				array(
					''		=> 'Light',
					'dark' 	=> 'Dark',
					'white'	=> 'White',
					'black'	=> 'Black'
				)
			),
			null,
			true
		);

		//	themes explanation
		$this->echo_form_table_row(
			'',
			'<p>The default color theme for the menu is light gray (#f3f3f3). To apply a different theme to the menu, select a color theme for your menu.</p>
				<p>the <em>Light</em> and <em>Dark</em> themes work great if you want a custom background color:</p>
				<ul>
					<li>The <em>Licht</em> theme has a light gray background and uses semi-transparent black and white shades.</li>
					<li>The <em>Dark</em> theme has a dark gray background and uses semi-transparent black and white shades.</li>
					<li>The <em>Black</em> theme has a black background and uses semi-transparent white shades.</li>
					<li>The <em>White</em> theme has a white background and uses semi-transparent black shades.</li>
				</ul>' . 
				$this->moreInfoLink( 'documentation/extensions/themes.html' ),
			'explanation'
		);
		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	background option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Change the background?',
			$this->html_checkbox( array( $mm_looks, 'mm_looks', 'background' ) ) .
				$this->html_input( array( $mm_looks, 'mm_looks', 'backgroundcolor' ), '', '', 'color' ),
			null,
			true
		);

		//	background explanation
		$this->echo_form_table_row(
			'',
			'<p>Because the menu uses semi-transparent black and white shades, the menu is easily themeable. All you need to do, is change the background color of the menu.</p>
				<p>If your menu has a light background color, you\'re probably best off using the <em>Light</em> theme. The <em>Dark</em> theme works best for darker background colors.</p>
				<p>If your browser doesn\'t have a native color picker, specify a valid CSS color in the field below.</p>
				<p>Examples of a valid CSS color:</p>' .
				$this->html_pre( '
#F0FFFF
Azure
rgb(240, 255, 255)' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	borderstyle option
		$this->echo_section_opener();
		$this->echo_form_table_opener();

		$this->echo_form_table_row(
			'Select a border-style',
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'borderstyle' ),
				array(
					''		=> 'Indented with the text',
					'full' 	=> 'Not indented',
					'none'	=> 'No border'
				)
			),
			null,
			true
		);

		//	borderstyle explanation
		$this->echo_form_table_row(
			'',
			'<p>By default, list items in the menu will have an indented border. If you don\'t want the list items to have a border, or if you don\'t want the borders to be indented, select a different border-style.</p>' . 
				$this->moreInfoLink( 'documentation/extensions/border-style.html' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	pageshadow option
		$this->echo_section_opener();
		$this->echo_form_table_opener();

		$this->echo_form_table_row(
			'Add a shadow to the page?',
			$this->html_checkbox( array( $mm_looks, 'mm_looks', 'pageshadow' ) ) .
				'<label for="mm_looks_pageshadow">Yes please!</label>',
			null,
			true
		);

		//	pageshadow explanation
		$this->echo_form_table_row(
			'',
			'<p>With the <code>page shadow</code> feature enabled, the page will have a shadow to emphasize it\'s in front of the menu.</p>' . 
				$this->moreInfoLink( 'documentation/extensions/page-shadow.html' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		//	effects option
		$this->echo_section_opener();
		$this->echo_form_table_opener();

		$this->echo_form_table_row(
			'Select additional effects',
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'effectmenu' ),
				array(
					''				=> 'No effect for the menu',
					'slide-menu' 	=> 'Slide in the menu',
					'zoom-menu'		=> 'Zoom in the menu'
				)
			) . '<br />' .
			$this->html_select(
				array( $mm_looks, 'mm_looks', 'effectpanels' ),
				array(
					''					=> 'Slide out the panels a bit',
					'slide-panels-0' 	=> 'Do not slide out the panels',
					'slide-panels-100'	=> 'Fully slide out the panels',
					'zoom-panels'		=> 'Zoom out the panels'
				)
			),
			null,
			true
		);

		//	effects explanation
		$this->echo_form_table_row(
			'',
			'<p>Apply additional effects to the menu and the panels.</p>' . 
				$this->moreInfoLink( 'documentation/extensions/effects.html' ),
			'explanation'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		$this->echo_tab_closer();



		/*
			Tab usage
		*/

		$mm_usage = get_option( 'mm_usage', array() );
		$this->echo_tab_opener( 'usage' );

		//	Introduction
		$this->echo_section_opener();
		echo '
			<p class="intro">By default, you\'ll need to assign your mobile menu to the "App look-alike" location (in  "Appearances -> Menus").
				This will automatically create the menu. You don\'t need to do any coding.<br />
				If you want to use a different location, use the options below.</p>';

		$this->echo_section_closer();

		//	change option
		$this->echo_section_opener();
		$this->echo_form_table_opener();
		$this->echo_form_table_row(
			'Use a different location?',
			$this->html_checkbox( array( $mm_usage, 'mm_usage', 'change' ) ) .
				'<label for="mm_usage_change">Yes please!</label>'
		);

		//	change selector option
		$this->echo_form_table_row(
			'',
			'<p>Specify a jQuery selector that targets the menu container.<br />
				Most commonly, this would be the <code>container_id</code> specified in the <code>wp_nav_menu</code> function.</p>
				<p>' . $this->html_input( array( $mm_usage,'mm_usage', 'selector' ), '#my-menu' ) . '</p>
				<br />
				<p>For example, the settings below would result in the selector <code>"#my-menu"</code>.</p>
<pre>wp_nav_menu(array( 
   "theme_location" => "primary",
   "menu"           => "Main menu",
   "container"      => "nav",
   "container_id"   => "my-menu"
));</pre>',
			'suboptions'
		);

		//	change clone option
		$this->echo_form_table_row(
			'',
			'<p>Is the menu you\'ve targeted used for desktop websites too? In other words, should it be cloned for mobile websites?.</p>
				<p>' . $this->html_checkbox( array( $mm_usage, 'mm_usage', 'clone' ) ) .
				'<label for="mm_usage_clone">Yes, clone the menu.</label></p>',
			'suboptions'
		);

		$this->echo_form_table_closer();
		$this->echo_section_closer();

		$this->echo_tab_closer();


		/*
			Tab preview
		*/

		// $this->echo_tab_opener( 'preview' );

		// //	Introduction
		// $this->echo_section_opener();
		// echo '
		// 	<p class="intro">Coming soon: a live preview of your menu before saving.</p>';

		// $this->echo_section_closer();

		// $this->echo_tab_closer();



		$this->echo_form_closer();

		echo '
		</div>';
	}
	public function admin_css_js( $screen_id, $that = '' )
	{
		parent::admin_css_js( $screen_id );
	}

	/*
		Regoster the menu
	*/
	public function register_menu()
	{
		register_nav_menus( array( 'mmenu' => 'App look-alike menu' ) );
	}

	/*
		Register and save the options
	*/
	public function register_settings()
	{
		foreach( $this->options as $option )
		{
			register_setting( 'mmenu-settings', $option );
		}
	}
	
	protected function moreInfoLink( $page )
	{
		return '
			<p><a target="_blank" href="http://mmenu.frebsite.nl/' . $page . '">More info &amp; an example &raquo;</a></p>';
	}
	
	protected function saveFrontend()
	{

		//	Get options
		$mm_version = get_option( 'mm_version' );

		$mm_features = get_option( 'mm_features' );
		if ( !isset( $mm_features ) )
		{
			$mm_features = array();
		}
		foreach( 
			array(
				'verticalsubmenus',
				'counters',
				'header',
				'headerback',
				'headertitle',
				'headertitletext',
				'headercustom',
				'headercustomselector',
				'headercustomhtml',
				'headerclose',
				'footer',
				'footerback',
				'footertitle',
				'footertitletext',
				'footercustom',
				'footercustomselector',
				'footercustomhtml',
				'footerclose',
				'searchfield',
				'searchfieldplaceholder',
				'searchfieldnoresults'
			) as $opt
		) {
			if ( !isset( $mm_features[ $opt ] ) )
			{
				$mm_features[ $opt ] = '';
			}
		}

		$mm_looks = get_option( 'mm_looks' );
		if ( !isset( $mm_looks ) )
		{
			$mm_looks = array();
		}
		foreach( 
			array(
				'zposition',
				'position',
				'theme',
				'background',
				'backgroundcolor',
				'borderstyle',
				'pageshadow',
				'effectmenu',
				'effectpanels'
			) as $opt
		) {
			if ( !isset( $mm_looks[ $opt ] ) )
			{
				$mm_looks[ $opt ] = '';
			}
		}

		$mm_usage = get_option( 'mm_usage' );
		if ( !isset( $mm_usage ) )
		{
			$mm_usage = array();
		}
		foreach( 
			array(
				'change',
				'selector',
				'clone'
			) as $opt
		) {
			if ( !isset( $mm_usage[ $opt ] ) )
			{
				$mm_usage[ $opt ] = '';
			}
		}


		//	Create onDocumentReady script
		$styl = array();
		$xtsn = array();
		$opts = array();
		$conf = array();

		$conf[] = 'classNames: {' . "\n      " . 'selected: "current-menu-item"' . "\n    " . '}';
		$conf[] = 'offCanvas: {' . "\n      " . 'pageSelector: "> div:not(#wpadminbar)"' . "\n    " . '}';


		//	Features

		if ( $mm_features[ 'verticalsubmenus' ] )
		{
			$opts[] = 'slidingSubmenus: false';
		}

		if ( $mm_features[ 'counters' ] )
		{
			$opts[] = 'counters: true';
		}

		$navs = array();
		foreach( array( 'header', 'footer' ) as $nav )
		{
			if ( $mm_features[ $nav ] )
			{
				$o = array();
				$c = array();

				$o[] = 'position: "' . ( $nav == 'header' ? 'top' : 'bottom' ) . '"';

				if ( $mm_features[ $nav . 'back' ] )
				{
					$c[] = '"prev"';
				}
				if ( $mm_features[ $nav . 'title' ] )
				{
					$c[] = '"title"';

					if ( $mm_features[ $nav . 'titletext' ] )
					{
						$o[] = 'title: "' . str_replace( '"', '\"', $mm_features[ $nav . 'titletext' ] ) . '"';
					}
				}
				if ( $mm_features[ $nav . 'custom' ] )
				{
					if ( $mm_features[ $nav . 'customselector' ] )
					{
						$c[] = '$("' . $mm_features[ $nav . 'customselector' ] . '")';
					}
					if ( $mm_features[ $nav . 'customhtml' ] )
					{
						$c[] = '"' . str_replace( '"', '\"', $mm_features[ $nav . 'customhtml' ] ) . '"';
					}
				}
				if ( $mm_features[ $nav . 'close' ] )
				{
					$c[] = '"close"';
				}
				$o[] = 'content: [' . implode( ', ', $c ) . ']';
				$navs[] = '{' . "\n      " . implode( ",\n      ", $o ) . "\n    " . '}';
			}
		}
		if ( count( $navs ) > 0 )
		{
			$opts[] = 'navbars: [' . implode( ', ', $navs ) . ']';
		}

		if ( $mm_features[ 'searchfield' ] )
		{
			$o = array();
			$o[] = 'add: true';
			$o[] = 'search: true';
	
			if ( $mm_features[ 'searchfieldplaceholder' ] )
			{
				$o[] = 'placeholder: "' . str_replace( '"', '\"', $mm_features[ 'searchfieldplaceholder' ] ) . '"';
			}
			if ( $mm_features[ 'searchfieldnoresults' ] )
			{
				$o[] = 'noResults: "' . str_replace( '"', '\"', $mm_features[ 'searchfieldnoresults' ] ) . '"';
			}
			$opts[] = 'searchfield: {' . "\n      " . implode( ",\n      ", $o ) . "\n    " . '}';
		}


		//	Look and feel

		if ( $mm_looks[ 'theme' ] )
		{
			$xtsn[] = 'theme-' . $mm_looks[ 'theme' ];
		}

		if ( $mm_looks[ 'background' ] && $mm_looks[ 'backgroundcolor' ] )
		{
			$styl[] = '#mmenu { background-color: ' . $mm_looks[ 'backgroundcolor' ] . ' !important; }';
		}

		if ( $mm_looks[ 'zposition' ] || $mm_looks[ 'position' ] )
		{
			$o = array();
			if ( $mm_looks[ 'zposition' ] )
			{
				$o[] = 'zposition: "' . $mm_looks[ 'zposition' ] . '"';
			}
			if ( $mm_looks[ 'position' ] )
			{
				$o[] = 'position: "' . $mm_looks[ 'position' ] . '"';
			}
			$opts[] = 'offCanvas: {' . "\n      " . implode( ",\n      ", $o ) . "\n    " . '}';
		}

		if ( $mm_looks[ 'borderstyle' ] )
		{
			$xtsn[] = 'border-' . $mm_looks[ 'borderstyle' ];
		}

		if ( $mm_looks[ 'pageshadow' ] )
		{
			$xtsn[] = 'pageshadow';
		}

		if ( $mm_looks[ 'effectmenu' ] )
		{
			$xtsn[] = 'effect-' . $mm_looks[ 'effectmenu' ];
		}
		if ( $mm_looks[ 'effectpanels' ] )
		{
			$xtsn[] = 'effect-' . $mm_looks[ 'effectpanels' ];
		}


		if ( count( $xtsn ) > 0 )
		{
			$opts[] = 'extensions: ["' . implode( '", "', $xtsn ) . '"]';
		}


		//	Usage

		if ( $mm_usage[ 'change' ] && $mm_usage[ 'clone' ] )
		{
			$conf[] = 'clone: true';
		}


		//	Concatenate mmenu JS and CSS from originals
		$dir = dirname( __FILE__ ) . '/';
		$src = $dir . 'dist/';

		$js = array();
		$js[] = @file_get_contents( $src . 'js/jquery.mmenu.min.js' );
		$js[] = @file_get_contents( $src . 'js/addons/jquery.mmenu.fixedelements.min.js' );

		$css = array();
		$css[] = @file_get_contents( $src . 'css/jquery.mmenu.css' );

		//	features
		if ( $mm_features[ 'header' ] || $mm_features[ 'footer' ] )
		{
			$js[] = file_get_contents( $src . 'js/addons/jquery.mmenu.navbars.min.js' );
			$css[] = file_get_contents( $src . 'css/addons/jquery.mmenu.navbars.css' );
		}
		if ( $mm_features[ 'counters' ] )
		{
			$js[] = file_get_contents( $src . 'js/addons/jquery.mmenu.counters.min.js' );
			$css[] = file_get_contents( $src . 'css/addons/jquery.mmenu.counters.css' );
		}
		if ( $mm_features[ 'searchfield' ] )
		{
			$js[] = @file_get_contents( $src . 'js/addons/jquery.mmenu.searchfield.min.js' );
			$css[] = @file_get_contents( $src . 'css/addons/jquery.mmenu.searchfield.css' );
		}

		//	look and feel
		if ( $mm_looks[ 'zposition' ] || $mm_looks[ 'position' ] )
		{
			$css[] = @file_get_contents( $src . 'css/extensions/jquery.mmenu.positioning.css' );
		}
		if ( $mm_looks[ 'theme' ] )
		{
			$css[] = @file_get_contents( $src . 'css/extensions/jquery.mmenu.themes.css' );
		}
		if ( $mm_looks[ 'borderstyle' ] )
		{
			$css[] = @file_get_contents( $src . 'css/extensions/jquery.mmenu.borderstyle.css' );
		}
		if ( $mm_looks[ 'pageshadow' ] )
		{
			$css[] = @file_get_contents( $src . 'css/extensions/jquery.mmenu.pageshadow.css' );
		}
		if ( $mm_looks[ 'effectmenu' ] || $mm_looks[ 'effectpanels' ] )
		{
			$css[] = @file_get_contents( $src . 'css/extensions/jquery.mmenu.effects.css' );
		}

		//	usage
		$selector = '#mmenu';
		if ( $mm_usage[ 'change' ] && $mm_usage[ 'selector' ] )
		{
			$selector = $mm_usage[ 'selector' ];
		}

		$scrp = '

jQuery(document).ready(function($) {
  $("#wpadminbar").addClass( "mm-slideout" );
  $("' . $selector . '").mmenu({
    ' . implode( ",\n    ", $opts ) . '
  }, {
    ' . implode( ",\n    ", $conf ) . '
  });
});';

		$js[] = $scrp;


		if ( count( $styl ) > 0 )
		{
			$css[] = '

' . implode( "\n", $styl );
		}


		@file_put_contents( $dir . 'js/mmenu.js', $js );	
		@file_put_contents( $dir . 'css/mmenu.css', $css );	
	}

}



class MmenuFrontend {

	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_init', array( $this, 'register_menu' ) );
		add_action( 'wp_footer', array( $this, 'init_menu' ) );
	}
	
	public function enqueue_scripts()
	{
	   	wp_enqueue_script( 'mmenu-custom' , plugins_url( '/js/mmenu.js', __FILE__ ), array( 'jquery' ), get_option( 'mm_version' ) );
	   	wp_register_style( 'mmenu-custom', plugins_url( '/css/mmenu.css', __FILE__ ), '', null, 'all' );
	   	wp_enqueue_style( 'mmenu-custom' );
    }

	/*
		Register and init the menu
	*/
	public function register_menu()
	{
		register_nav_menus( array( 'mmenu' => 'App look-alike menu' ) );
	}

	public function init_menu()
	{
		$mm_usage = get_option( 'mm_usage' );
		if ( !isset( $mm_usage ) || !isset( $mm_usage[ 'change' ] ) )
		{
			wp_nav_menu( array( 
				'theme_location' 	=> 'mmenu',
				'menu' 				=> 'App look-alike menu',
				'container' 		=> 'nav',
				'container_id' 		=> 'mmenu'
			) );
		}
	}
}



// Instantiate the class.
if ( is_admin() )
{
	$mmenu_back = new MmenuAdminPage();
}
else
{
	$mmenu_front = new MmenuFrontend();
}