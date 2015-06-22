<?php 
if(get_theme_mod('stylelk_logo')){
	$logo= '<a href="'.esc_url( home_url()).'">
	<img src="'.esc_url(get_theme_mod( 'stylelk_logo')).'" ></a>';
}
else $logo=get_bloginfo("name");
$output='<h1 id="logo" class="hidden-xs">'.$logo.'</h1>';
echo $output;