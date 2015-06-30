<?php get_header(); ?>
    <section id="content" class="row">
                <div class="col-md-8 left-column">
                    <h2 class="archive_page_name">
                    </h2>
                    <div class="tab-content">
                        <?php
                        if(is_category()):
                            global $wpdb;
                            global $post;
                            $categoy_id=get_cat_id( single_cat_title("",false) );
                            $numpost=10;
                            $curentpost=0;
                            $args=array('cat'=>$categoy_id,'posts_per_page'=>$numpost,'offset'=>$curentpost);
                            $the_query=new WP_Query($args);
                            if ($the_query->have_posts()) : 
                                while ($the_query->have_posts()): $the_query->the_post();
                                    setup_postdata($post);
                                    $html.=get_template_part('content','short');
                                endwhile;
                                 wp_reset_postdata();
                            else:
                                ?>
                            <p> <?php echo _e('Not have post in category'); ?></p>
                            <?php
                            endif;
                        elseif( is_tag() ) :
                            global $wpdb;
                            global $post;
                            $tag_slug=single_tag_title( '', false );
                            $numpost=10;
                            $curentpost=0;
                            $args=array('tag'=>$tag_slug,'posts_per_page'=>$numpost,'offset'=>$curentpost);
                            $the_query=new WP_Query($args);
                            if ($the_query->have_posts()) : 
                                while ($the_query->have_posts()): $the_query->the_post();
                                    setup_postdata($post);
                                    $html.=get_template_part('content','short');
                                endwhile;
                                 wp_reset_postdata();
                            else:
                                ?>
                            <p> <?php _e('Not have post in tag')?></p>
                            <?php
                            endif;
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