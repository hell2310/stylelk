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
				//get another posts
				$post_id_array=array($post_id);
				$args=array( 'post_type' => 'post','posts_per_page'=>10,'post__not_in'=>$post_id_array);
				$the_query = new WP_Query( $args );
				if($the_query->have_posts()):
					while ($the_query->have_posts()):$the_query->the_post();
						get_template_part( 'content',get_post_format());
					endwhile;
				endif;
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
