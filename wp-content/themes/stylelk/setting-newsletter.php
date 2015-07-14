<?php 
if(!is_user_logged_in()){
	redirect_to_page();
}
get_header();
/*
 Template Name: Newsletter Setting
 */
global $wpdb;
global $current_user;
$query="SELECT status FROM wp_newsletter WHERE email='$current_user->user_email'";
$result_status=$wpdb->get_results($query);
$result_status=$result_status['0']->status;
if(isset($_POST['newsletter-form']))
{	
	if($_POST['newsletter-stylelk']==1)	
	{	
		if($result_status==null)
		{
			$token=substr(md5(rand()), 0, 10);
			$wpdb->insert('wp_newsletter',array('email'=>$current_user->user_email,'status'=>'C','token'=>$token));
		}
		else if($result_status=='S'){
			$wpdb->update( 'wp_newsletter', array('status'=>'C'),array( 'email'=>$current_user->user_email));
		}
	}
	else
	{	
		$wpdb->update( 'wp_newsletter', array('status'=>'S'), array('email'=>$current_user->user_email));
	}
}
?>
 	<div class="container body-content">
		<div class="row">
				<hr>
				<div class="col-md-3  left-column">
					<ul class="nav nav-account-page">
						<li><a><?php _e('Account Setting')?></a></li>
						<li class="active"><a href="<?php echo HOME;?>/setting/profile" ><?php _e('Profile')?></a></li>
						<li><a href="<?php echo HOME;?>/setting/avatar" ><?php _e('Avatar')?></a></li>
						<li><a href="<?php echo HOME;?>/setting/newsletter"><?php _e('Newsletter')?></a></li>
					</ul>
				</div>
				<div class="col-md-9 right-column">
					<div class="page-content tab-content">
						<div id="edit-newsletter-content" >
							<h1><?php _e('Newsletter Setting') ?></h1>
							<p><?php _e('Select/unselect subscribe to.'); ?></p>
							<form class="newsletter-config" method="POST">
								<input type="hidden" name="newsletter-form" value="1">
								<label class="newsletter-stylelk"><input type="checkbox" name="newsletter-stylelk" value="1" <?php if($result_status=='C'):?>checked="checked"<?php endif;?>><?php _e(' Editoria');?></label></br>
								<input type="submit" class="btn btn-primary" value="<?php _e('Save Changes');?>">
							</form>
							<hr>
						</div>
					</div>
			</div>
		</div>
	</div><!-- END CONTENT -->
<?php get_footer(); ?>