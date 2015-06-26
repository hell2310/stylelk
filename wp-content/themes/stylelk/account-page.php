<?php get_header();
/*
 Template Name: Account Page
 */
if(	isset($_POST['userID'])){
	$user_id=$wpdb->escape(trim($_POST['userID']));
	$email = $wpdb->escape(trim($_POST['userEmail']));
	$displayname = $wpdb->escape(trim($_POST['userDisplayname']));
	$firstname=$wpdb->escape(trim($_POST['userFirstname']));
	$lastname=$wpdb->escape(trim($_POST['userLastname']));
    $newpassword = $wpdb->escape(trim($_POST['userNewPassword'])); 
    $repeatpassword = $wpdb->escape(trim($_POST['userRepeatPassword'])); 
    if($email == ''){
    	$message="Email empty";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	$message="Invalid Email";
    }
    else if((! $newpassword==''|!$repeatpassword=='')&&( $newpassword!=$repeatpassword))
    {
    	$message="Password Invalid";
    }
    else{
    	if((! $newpassword==''&&!$repeatpassword=='')&&( $newpassword==$repeatpassword)){
		$user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $email,'user_displayname'=>$displayname,'first_name'=>$firstname,'last_name'=>$lastname ) );
    	wp_set_password( $newpassword, $user_id );
    	}
    	else
    	$user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $email,'user_displayname'=>$displayname,'first_name'=>$firstname,'last_name'=>$lastname ) );
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
				<hr>
				<div class="col-md-3  left-column">
					<ul class="nav nav-account-page">
						<li><a><?php _e('Account Setting')?></a></li>
						<li class="active"><a href="#edit-profile-content" data-toggle="tab"><?php _e('Profile')?></a></li>
						<li><a href="#edit-avatar-content" data-toggle="tab"><?php _e('Avatar')?></a></li>
						<li><a href="#edit-newsletter-content" data-toggle="tab"><?php _e('Newsletter')?></a></li>
					</ul>
				</div>
				<div class="col-md-9 right-column">
					<div class="page-content tab-content">
						<div id="edit-profile-content" class="tab-pane fade in active">
							<?php global $current_user;  get_currentuserinfo();?>
							<h1><?php _e('Edit Profile') ?></h1>
							<?php if(isset($message)) echo $message;?>
							<hr>
							<form class="user-infor" method="POST">
										<input name="userID" type="hidden" value="<?php echo $current_user->ID; ?>">
									<div class="form-group row">
										<label class="control-label col-md-3"><?php _e('User Name') ?></label>
										<input class="col-md-6 form-control" name="userName" type="text" disabled="disabled" value="<?php echo $current_user->user_login ; ?>">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('User Email') ?></label>
										<input class="col-md-6 form-control" name="userEmail" type="text" value="<?php echo $current_user->user_email ; ?>" required="required">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Display Name') ?></label>
										<input class="col-md-6 form-control" name="userDisplayname" type="text" value="<?php echo $current_user->display_name ; ?>" >
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('User First Name') ?></label>
										<input class="col-md-6 form-control" name="userFirstname" type="text" value="<?php echo $current_user->user_firstname ; ?>">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('User Last Name') ?></label>
										<input class="col-md-6 form-control" name="userLastname" type="text" value="<?php echo $current_user->user_lastname ; ?>">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('New Password') ?></label>
										<input class="col-md-6 form-control" name="userNewPassword" type="password">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Repeat New Password') ?></label>
										<input class="col-md-6 form-control" name="userRepeatPassword" type="password">
									</div>
								<input class="btn btn-primary" type="submit" value="<?php _e('Update Profile')?>">
								<input class="btn btn-primary" onclick=" query_delete()" value="<?php _e('Close Account')?>">
							</form>
						</div>
						<div id="edit-avatar-content" class="tab-pane fade">
							<h1><?php _e('Change Avatar') ?></h1>
							<hr>
							<?php echo do_shortcode('[basic-user-avatars]'); ?>
							<hr>
						</div>
						<div id="edit-newsletter-content" class="tab-pane fade">
							<h1><?php _e('Newsletter Setting') ?></h1>
							<hr>
							
						</div>
					</div>
			</div>
		</div>
	</div><!-- END CONTENT -->
	<script type="text/javascript">
	function query_delete(){
		$("#edit-profile-content").html('<p>Are you want close this Account<p><input class="btn btn-primary" onclick=" delete_account()" value="<?php _e('Close Account')?>">')
	}
	function delete_account(){
		var user_id=<?php echo $current_user->ID; ?>;
		$.ajax({url:ajaxurl, 
				data:{	
						action:'delete_account',
						user_id:user_id
						},
				type:"POST", 
				success: function(result){
				$("#edit-profile-content").html("Account have closed !");
	    				}
	    				});	
	}
	</script>
<?php get_footer(); ?>