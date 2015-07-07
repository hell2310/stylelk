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
    $location=$wpdb->escape(trim($_POST['location'])); 
    $birthday_date=$wpdb->escape(trim($_POST['birthday_date'])); 
    $birthday_month=$wpdb->escape(trim($_POST['birthday_month']));  
    $birthday_year=$wpdb->escape(trim($_POST['birthday_year']));   
    if($email == ''|$username=''){
    	$message="Email empty";
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    	$message="Invalid email";
    }
    else if((! $newpassword==''|!$repeatpassword=='')&&( $newpassword!=$repeatpassword))
    {
    	$message="Password Invalid";
    }
    else{
    	if((! $newpassword==''&&!$repeatpassword=='')&&( $newpassword==$repeatpassword)){
		$user_id = wp_update_user( array( 'ID' => $user_id,'user_email' => $email,'user_displayname'=>$displayname,'first_name'=>$firstname,'last_name'=>$lastname ) );
    	}
    	else
    	$user_id = wp_update_user( array( 'ID' => $user_id,'user_email' => $email,'user_displayname'=>$displayname,'first_name'=>$firstname,'last_name'=>$lastname, ) );
    	if(get_user_meta( $user_id,'location',true)=='')
    		add_user_meta($user_id,'location',$location);
    	else 
    		update_user_meta($user_id,'location',$location);
    	if(get_user_meta( $user_id,'birthday_date',true)=='')
    		add_user_meta($user_id,'birthday_date',$birthday_date);
    	else 
    		update_user_meta($user_id,'birthday_date',$birthday_date);
    	if(get_user_meta( $user_id,'birthday_month',true)=='')
    		add_user_meta($user_id,'birthday_month',$birthday_month);
    	else 
    		update_user_meta($user_id,'birthday_month',$birthday_month);
    	if(get_user_meta( $user_id,'birthday_year',true)=='')
    		add_user_meta($user_id,'birthday_year',$birthday_year);
    	else 
    		update_user_meta($user_id,'birthday_year',$birthday_year);
    	if(is_wp_error( $user_id ) ){
    		$message="Error Update";
    	}
    	else{
    		$message="Update Success";
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
							<form class="user-infor" method="POST">
										<input name="userID" type="hidden" value="<?php echo $current_user->ID; ?>">
									<div class="form-group row">
										<label class="control-label col-md-3"><?php _e('User Name') ?></label>
										<input class="col-md-6 form-control" name="userName" disabled="disabled" type="text" value="<?php echo $current_user->user_login ; ?>">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Email') ?></label>
										<input class="col-md-6 form-control" name="userEmail" type="text" value="<?php echo $current_user->user_email ; ?>" required="required">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Display Name') ?></label>
										<input class="col-md-6 form-control" name="userDisplayname" type="text" value="<?php echo $current_user->display_name ; ?>" >
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('First Name') ?></label>
										<input class="col-md-6 form-control" name="userFirstname" type="text" value="<?php echo $current_user->user_firstname ; ?>">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Last Name') ?></label>
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
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Location') ?></label>
										<input class="col-md-6 form-control" name="location" type="text">
									</div>
									<div class="form-group row">							
										<label class="control-label col-md-3"><?php _e('Birthday') ?></label>
										<div class="col-md-6 none-padding birthday-select">
											<select class="form-control" name="birthday_year">
												<?php for($year=2015;$year>=1985;$year--){?><option value="<?php echo $year;?>" <?php if(isset($current_user->birthday_year)&&$current_user->birthday_year==$year){?>selected="selected"<?php }?>><?php echo $year;?></option><?php }?> 
											</select> / 
											<select class="form-control" name="birthday_month">
												<option value="Jan" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Jan'){?>selected="selected"<?php }?>>Jan</option>
												<option value="Feb" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Feb'){?>selected="selected"<?php }?>>Feb</option>
												<option value="Mar" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Mar'){?>selected="selected"<?php }?>>Mar</option>
												<option value="Apr" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Apr'){?>selected="selected"<?php }?>>Apr</option>
												<option value="May" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='May'){?>selected="selected"<?php }?>>May</option>
												<option value="Jun" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Jun'){?>selected="selected"<?php }?>>Jun</option>				
												<option value="Jul" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Jul'){?>selected="selected"<?php }?>>Jul</option>
												<option value="Aug" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Aug'){?>selected="selected"<?php }?>>Aug</option>
												<option value="Sep" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Sep'){?>selected="selected"<?php }?>>Sep</option>
												<option value="Oct" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Oct'){?>selected="selected"<?php }?>>Oct</option>
												<option value="Nov" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Nov'){?>selected="selected"<?php }?>>Nov</option>
												<option value="Dec" <?php if(isset($current_user->birthday_month)&&$current_user->birthday_month=='Dec'){?>selected="selected"<?php }?>>Dec</option>
											</select> / 
											<select class="form-control" name="birthday_date">
												<?php for($date=1;$date<=31;$date++){?><option value="<?php echo $date;?>" <?php if(isset($current_user->birthday_date)&&$current_user->birthday_date==$date){?>selected="selected"<?php }?>><?php echo $date;?></option><?php }?> 
											</select>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-6  col-md-offset-3 none-padding account-btn">
											<input class="btn btn-primary" type="submit" value="<?php _e('Update Profile')?>">
											<input class="btn btn-primary" onclick=" query_delete()" value="<?php _e('Close Account')?>">					
										</div>
									</div>
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