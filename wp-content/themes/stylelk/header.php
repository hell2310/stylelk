<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >		
	<div class="blur-screen"></div><!-- BLUR SCREEN 0.5 OPACITY #000000 BACK-GROUND -->
	<nav id="fixer-menu" class="navbar navbar-default"><!-- FIXER MENU -->
		<div class="container">
			<ul class="nav pull-right">
				<li class="visible-small mainmenu-btn"><img src="<?php echo get_template_directory_uri();?>/images/slide-menu.svg"></li>
				<li class="visible-small logo"><a href="<?php echo HOME;?>"><img src="<?php echo esc_url(get_theme_mod( 'stylelk_logo')); ?>"></a></li>
			</ul>
			<?php wp_nav_menu( array( 'theme_location' => 'short_categories_menu_top', 'container' =>false, 'menu_class' => "nav pull-right")); ?>
			<ul class="nav nav-pills pull-right hidden-xs menu-social">
				<li><a href="<?php echo (get_option('qs_contact_facebook')); ?>"><span class="fa fa-facebook" ></span></a></li>
				<li><a href="<?php echo (get_option('qs_contact_twitter')); ?>"><span class="fa fa-twitter"></span></a></li>
				<li><a href="<?php echo (get_option('qs_contact_pinterest')); ?>"><span class="fa fa-pinterest"></span></a></li>
				<li><a href="<?php echo (get_option('qs_contact_instagram')); ?>"><span class="fa fa-instagram"></span></a></li>
			</ul>
			<div class="pull-left search-form-fix"><span class="fa fa-search btn-toggle-search"></span>
				<?php echo get_search_form(); ?>
			</div>
			<?php 
					if( is_user_logged_in()):
						?>
					<ul class="nav nav-pills pull-left hidden-xs user-menu">
						<li class="menu-item-has-children"><a ><span class="fa fa-user"></span> <b><?php _e('Account') ?></b></a>
							<ul class="sub-menu">
								<?php wp_nav_menu( array( 'theme_location' => 'accountpage_menu', 'container' =>false, 'menu_class' => false) ); ?>
								<li><a href="<?php echo wp_logout_url(HOME); ?>"><?php _e('Logout') ?></a></li>
							</ul>	
						</li>
					</ul>
					<?php
					else :
						wp_nav_menu( array( 'theme_location' => 'user_menu', 'container' =>false, 'menu_class' => 'nav nav-pills pull-left hidden-xs user-menu') ); 				
					endif;
			?>
		</div>
	</nav>
	<nav id="slide_menu"><!-- SLIDER MENU -->
		<h1 class="pagename"><a href="<?php echo HOME;?>"><img src="<?php echo esc_url(get_theme_mod( 'stylelk_logo'));?> "></a><span class="pull-left close-slide"></span></h1>
		<?php wp_nav_menu( array( 'theme_location' => 'categories_menu', 'container' =>false, 'menu_class' => 'nav menu-categories') ); ?>
		<div class="newsletter-form">	
			<?php 
			$newsletter=new NewsletterWidget;
			echo $newsletter->get_widget_form(); 
			?>
		</div>
		<ul class="nav nav-pills menu-social">
			<li><a href="<?php echo (get_option('qs_contact_facebook')); ?>"><span class="fa fa-facebook" ></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_twitter')); ?>"><span class="fa fa-twitter"></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_google_plus')); ?>"><span class="fa fa-google-plus"></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_youtube')); ?>"><span class="fa fa-youtube"></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_instagram')); ?>"><span class="fa fa-instagram"></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_pinterest')); ?>"><span class="fa fa-pinterest"></span></a></li>
			<li><a href="<?php echo (get_option('qs_contact_rss')); ?>"><span class="fa fa-rss"></span></a></li>
		</ul>
		<?php wp_nav_menu( array( 'theme_location' => 'pageinfor_menu_1', 'container' =>false, 'menu_class' => 'menu-pageinfor') ); ?>				
		<div class="menu-footer">
			<?php wp_nav_menu( array( 'theme_location' => 'pageinfor_menu_2', 'container' =>false, 'menu_class' => 'menu-term') ); ?>
			<p>2015 <span class="fa fa-copyright"></span> Stylelk. All right Resever</p>
		</div>
	</nav>
	<div class="wrapper">		
		<header>
			<nav id="navbar-top" class="navbar navbar-default">
				<div class="container">
					<ul class="nav nav-pills pull-right menu-home">
						<li class="mainmenu-btn"><a ><span class="fa fa-bars"></span></a></li>
						<?php if(!is_home()):?>
						<li class="logo"><a href="<?php echo HOME; ?>"><img src="<?php echo esc_url(get_theme_mod( 'stylelk_logo'));?>"></a></li>										
						<?php endif;?>
						<?php if(is_home()):?>
						<li class="hidden-xs"><a href="<?php echo HOME; ?>"><span class="fa fa-home"></span></a></li>	
						<li class="visible-xs logo"><a href="<?php echo HOME; ?>"><img src="<?php echo esc_url(get_theme_mod( 'stylelk_logo'));?>"></a></li>					
						<?php endif;?>
					</ul>
					<?php if(!is_home()):?>
					<?php wp_nav_menu( array( 'theme_location' => 'short_categories_menu_top', 'container' =>false, 'menu_class' => "nav pull-right hidden-xs hidden-sm menu-short-categories-top")); ?>
					<?php endif;?>
					<ul class="nav nav-pills pull-right hidden-xs menu-social">
						<li><a href="<?php echo (get_option('qs_contact_facebook')); ?>"><span class="fa fa-facebook" ></span></a></li>
						<li><a href="<?php echo (get_option('qs_contact_twitter')); ?>"><span class="fa fa-twitter"></span></a></li>
						<li><a href="<?php echo (get_option('qs_contact_pinterest')); ?>"><span class="fa fa-pinterest"></span></a></li>
						<li><a href="<?php echo (get_option('qs_contact_instagram')); ?>"><span class="fa fa-instagram"></span></a></li>
					</ul>
					
					<div class="pull-left search-form-fix"><span class="fa fa-search btn-toggle-search"></span>
						<?php echo get_search_form(); ?>
					</div>	
					<!-- MENU USER -->
					<?php 
					if( is_user_logged_in()):
						?>
					<ul class="nav nav-pills pull-left hidden-xs user-menu">
						<li class="menu-item-has-children"><a><span class="fa fa-user"></span> <b><?php _e('Account') ?></b></a>
							<ul class="sub-menu">
								<?php wp_nav_menu( array( 'theme_location' => 'accountpage_menu', 'container' =>false, 'menu_class' => false) ); ?>
								<li><a href="<?php echo wp_logout_url(HOME); ?>"><?php _e('Logout') ?></a></li>
							</ul>	
						</li>
					</ul>
					<?php
					else :
						wp_nav_menu( array( 'theme_location' => 'user_menu', 'container' =>false, 'menu_class' => 'nav nav-pills pull-left hidden-xs user-menu') ); 				
					endif;
					?>				
				</div>
			</nav>
			<?php if(is_home()): ?>
			<?php get_template_part('logo');?>	
			<nav id="main-menu" class="navbar navbar-default hidden-xs"><!-- MAIN MENU -->
				<?php wp_nav_menu( array( 'theme_location' => 'short_categories_menu', 'container' =>false, 'menu_class' => 'nav') ); ?>
			</nav>	
			<?php endif; ?>
		</header>
	<?php if(is_home()): ?>
		<nav id="mobile-nav" class="container visible-xs">
			<ul  class="nav">
				<li class="pull-right active"><a href="#latest-content" data-toggle="tab">LATEST STORIES</a></li>
				<li class="pull-left"><a href="#popular-content" data-toggle="tab">POPULAR STORIES</a></li>
			</ul>
		</nav>
	<?php endif; ?>
	<?php if(!is_page()): ?>
		<div class="container body-content">
			<section id="slider" class="hidden-xs">
				<!-- insert BANNER -->
			</section>
	<?php endif; ?>
