<?php get_header();
/*
 Template Name: Account Page
 */
if(	isset($_POST['userID'])){
	$user_id=$wpdb->escape(trim($_POST['userID']));
	$email = $wpdb->escape(trim($_POST['userEmail']));
    $newpassword = $wpdb->escape(trim($_POST['userNewPassword'])); 
    $repeatpassword = $wpdb->escape(trim($_POST['userRepeatPassword'])); 
    if($email == ''){
    	$message="Email empty";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	$message="Invalid Email";
    }
    else if((! $newpassword=''|!$repeatpassword='')&&( $newpassword!=$repeatpassword))
    {
    	$message="Password Invalid";
    }
    else{
    	$user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $email ) );
    	if(is_wp_error( $user_id ) ){
    		$message="Error Update";
    	}
    	else{
    		$message="Success";
    	}
    }
}
?>
 	<div class="container body-content">
		<div class="row">
				<div class="col-md-3  visible-md visible-lg left-column">
					<ul class="nav">
						<li class="active"></li>
						<li></li>
					</ul>
				</div>
				<div class="col-md-9 right-column">
					<div class="page-content">
						<?php global $current_user; $user_infor=wp_get_current_user();/* die(var_dump($user_infor));*/?>
						<h1><?php _e('Edit Profile') ?></h1>
						<?php if(isset($message)) echo $message;?>
						<hr>
						<form class="user-infor" method="POST">
									<input name="userID" type="hidden" value="<?php echo $user_infor->ID; ?>">
								<div>
									<label><?php _e('User Name') ?></label>
									<input class="form-control" name="userName" type="text" disabled="disabled" value="<?php echo $user_infor->user_login ; ?>">
								</div>
								<tr>							
									<label><?php _e('User Email') ?></label>
									<input class="form-control" name="userEmail" type="text" value="<?php echo $user_infor->user_email ; ?>" required="">
								</tr>
								<tr>							
									<label><?php _e('User First Name') ?></label>
									<input class="form-control" name="userFirstname" type="text" value="<?php echo $user_infor->user_firstname ; ?>">
								</tr>
								<tr>							
									<label><?php _e('User Last Name') ?></label>
									<input class="form-control" name="userLastname" type="text" value="<?php echo $user_infor->user_lastname ; ?>">
								</tr>
								<tr>							
									<label><?php _e('New Password') ?></label>
									<input class="form-control" name="userNewPassword" type="text">
								</tr>
								<tr>							
									<label><?php _e('Repeat New Password') ?></label>
									<input class="form-control" name="userRepeatPassword" type="text">
								</tr>
							<input class="btn btn-primary" type="submit" value="<?php _e('Update Profile')?>">
						</form>
					</div>
			</div>
		</div>
	</div><!-- END CONTENT -->
<?php get_footer(); ?>