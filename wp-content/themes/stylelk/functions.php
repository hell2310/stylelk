<?php define( 'THEME_URL', get_stylesheet_directory() );
		define( 'CORE', THEME_URL . '/core' );
		define( 'CSS', THEME_URL . '/css' );
		define( 'JS', THEME_URL . '/js' );
		define( 'FONTS', THEME_URL . '/fonts' );
		define( 'IMAGES', THEME_URL . '/images' );
		define( 'HOME', esc_url( home_url()) );
	require_once( CORE . '/init.php' );

	/* ADD $content_width
	*/
	if ( ! isset( $content_width ) ) {	
	    $content_width = 620;
	 }

	/*ADD THEME SET UP */
	if(!function_exists('stylelk_theme_setup')){
	   		function stylelk_theme_setup(){
				/*add function thumbnail*/
				add_theme_support( 'post-thumbnails' );
				/* Auto add <title>*/
				add_theme_support( 'title-tag' );
				/* Add theme support menu*/
				add_theme_support( 'menus' );
				/*Add theme suport widget*/
				add_theme_support('widgets');
				/*Add theme suport logo*/
				add_theme_support('logo');
				add_theme_support('sharing');
				/*Add them support woocommerce*/
				add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
				add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );
			}
	}
	add_action('init','stylelk_theme_setup');
	/*register style*/
	if(!function_exists('stylelk_register_style')){
	function stylelk_register_style()
	{
		wp_register_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', 'all' );
		wp_register_style( 'fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css', 'all' );
		wp_register_style( 'bootstrap-rtl-style', get_template_directory_uri() . '/css/bootstrap-rtl.min.css', 'all' );
		wp_register_style( 'main-style', get_template_directory_uri() . '/style.css', 'all' );
		wp_register_script('jquery-script',get_template_directory_uri() . '/js/jquery.2.1.4.js', 'all' );
		wp_register_script('bootstrap-min-script',get_template_directory_uri() . '/js/bootstrap.min.js', 'all' );
		wp_register_script('effect-script',get_template_directory_uri() . '/js/effect.js', 'all' );
		wp_register_script('getpost-script',get_template_directory_uri() . '/js/getpost.js', 'all' );
		wp_enqueue_style('bootstrap-style');
		wp_enqueue_style('fontawesome-style');
		wp_enqueue_style('bootstrap-rtl-style');
		wp_enqueue_style('main-style');
		wp_enqueue_script('jquery-script');
		wp_enqueue_script('bootstrap-min-script');
		wp_enqueue_script('effect-script');
		wp_enqueue_script('getpost-script');
		wp_dequeue_style('open-sans-css');
 		wp_deregister_style('open-sans-css');

	}
	add_action('wp_enqueue_scripts','stylelk_register_style');
	}
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url('admin-ajax.php' ) ) );

/*ADD AJAXURL VALUE */
	
	function embed_ajax() {
	?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var post_addr=0;
	var cat_id='';
	var tag_slug_name='';
	<?php if(is_home()):?> post_addr=1; 
	<?php elseif(is_category()):?> post_addr=3; cat_id=<?php echo $_REQUEST['cat']; ?>;
	<?php elseif(is_single()):?> post_addr=4; 
	<?php elseif(is_tag()):?> post_addr=5; tag_slug_name=<?php echo $_REQUEST['tag']; ?>;
	<?php endif;?>
	</script>
	<?php
	}
	add_action('wp_head','embed_ajax');
/*	ADD LOGO SECTION */
	function stylelk_theme_customizer( $wp_customize ) {
		$wp_customize->add_section( 'stylelk_logo_section' , array(
	    	'title'       => __( 'Logo', 'modello' ),
	    	'priority'    => 30,
	    	'description' => 'Upload a logo to Stylek site!',
		) );
		$wp_customize->add_setting( 'stylelk_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'modello_logo', array(
	    	'label'    => __( 'Logo', 'stylelk' ),
	    	'section'  => 'stylelk_logo_section',
	    	'settings' => 'stylelk_logo',
		) ) );
	}
	add_action( 'customize_register', 'stylelk_theme_customizer' );
/*	REMOVE ADMIN BAR */
	function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
	}
	add_action('get_header', 'remove_admin_login_header');
	/*ADD WIDGETS*/
	function stylelk_register_widget(){
		register_sidebar(array( 
		    'name' => __('FIXER MENU'),
		    'id' => 'header-right',
		    'description' => __('Area display cart and checkout button'),
		    'before_widget'=>'<li class="widget woocommerce widget_shopping_cart headercart-menu">',
		    'after_widget'=>'</li>'
		));
	}
	add_action('widgets_init','stylelk_register_widget');
/*   ADD MENU AREA   */
	function register_my_menus() {
  	register_nav_menus(
    	array(
    	'user_menu'=>__('User'),
    	'short_categories_menu'=>__('Short Categories Menu'),
    	'categories_menu'=>__('Categories Menu'),
    	'pageinfor_menu'=>__('Page Infor Menu'),
    	'pageinfor_menu_1'=>__('Page Infor Menu 1'),
    	'pageinfor_menu_2'=>__('Page Infor Menu 2'),
    	'accountpage_menu'=>__('Account Page'),
    	)
  	);
	}
	add_action( 'init', 'register_my_menus' );

/*    FUNCTION GET VIEWS POST  */
	function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
	}
	function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
	}
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

/*FUNCTION RETURN HTML WHEN USE AJAX LOAMORE*/
	function popularPosts($curentpost,$numpost) {
	    global $wpdb;
	    global $post;
	    $posts = $wpdb->get_results("SELECT $wpdb->posts.ID,$wpdb->posts.post_title,$wpdb->posts.comment_count,$wpdb->posts.post_date FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id=$wpdb->posts.ID WHERE $wpdb->postmeta.meta_key='post_views_count' AND $wpdb->posts.post_type='post'  ORDER BY $wpdb->postmeta.meta_value+0  DESC LIMIT $curentpost, $numpost");	  
	   	if ( $posts) : 
			foreach ($posts as $post):
				setup_postdata($post);
				$html.=get_template_part('content');
			endforeach;
				wp_reset_postdata();
		else:
			$html='';
		endif;
		return $html;
	}
/*LATEST STORY*/
	function latestPosts($curentpost,$numpost){
		global $wpdb;
		global $post;
		$posts = $wpdb->get_results("SELECT ID,post_title,comment_count,post_date FROM $wpdb->posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC LIMIT $curentpost, $numpost");	  
		if ( $posts) : 
			foreach ($posts as $post):
				setup_postdata($post);
				$html.=get_template_part('content');
			endforeach;
				wp_reset_postdata();
		else:
			$html='';
		endif;
		return $html;
	}
/*REQUEST STORY FOLLOW CATEGORY*/
	function categoryPosts($curentpost,$numpost,$categoy_id){
		global $wpdb;
		global $post;
		$args=array('cat'=>$categoy_id);
		$the_query=new WP_Query($args);
		if ($the_query->have_posts()) : 
			while ($the_query->have_posts()): $the_query->the_post();
				setup_postdata($post);
				$html.=get_template_part('content');
			endwhile;
				wp_reset_postdata();
		else:
			$html='';
		endif;
		return $html;
	}
/*REQUEST STORY FOLLOW TAG*/
function tagPosts($curentpost,$numpost,$tag_slug){
		global $wpdb;
		global $post;
		$args=array('tag'=>$tag_slug);
		$the_query=new WP_Query($args);
		if ($the_query->have_posts()) : 
			while ($the_query->have_posts()): $the_query->the_post();
				setup_postdata($post);
				$html.=get_template_part('content');
			endwhile;
				wp_reset_postdata();
		else:
			$html='';
		endif;
		return $html;
	}
	function stylelk_request_postpage(){
		$args=array( 'post_type' => 'post','posts_per_page'=>'5','orderby'=>'rand');
		$the_query = new WP_Query( $args );
		if($the_query->have_posts()):
			while ($the_query->have_posts()):$the_query->the_post();
				$html.=get_template_part( 'content','single' );
			endwhile;
		endif;
		return $html;
	}
/*	LOAD MORE DATA REQUEST*/
	function load_data_request(){
		if(isset($_REQUEST['currentpost'])){
			$currentpost=$_REQUEST['currentpost'];
			$numpost=$_REQUEST['numpost'];
			$post_addr=$_REQUEST['post_addr'];
			$categoy_id=$_REQUEST['categoy_id'];		
			if($post_addr==1):
				$result = latestPosts($currentpost,$numpost);
			elseif ($post_addr==2):
				$result = popularPosts($currentpost,$numpost);
			elseif ($post_addr==3):
				$result = tagPosts($currentpost,$numpost,$categoy_id);
			elseif($post_addr==4):
				$result=stylelk_request_postpage();
			elseif($_post_addr==5):
				categoryPosts($curentpost,$numpost,$tag_slug);
			endif;
			echo $result;
			die();
		}		
	}
	add_action( 'wp_ajax_load_data_request', 'load_data_request' );
	add_action( 'wp_ajax_nopriv_load_data_request', 'load_data_request' );
/*GET SOCIAL SHARE COUNT*/
function getTwitterShareCount($urlCurrentPage) {
    $htmlTwitterShareDetails = wp_remote_get('http://urls.api.twitter.com/1/urls/count.json?url='.$urlCurrentPage, array('timeout' => 6));
    if (is_wp_error($htmlTwitterShareDetails)) {
        return 0;
    }
    $arrTwitterShareDetails = json_decode($htmlTwitterShareDetails['body'], true);
    $intTwitterShareCount =  $arrTwitterShareDetails['count'];
    return ($intTwitterShareCount) ? $intTwitterShareCount : '0';
	}
function getFacebookShareCount($urlCurrentPage) {
    $htmlFacebookShareDetails = wp_remote_get('http://graph.facebook.com/'.$urlCurrentPage, array('timeout' => 1));
    if (is_wp_error($htmlFacebookShareDetails)) {
        return 0;
    }
    $arrFacebookShareDetails = json_decode($htmlFacebookShareDetails['body'], true);
    $intFacebookShareCount =  (isset($arrFacebookShareDetails['shares']) ? $arrFacebookShareDetails['shares'] : 0);
    return ($intFacebookShareCount) ? $intFacebookShareCount : '0';
}
function getRedditShareCount($urlCurrentPage) {
    $htmlRedditShareDetails = wp_remote_get('http://reddit.com/api/info.json?url='.$urlCurrentPage, array('timeout' => 1));
    if (is_wp_error($htmlRedditShareDetails)) {
        return 0;
    }
    $arrRedditShareDetails = json_decode($htmlRedditShareDetails['body'], true);
    $intRedditShareCount =  (isset($arrRedditShareDetails['count']) ? $arrRedditShareDetails['count'] : 0);
    return ($intRedditShareCount) ? $intRedditShareCount : '0';
}
function getPinterestShareCount($urlCurrentPage) {
    $htmlPinterestShareDetails = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?callback=&url='.$urlCurrentPage, array('timeout' => 6));
    if (is_wp_error($htmlPinterestShareDetails)) {
        return 0;
    }
    $arrPinterestShareDetails = json_decode($htmlPinterestShareDetails['body'], true);
    $intPinterestShareCount =  (isset($arrPinterestShareDetails['count']) ? $arrPinterestShareDetails['count'] : 0);
    return ($intPinterestShareCount) ? $intPinterestShareCount : '0';
}



/*LOGIN PAGE*/
function my_login_redirect( $redirect_to, $request, $user ) {
        global $user;
        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
                if ( in_array( 'administrator', $user->roles ) ) {
                        return admin_url();
                } else {
                        return home_url();
                }
        } else {
                return $redirect_to;
        }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function redirect_login_page() {
    $login_page  = home_url( '/?page_id=9' );
    $page_viewed = basename($_SERVER['REQUEST_URI']); 
 
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');
function login_failed() {
    $login_page  = home_url( '/?page_id=9' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' ); 
 
function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/?page_id=9' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);
/*
REGISTER PAGE*/
add_action( 'register_form', 'myplugin_add_registration_fields' );
function myplugin_add_registration_fields() {

    //Get and set any values already sent
    $user_extra = ( isset( $_POST['user_extra'] ) ) ? $_POST['user_extra'] : '';
    ?>

    <p>
        <label for="user_extra"><?php _e( 'Extra Field', 'myplugin_textdomain' ) ?><br />
            <input type="text" name="user_extra" id="user_extra" class="input" value="<?php echo esc_attr( stripslashes( $user_extra ) ); ?>" size="25" /></label>
    </p>

    <?php
}
?>