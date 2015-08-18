<?php

// ?click_to_call_button=service-status
// returns the service status to the javascript
function ctcb_service_status() {

	$options = get_option( 'ctcb' );

	// is the service enabled and are we within the scheduled business hours
	if ( isset( $options['active'] ) && $options['active'] === '1' && ctcb_is_open() === true ) {

		// is advanced mode enabled
		if( $options['advanced'] === '1' ) {

			// is there a cookie with the capability token
			if( isset( $_COOKIE['ctcb_twilio_cabability_token'] ) ) {
				$ctcb_token = esc_js( $_COOKIE['ctcb_twilio_cabability_token'] );
			}else{
				// setup twilio and make capability token 
				require_once( plugin_dir_path( __FILE__ ) . 'Twilio_Capability.php' );
				$token = new Services_Twilio_Capability( $options['accountsid'], $options['authtoken'] );
				$token->allowClientOutgoing( $options['appid'] );
				$ctcb_token =  $token->generateToken();
				// set a cookie for thirty minutes with the value of the capability token
				setcookie( 'ctcb_twilio_cabability_token', $ctcb_token, time() + 1800, COOKIEPATH, COOKIE_DOMAIN );
			}
			// advanced mode is enabled 
			echo 'advanced!'.$ctcb_token;
		}else{
			// service is turned on but advanced mode is not enabled
			echo 'on';
		}
	}else{
		// service is switched off
		echo 'off';
	}

	exit;

} // ends ctcb_service_status()

// ?click_to_call_button=twilio-request
// returns the xml needed to process a call
function ctcb_twiml_client_voice_response() {

	$options = ctcb_get_options();

	// send the right content type and start the xml 
	header ( 'Content-Type:text/xml' );
	echo '<?xml version="1.0" encoding="UTF-8"?'.'>';
	echo '<Response>';

	// specxify the drectory where the voice over mp3 files are
	$options['voiceover'] = plugins_url( 'audio/'.$options['voiceover'].'/' , dirname( __FILE__ ) );

	// primary switch which works through the possible call permutations
	switch( true ) {

		// respond to a button click / client request or incoming phone call
		case ( !isset( $_POST['DialCallStatus'] ) && !isset( $_GET['voicemail'] ) );

			// if the options are setup and the switchboard is open
			if( $options['active'] === '1' && ctcb_is_open() === true ) {

				// if the answer value is set we are picking up a call or it came via a click
				if( isset( $_GET['answer'] ) ) {
					$click_to_call_source = 'phone';
					echo '<Play>'.$options['voiceover'].'hello-and-thank-you-for-calling.mp3</Play>';
				}else{
					$click_to_call_source = 'button';
					echo '<Play>'.$options['voiceover'].'thank-you.mp3</Play>';
				}
				echo '<Play>'.$options['voiceover'].'about-to-connect.mp3</Play>';

				// if the options dictate we are to record add the recording instruction
				if( $options['recording'] === '1' ) {
					echo '<Play>'.$options['voiceover'].'calls-are-recorded.mp3</Play>';
					$recording = 'record="record-from-answer"';
				}

				// dial the number set
				echo '<Dial action="'.get_site_url().'?click_to_call_button=twilio-request&amp;source='.$click_to_call_source.'" '.$recording.' callerId="'.esc_html( $options['call_from'] ).'">'.esc_html( $options['call_to'] ).'</Dial>';
				// ends options set and service active

			}else{

				// the service is not active right now so ask the caller to leave a message 
				echo '<Play>'.$options['voiceover'].'im-sorry.mp3</Play>';
				echo '<Play>'.$options['voiceover'].'closed.mp3</Play>';
				if( $options['voicemail'] === '1' ){
					echo '<Play>'.$options['voiceover'].'please-leave-your-message-after-the-tone.mp3</Play>';
					echo '<Record action="'.get_site_url().'?click_to_call_button=twilio-request&amp;voicemail&amp;source='.esc_html( $_GET['source'] ).'" maxLength="60" playBeep="true" />';
				}else{
					echo '<Play>'.$options['voiceover'].'thank-you-for-calling-and-goodbye.mp3</Play>';
				}

			}
		break;

		// a dial attempt has been made - work through the possible permutations
		case ( isset( $_POST['DialCallStatus'] ) );

			// secondary switch to work through call status permutations
			switch( true ) {

				// completed - thanks and bye
				case ( $_POST['DialCallStatus']==='completed' );
					$play['0'] = 'thank-you-for-calling-and-goodbye.mp3';
				break;

				// busy - sorry - engaged
				case ( $_POST['DialCallStatus']==='busy' );
					$voicemail = true;
					$play['0'] = 'im-sorry.mp3';
					$play['1'] = 'engaged.mp3';
				break;

				// no answer - sorry - no answer
				case ( $_POST['DialCallStatus']==='no-answer' );
					$voicemail = true;
					$play['0'] = 'im-sorry.mp3';
					$play['1'] = 'no-answer.mp3';
				break;

				// failed - sorry - can't connect
				case ( $_POST['DialCallStatus']==='failed' );
					$voicemail = true;
					$play['0'] = 'im-sorry.mp3';
					$play['1'] = 'cant-connect.mp3';
				break;
			} // ends the secondary switch

			// for each mp3 file we set above now play that out to the caller
			foreach( $play as $clip ) {
				echo '<Play>'.$options['voiceover'].$clip.'</Play>';
			}

			// if the call was not completed ask the user to leave a message if voicemail is enabled
			if( isset( $voicemail ) ) {
				if( $options['voicemail'] === '1' ){
					echo '<Play>'.$options['voiceover'].'please-leave-your-message-after-the-tone.mp3</Play>';
					echo '<Record action="'.get_site_url().'?click_to_call_button=twilio-request&amp;voicemail&amp;source='.esc_html( $_GET['source'] ).'" maxLength="60" playBeep="true" />';
				}else{
					echo '<Play>'.$options['voiceover'].'thank-you-for-calling-and-goodbye.mp3</Play>';
				}
			}

			// if there's a recording of this call send the recording url to the site owner
			if( isset( $_POST['RecordingUrl'] ) ) {
				ctcb_send_recording( 'Call' );
			}
		break; 

		// processing a voice mail message - sends the recording to admin, thanks the user and says bye
		case( isset( $_GET['voicemail'] ) );
			ctcb_send_recording( 'Message' );
			echo '<Play>'.$options['voiceover'].'thank-you-for-calling-and-goodbye.mp3</Play>';
		break;

	} // ends primary switch with call permutations

	echo '</Response>';
	exit;

} // ends ctcb_twiml_client_voice_response()

// ?click_to_call_button=sms-request
// returns the xml needed to process a text message
function ctcb_twiml_text_message_response(){

	$options = ctcb_get_options();

	// send the right content type and start the xml 
	header ( 'Content-Type:text/xml' );
	echo '<?xml version="1.0" encoding="UTF-8"?'.'>';
	echo '<Response>';
	
	$keywords = explode( ' ', strtolower( $_POST['Body'] ) );

	// check if this message is from the number set for admin
	if( $options['sms_to'] === $_POST['From'] ) {

		// allow other plugins to intercept text messages from admin
		do_action( 'ctcb_text_message_from_admin' );

		// check if the keyword sent matches a function
		$sms_function = 'ctcb_sms_'.$keywords['0'];
		if( function_exists( $sms_function ) ) {
			$reply = $sms_function();
		}

		// are we turning the service on
		if( $keywords['0'] === 'on' ) {
			$options['active'] = '1';
			$update_options = true;
			$reply = 'Service turned on';
		}

		// are we turning the service off
		if( $keywords['0'] === 'off' ) {
			$options['active'] = '0';
			$update_options = true;
			$reply = 'Service turned off';
		}

		// check if we need to update the options
		if( isset( $update_options ) ) {
			update_option( 'ctcb', $options );
		}

		// send an email if options dictate
		if( isset( $reply ) && $options['notification']!='sms' ) {
			wp_mail($options['email'],'Click to Call Button Service Status',$reply);
		}

		// send a text message if options dictate
		if( isset( $reply ) && $options['notification']!='email' ) {
			echo '<Message>'.$reply.'</Message>';
		}

		// ends text message being from admin / site owner / call_to value
	}else{

		// this text is from a user / visitor / the outside world
		// allow other plugins to intercept text messages from users
		do_action( 'ctcb_text_message_from_user' );

		// check if the keyword sent matches a function
		$sms_function = 'ctcb_sms_'.$keywords['0'];
		if( function_exists( $sms_function ) ) {
			$options['default_reply'] = $sms_function();
		}

		if( $options['default_reply'] != '' ) {
			echo '<Message>'.$options['default_reply'].'</Message>';
		}

		// the recipeint of the text we're about to forward needs to know who it is from
		$ctcb_sms['pre']			= 'Text Message from '.esc_html( $_POST['From'] ) ;
		$ctcb_sms['pst']			= 'follows in next message';

		// send an email if options dictate
		if( $options['notification']!='sms' ) {
			wp_mail( $options['email'], $ctcb_sms['pre'],$_POST['Body'] );
		}

		// send a text message if options dictate
		if( $options['notification']!='email' ) {

			// is the info for the recipient + body of message is less than 160 chars send it all in one message
			// or if it is longer than 160 chars break the message into two
			if( strlen($ctcb_sms['pre'].' '.$_POST['Body'])<=160 ){
				echo '<Message to="'.$options['sms_to'].'">'.$ctcb_sms['pre'].' '.esc_html( $_POST['Body'] ).'</Message>';
			}else{
				echo '<Message to="'.$options['sms_to'].'">'.$ctcb_sms['pre'].' '.$ctcb_sms['pst'].'</Message>';
				echo '<Message to="'.$options['sms_to'].'">'.esc_html( $_POST['Body'] ).'</Message>';
			}
		}
		// ends text message being from user	
	}
	echo '</Response>';
	exit;

} // ends ctcb_twiml_text_message_response()

// tell wp that when certain criteria are met to run certain functions
function ctcb_http_callback_handlers( $wp ) {

	// hook up service status requests
	if ( array_key_exists( 'click_to_call_button', $wp->query_vars ) && $wp->query_vars['click_to_call_button'] == 'service-status' ) {
		do_action( 'ctcb_pre_service_status' );
		ctcb_service_status();
  }

	// hook up twilio voice call and button / client requests
	if ( array_key_exists( 'click_to_call_button', $wp->query_vars ) && $wp->query_vars['click_to_call_button'] == 'twilio-request' ) {
		do_action( 'ctcb_pre_twiml_response' );
		ctcb_twiml_client_voice_response();
  }

	// hook up twilio sms / text message requests
	if ( array_key_exists( 'click_to_call_button', $wp->query_vars ) && $wp->query_vars['click_to_call_button'] == 'sms-request' ) {
		do_action( 'ctcb_pre_twiml_text_message_response' );
		ctcb_twiml_text_message_response();
  }

} // ends ctcb_http_callback_handlers

function ctcb_http_callback_handlers_var( $vars ) {
    $vars[] = 'click_to_call_button';
    return $vars;
}

add_action( 'parse_request', 'ctcb_http_callback_handlers' );
add_filter( 'query_vars', 'ctcb_http_callback_handlers_var' );
add_action( 'wp', 'ctcb_http_callback_handlers' );
