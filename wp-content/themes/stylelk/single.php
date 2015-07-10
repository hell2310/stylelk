<?php get_header(); ?>
	<section id="content" class="row">
		<div  class="col-md-8 left-column">
			<div class="tab-content">
				<?php 
				if(have_posts()):
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				endif;
				$post_id=get_the_ID();
				setPostViews($post_id);
				?>	
			</div> <!-- END TABCONTENT -->
		</div>
		<div class="col-md-4 visible-md visible-lg right-column newsletter-column">
			<h4><?php _e('follow us')?></h4>
			<hr>
			<?php $newsletter=new NewsletterWidget;
			echo $newsletter->get_widget_form(); 
			?>
		</div>
</section>
<?php get_footer(); ?>
