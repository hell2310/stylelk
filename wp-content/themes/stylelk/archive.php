<?php get_header(); ?>
    <section id="content" class="row">
                <div class="col-md-8 left-column">
                    <h2 class="archive_page_name">
                    <?php
                   /*     if ( is_tag() ) :
                                printf( __('Posts Tagged: %1$s'), single_tag_title( '', false ) );
                        elseif ( is_category() ) :
                                printf( __('Posts Categorized: %1$s'), single_cat_title( '', false ) );
                        elseif ( is_day() ) :
                                printf( __('Daily Archives: %1$s'), get_the_time('l, F j, Y') );
                        elseif ( is_month() ) :
                                printf( __('Monthly Archives: %1$s'), get_the_time('F Y') );
                        elseif ( is_year() ) :
                                printf( __('Yearly Archives: %1$s'), get_the_time('Y') );
                        endif;*/
                    ?>
                    </h2>
                    <div class="tab-content">
                        <?php 
                                while ( have_posts() ) : the_post();
                                    get_template_part( 'content' );
                                endwhile;
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