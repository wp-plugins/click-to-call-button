<?php

/*
Plugin Name: Click to Call Button
Plugin URI: https://andymoore.info/click-to-call-button/
Description: Shows a "Click to Call Button" / "Call Now Button" on your site. Advanced features turn WordPress into a telephone with call recording, answering machine and SMS text messaging capabilities. Web phone calling, IVR and SMS features are powered by Twilio's API.
Version: 0.0.1
Author: Andy Moore
Author URI: https://andymoore.info
License: GPL2
*/

define( 'CTCB_VERSION','0.0.1' );

// if admin do admin stuff else do public stuff
if ( is_admin() ) {
	// register admin panel: ctcb_register_admin_panel
	// initialise options: ctcb_options_init
	// admin panel display: ctcb_admin_panel
	// enqueues javascript: ctcb_enqueue_color_picker
	require_once( plugin_dir_path( __FILE__ ) . 'admin/ctcb_admin.php' );
} else {
	// return the status to javascript xmlhttp request: ctcb_service_status
	// handle twilio client / voice requests: ctcb_twiml_client_voice_response
	// handle twilio sms / text message requests: ctcb_twiml_text_message_response
	// sets up request handling to parse callbacks: ctcb_http_callback_handlers
	require_once( plugin_dir_path( __FILE__ ) . 'includes/ctcb_callback_handlers.php' );
	// inject style into the header: ctcb_header_inject
	// inject javascript into the footer: ctcb_footer_inject
	require_once( plugin_dir_path( __FILE__ ) . 'includes/ctcb_public_facing.php' );
}

// sends recording emails / text messages: ctcb_send_recording
// check if the switchboard is open: ctcb_is_open
// getting options: ctcb_get_options
// setting options: ctcb_set_options
require_once( plugin_dir_path( __FILE__ ) . 'includes/functions_and_options.php' );
