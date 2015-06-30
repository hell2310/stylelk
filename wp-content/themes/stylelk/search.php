<?php get_header();
?>
<div class="container body-content">
  <section id="slider" class="hidden-xs">
  </section>
  <section id="content" class="row">
    <div class="col-md-8 left-column">
      <?php 
        while ( have_posts() ) : the_post();
          get_template_part( 'content','short');
        endwhile;
      ?>  
    </div>
    <div class="col-md-4 visible-md visible-lg right-column newsletter-column">
      <h4><?php _e('follow us') ?></h4>
      <hr>
      <?php $newsletter=new NewsletterWidget;
        echo $newsletter->get_widget_form(); 
      ?>
    </div>
  </section>   
</div>
<?php
get_footer();
?>
