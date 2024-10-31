<?php
// if we're not uninstalling..
if( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

// clean up..
delete_option( 'pc_custom_css' );
