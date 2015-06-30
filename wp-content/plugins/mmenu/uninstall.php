<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
{
    exit();
}

$options = array(
	'mm_version',
	'mm_features',
	'mm_looks',
	'mm_usage'
);
foreach( $options as $option )
{
	delete_option( $option );
}