<?php define( 'THEME_URL', get_stylesheet_directory() );
		define( 'CORE', THEME_URL . '/core' );
		define( 'CSS', THEME_URL . '/css' );
		define( 'JS', THEME_URL . '/js' );
		define( 'FONTS', THEME_URL . '/fonts' );
		define( 'IMAGES', THEME_URL . '/images' );
		define( 'HOME', esc_url( home_url()) );
	require_once( CORE . '/init.php' );
	/*ADD THEME SET UP */
	if(!function_exists('stylelk_theme_setup')){
	   		function stylelk_theme_setup(){
				add_theme_support( 'post-thumbnails' );
				add_theme_support( 'title-tag' );
				add_theme_support( 'menus' );
				add_theme_support('widgets');
				add_theme_support('logo');
				add_theme_support('sharing');
				add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
				add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );
			}
	}
	add_action('init','stylelk_theme_setup');
	/*register style*/
	function viewport_meta() { 
    ?>	<meta charset="<?php bloginfo( 'charset' ); ?>">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
      	<meta name="apple-mobile-web-app-capable" content="yes">
      	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
      	<link href='http://fonts.googleapis.com/css?family=Montserrat:700,400' rel='stylesheet' type='text/css'>
      	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
      	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri();?>/images/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri();?>/images/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri();?>/images/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri();?>/images/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri();?>/images/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri();?>/images/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri();?>/images/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri();?>/images/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/images/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192" href="<?php echo get_template_directory_uri();?>/images/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/images/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri();?>/images/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/images/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri();?>/images/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri();?>/images/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<script>
		window.fbAsyncInit = function() {
		FB.init({
		appId : '1603443363261032',
		xfbml : true,
		version : 'v2.3'
		});
		};

		(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
    <?php
	}
	add_action('wp_head', 'viewport_meta',1);
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
/*ADD AJAXURL VALUE */
	wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url('admin-ajax.php' ) ) );
	function embed_ajax() {
	?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var post_addr=0;
	var cat_id='';
	var tag_slug_name='';
	<?php if(is_home()):?> post_addr=1; 
	<?php elseif(is_category()):?> post_addr=3; cat_id=<?php echo get_cat_id( single_cat_title("",false) ); ?>;
	<?php elseif(is_single()):?> post_addr=4; post_id=<?php echo get_the_ID()?>;
	<?php elseif(is_tag()):?> post_addr=5; tag_slug_name=<?php echo single_tag_title( '', false ); ?>;
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
/*	function remove_admin_login_header() {
	remove_action('wp_head', '_admin_bar_bump_cb');
	}
	add_action('get_header', 'remove_admin_login_header');*/
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
    	'short_categories_menu_top'=>('Short Categories Menu in Top Menu'),
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
				$html.=get_template_part('content','short');
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
				$html.=get_template_part('content','short');
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
		$args=array('cat'=>$categoy_id,'posts_per_page'=>$numpost,'offset'=>$curentpost);
		$the_query=new WP_Query($args);
		if ($the_query->have_posts()) : 
			while ($the_query->have_posts()): $the_query->the_post();
				setup_postdata($post);
				$html.=get_template_part('content','short');
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
		$args=array('tag'=>$tag_slug,'posts_per_page'=>$numpost,'offset'=>$curentpost);
		$the_query=new WP_Query($args);
		if ($the_query->have_posts()) : 
			while ($the_query->have_posts()): $the_query->the_post();
				setup_postdata($post);
				$html.=get_template_part('content','short');
			endwhile;
				wp_reset_postdata();
		else:
			$html='';
		endif;
		return $html;
	}
	function stylelk_request_postpage($curentpost,$numpost,$post_id){
		$post_id_array=array($post_id);
		$args=array( 'post_type' => 'post','offset'=>$curentpost,'posts_per_page'=>$numpost,'post__not_in'=>$post_id_array);
		$the_query = new WP_Query( $args );
		if($the_query->have_posts()):
			while ($the_query->have_posts()):$the_query->the_post();
				$html.=get_template_part( 'content',get_post_format());
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
			$post_id=$_REQUEST['get_post_id'];
			if($post_addr==1):
				$result = latestPosts($currentpost,$numpost);
			elseif ($post_addr==2):
				$result = popularPosts($currentpost,$numpost);
			elseif ($post_addr==3):
				$result = tagPosts($currentpost,$numpost,$categoy_id);
			elseif($post_addr==4):
				$result=stylelk_request_postpage($curentpost,$numpost,$post_id);
			elseif($_post_addr==5):
				categoryPosts($curentpost,$numpost,$tag_slug);
			endif;
			echo $result;
			die();
		}		
	}
	add_action( 'wp_ajax_load_data_request', 'load_data_request' );
	add_action( 'wp_ajax_nopriv_load_data_request', 'load_data_request' );
	function delete_account(){
		if(isset($_REQUEST['user_id'])){
		$result=wp_delete_user($_REQUEST['user_id'] );
		return $result;
		die();
		}
	}
	add_action( 'wp_ajax_delete_account', 'delete_account' );
	add_action( 'wp_ajax_nopriv_delete_account', 'delete_account' );
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
    $login_page  = HOME.'/login';
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' ); 
 
function verify_username_password( $user, $username, $password ) {
    $login_page  = HOME.'/login';
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

function modify_contact_methods($profile_fields) {
	$profile_fields['user_location'] = '';
	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

function get_location(){
	$location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['HTTP_X_FORWARDED_FOR']);
	$location =explode(',', $location);
	$location=explode(':',$location[2]);
	$location=str_replace('"','', $location[1]);
	return $location;
}
/*ADD REDIRECT PAGE*/
function app_output_buffer() {
    ob_start();
} 
add_action('init', 'app_output_buffer');
function redirect_to_page($url=HOME){
	wp_redirect($url);
	exit;
}

function comment_list_theme( $comment,$args,$depth) {
    $GLOBALS['comment'] = $comment;
    ?>
   <article class="comment-body">
 	<div class="comment-author vcard"><?php comment_author(); ?></div><!-- .comment-author -->
 	<div class="comment-content"><?php comment_text();?></div><!-- .comment-content -->
 	<?php comment_date(); ?>
 	<div class="reply"><a href="<?php echo comment_reply_link();?>"><?php _e('Reply'); ?></div>
 
	</article><!-- .comment-body -->
    <?php
}

?>