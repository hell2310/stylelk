<?php get_header(); ?>
<div class="container body-content">
			<hr>
			<section id="content" class="row">
				<div class="col-md-3  visible-md visible-lg left-column">
					<?php wp_nav_menu( array( 'theme_location' => 'pageinfor_menu', 'container' =>false, 'menu_class' => 'nav menu-pageinfor' )); ?>
				</div>
				<div class="col-md-9 right-column">
					<div class="page-content">

						<?php 
							while ( have_posts() ) : the_post();
							?><h1><?php the_title()?></h1>
						<?php
                                   the_content();
                            endwhile;
						?>
					</div>	
				</div>
			</section>
</div>
<?php get_footer(); ?>