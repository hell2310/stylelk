 <?php 
 /*
 Template Name: Login Facebook
 */
 	$app_id = "1603443363261032";
    $app_secret = "d5910fe02c7088abe0b9d2cbdcb44c02";
    $redirect_uri = urlencode(HOME."/login-facebook");    
    // Get code value
    $code = $_GET['code'];
    // Get access token info
    $facebook_access_token_uri = "https://graph.facebook.com/oauth/access_token?client_id=$app_id&redirect_uri=$redirect_uri&client_secret=$app_secret&code=$code";    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $facebook_access_token_uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    $response = curl_exec($ch); 
    curl_close($ch);

    // Get access token
    $access_token = str_replace('access_token=', '', explode("&", $response)[0]);
    // Get user infomation
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=$access_token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    

    $response = curl_exec($ch); 
    curl_close($ch);
    $user = json_decode($response);
    //check user exits in users database
	$user_infor = get_user_by( 'email',  $user->email ); 
	if($user_infor) {
    wp_set_current_user( $user_infor->ID, $user_infor->user_login );
    wp_set_auth_cookie( $user_infor->ID );
    do_action( 'wp_login', $user_infor->user_login );
	}
	//if not exits, insert user to users database
	else{
	$user_id = wp_insert_user( array ('user_login' => apply_filters('pre_user_user_login', $user->email), 'user_email' => apply_filters('pre_user_user_email', $user->email),'first_name'=> $user->first_name,'last_name'=> $user->last_name , 'role' => 'subscriber' ) );
	if( is_wp_error($user_id) ) {
        die(is_wp_error($user_id));
    } 
    else {
	$user_infor = get_user_by( 'email',  $user->email ); 
/*	die(var_dump($user_id));*/
	wp_set_current_user( $user_infor->ID, $user_infor->user_login );
    wp_set_auth_cookie( $user_infor->ID );
    do_action( 'wp_login', $user_infor->user_login);
    $success="Success";
	}
	}
?>
	<html>
	<head>
		<title></title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	</head>
	<body>
	<script type="text/javascript">
	var status;
	status="<?php echo $success;?>";
    if(!status==null)
    	alert("error");
    else
    window.close();
    </script>
	</body>
	</html>
