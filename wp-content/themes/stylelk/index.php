<?php get_header(); ?>
			<hr>
			<section id="content" class="row">
				<div class="col-md-8 left-column">
					<ul id="tab-menu"class="nav nav-tabs hidden-xs">
						<li class="pull-right active"><a href="#latest-content" data-toggle="tab">LATEST STORIES</a></li>
						<li class="pull-left"><a href="#popular-content" data-toggle="tab">POPULAR STORIES</a></li>
					</ul>
					<div class="tab-content">
					<!-- 	LATEST STORIES -->
						<div id="latest-content" class="tab-pane fade in active">
							<?php 
							global $wpdb;
							global $post;
							$posts = $wpdb->get_results("SELECT ID,post_title,comment_count,post_date FROM $wpdb->posts WHERE post_type='post' AND post_status='publish' ORDER BY post_date DESC LIMIT 0, 2");	  
							if ($posts) : 
							 	foreach ($posts as $post) {
							 		setup_postdata( $post );
							 		get_template_part('content');
							 	}
							 	wp_reset_postdata();
							else:
								get_template_part('content','none');
							endif;
							 ?>
						</div>
					<!-- 	POPULAR STORIES -->
						<div id="popular-content" class="tab-pane fade in">	
						<?php	
							global $wpdb;
							global $post;
	    					$posts = $wpdb->get_results("SELECT $wpdb->posts.ID,$wpdb->posts.post_title,$wpdb->posts.post_date,$wpdb->postmeta.meta_value FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id=$wpdb->posts.ID WHERE $wpdb->postmeta.meta_key='post_views_count' AND $wpdb->posts.post_type='post' AND post_status='publish' ORDER BY $wpdb->postmeta.meta_value  DESC");	 
	   						if ($posts) : 
								foreach ($posts as $post) {
									setup_postdata( $post );
									get_template_part('content');
								}
								wp_reset_postdata();
							else:
								get_template_part('content','none');
							endif;
						?>	
						</div>
					</div> <!-- END TABCONTENT -->
				</div>
				<div class="col-md-4 visible-md visible-lg right-column newsletter-column">
					<h4>follow us</h4>
					<hr>
						<?php  $newsletter=new NewsletterWidget;
						echo $newsletter->get_widget_form();  ?>
					<p class="banner"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/banner.jpg"></a></p>
				</div>
			</section>	
<?php get_footer(); ?>