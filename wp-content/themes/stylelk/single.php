<?php get_header(); ?>
		<section id="content" class="row">
				<div  class="col-md-8 left-column">
					<div class="tab-content">
						<?php 
						if(have_posts()):
						while ( have_posts() ) : the_post();
							get_template_part( 'content', 'single' );
						endwhile;
						endif;
						setPostViews(get_the_ID());
						?>	
					</div> <!-- END TABCONTENT -->
				</div>
				<div class="col-md-4 visible-md visible-lg right-column newsletter-column">
					<h4>follow us</h4>
					<hr>
					<?php $newsletter=new NewsletterWidget;
					echo $newsletter->get_widget_form(); 
					?>
					<p class="banner"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/banner.jpg"></a></p>
				</div>
		</section>
<?php get_footer(); ?>
