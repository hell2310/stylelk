<?php get_header();
?>
<div class="container body-content">
  <section id="slider" class="hidden-xs">
  </section>
  <section id="content" class="row">
    <?php if(have_posts()): ?>
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
    <?php else: ?>
      <p class="search-message" ><span><?php _e('Sorry but nothing found.') ?></span><br/><?php _e('Please try a different search.');?></p>
      <form role="search" style="border-bottom:2px #333333 solid" method="get" class="input-group search-form searchform-page" action="<?php echo esc_url( home_url( '/' ) );?>">
      <input name="s" type="search" class="search-field form-control input-search" value="<?php echo $_REQUEST['s'];?>">
      <span  class="input-group-btn"><button style="font-size:20px ;border:none;background:#ffffff;" type="submit" class="btn btn-default btn-search"><span class="fa fa-search"></span></button></span>
      </form> 
    <?php endif; ?>
  </section>   
</div>
<?php
get_footer();
?>
