<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { 
	exit();
}

delete_site_option( 'ctcb' );  
