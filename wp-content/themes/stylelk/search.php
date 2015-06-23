<?php get_header();
?>
<div class="container body-content">
    <section id="slider" class="hidden-xs">
        <img src="<?php echo get_template_directory_uri();?>/images/slider.jpg">
    </section>
    <section id="content" class="row">
       <div class="col-md-8 left-column">
       	<?php 
                                while ( have_posts() ) : the_post();
                                    get_template_part( 'content' );
                                endwhile;
        ?>  
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
   <?php if(is_category()):?><p class="loadmore">Load more ...</p>   <?php endif;?>
    
</div>
<?php
get_footer();
?>
