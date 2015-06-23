<?php get_header();
/*
 Template Name: Account Page
 */ 
?>
 	<div class="container body-content">
		<div class="row">
			<div id="login-register-container">
				<?php global $current_user; $user_infor=wp_get_current_user();/* die(var_dump($user_infor));*/?>
				<h1><?php _e('Edit Profile') ?></h1>
				<hr>
				<form class="user-infor">
					<input name="userID" type="hidden" value="<?php echo $user_infor->ID; ?>">
					<label><?php _e('User Name') ?></label>
					<input class="form-control" name="userName" type="text" disabled="disabled" value="<?php echo $user_infor->user_login ; ?>">
					<label><?php _e('User Email') ?></label>
					<input class="form-control" name="userEmail" type="text" value="<?php echo $user_infor->user_email ; ?>">
					<label><?php _e('User First Name') ?></label>
					<input class="form-control" name="userFirstname" type="text" value="<?php echo $user_infor->user_firstname ; ?>">
					<label><?php _e('User Last Name') ?></label>
					<input class="form-control" name="userLastname" type="text" value="<?php echo $user_infor->user_lastname ; ?>">
					<label><?php _e('New Password') ?></label>
					<input class="form-control" name="userNewPassword" type="text">
					<label><?php _e('Repeat New Password') ?></label>
					<input class="form-control" name="userRepeatPassword" type="text">
					<input class="btn btn-primary" type="submit" value="<?php _e('Update Profile')?>">
				</form>
			</div>
		</div>
	</div><!-- END CONTENT -->
<?php get_footer(); ?>