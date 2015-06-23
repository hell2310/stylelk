		<?php if(!is_page()): ?>
			<p class="loadmore"><?php _e('Load more') ?></p> 
		</div> <!-- END BODY-CONTENT -->
		<?php endif; ?>
		<?php if(is_page()|is_404()):?>
		<footer id="main-footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<?php wp_nav_menu( array( 'theme_location' => 'pageinfor_menu', 'container' =>false, 'menu_class' => 'col-md-6 col-sm-6 col-xs-6 nav menu-pageinfor' )); ?>
							<div class="col-md-6">
								<h4><?php _e('CONNECT WITH US') ?></h4>
								<ul class="nav nav-pills menu-social">
									<li><a href="<?php echo (get_option('qs_contact_facebook')); ?>"><span class="fa fa-facebook" ></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_twitter')); ?>"><span class="fa fa-twitter"></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_google_plus')); ?>"><span class="fa fa-google-plus"></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_youtube')); ?>"><span class="fa fa-youtube"></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_instagram')); ?>"><span class="fa fa-instagram"></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_pinterest')); ?>"><span class="fa fa-pinterest"></span></a></li>
									<li><a href="<?php echo (get_option('qs_contact_rss')); ?>"><span class="fa fa-rss"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<div class="hidden-xs hidden-sm newsletter-form">	
								<?php $newsletter=new NewsletterWidget;
								echo $newsletter->get_widget_form(); 
								?>
							</div>
							<p>2015 <span class="fa fa-copyright"></span> Stylelk. All right Resever</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<?php endif;?>
	</div><!-- END WRAPPER -->	
	<!-- BACK TO TOP -->
	<a href="<?php echo HOME;?>"class="scroll-up fa fa-chevron-up" onclick="$('html,body').animate({scrollTop:0},'slow');return false;"></a>	
</body>
</html>