<?php

// sends recording url for calls and messages 
function ctcb_send_recording( $channel ) {

	$options = ctcb_get_options();

	$post['Body'] = $channel.' '.( ( isset( $_GET['source'] ) && $_GET['source']==='button') ? 'Web Button' : esc_html( $_POST['From'] ) ).' '.esc_html( $_POST['RecordingUrl'] ).'.mp3';

	if( $options['notification'] != 'sms' ){
		wp_mail($options['email'],'Click to Call Recording',esc_html( $post['Body'] ));
	}

	if( $options['notification'] != 'email' ){
		$post['From'] = $options['sms_from'];
		$post['To'] = $options['sms_to'];
		$ch = curl_init( 'https://api.twilio.com/2010-04-01/Accounts/'.$options['accountsid'].'/SMS/Messages.xml' );
		curl_setopt( $ch, CURLOPT_USERPWD, $options['accountsid'].':'.$options['authtoken'] );
		curl_setopt( $ch, CURLOPT_POST, 1 );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $post );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		@curl_exec( $ch );
		curl_close( $ch );
	} // ends sending sms

} // ends ctcb_send_recording

// function to work out if the switchboard / service is enabled or disabled according to the business hours set in the admin panel
function ctcb_is_open() {
	$options = get_option( 'ctcb' );
	$time = current_time( 'timestamp', '0');
	$day = date('N',$time);
	$hour = date('H',$time);
	$minute = date('i',$time);
	$hhmm = $hour.$minute;
	$start_hhmm = $options['business_hours'][$day]['start_hour'].$options['business_hours'][$day]['start_minute'];
	$stop_hhmm = $options['business_hours'][$day]['stop_hour'].$options['business_hours'][$day]['stop_minute'];
	if($hhmm>=$start_hhmm && $hhmm <= $stop_hhmm){
		return true;	
	}else{
		return false;	
	}
} // ends ctcb_is_open

// get options
function ctcb_get_options() {
	if( !get_option('ctcb') ) {

		$hours = '';
		$days = '0';
		while($days<7){
			++$days;
			$hours[$days]['start_hour'] = ($days>5 ? '00' : '09');
			$hours[$days]['start_minute'] = '00';
			$hours[$days]['stop_hour'] = ($days>5 ? '00' : '17');
			$hours[$days]['stop_minute'] = '00';
		}		

		$default_options = array (
			'active' => 0,
			'public_number' => '',
			'call_to' => '',
			'call_from' => '',
			'recording' => '0',
			'voicemail' => '1',
			'notification' => 'email',
			'email' => get_option('admin_email'),
			'sms_to' => '',
			'sms_from' => '',
			'accoundsid' => '',
			'authtoken' => '',
			'appid' => '',
			'radius' => '50',
			'opacity' => '1',
			'delay_seconds' => '0',
			'color_ready' => '#00CC00',
			'color_active' => '#FF0084',
			'positioning' => 'right',
			'advanced' => 0,
			'business_hours' => $hours,
			'default_reply' => 'Thank you for your text message. We will be in touch soon!',
			'voiceover' => 'female-voice-over',
			'alert' => 'If you leave this page now your call will end!',
		);
		add_option( 'ctcb',$default_options );
		$options = get_option( 'ctcb' );
	} 
	$options = get_option( 'ctcb' );
	return $options;
} // ends ctcb_get_options

// set options
function ctcb_set_options() {
	if( get_option( 'ctcb' ) && !array_key_exists( 'active', get_option('ctcb') ) ) {
		$options = get_option( 'ctcb' );
		$default_options = array(
			'active' => $options['active'],
			'public_number' => $options['public_number'],
			'call_to' => $options['call_to'],
			'call_from' => $options['call_from'],
			'recording' => $options['recording'],
			'voicemail' => $options['voicemail'],
			'notification' => $options['notification'],
			'email' => $options['email'],
			'sms_to' => $options['sms_to'],
			'sms_from' => $options['sms_from'],
			'accountsid' => $options['accountsid'],
			'authtoken' => $options['authtoken'],
			'appid' => $options['appid'],
			'radius' => $options['radius'],
			'opacity' => $options['opacity'],
			'delay_seconds' => $options['delay_seconds'],
			'color_ready' => $options['color_ready'],
			'color_active' => $options['color_active'],
			'positioning' => $options['positioning'],
			'advanced' => $options['advanced'],
			'business_hours' => $options['business_hours'],
			'default_reply' => $options['default_reply'],
			'voiceover' => $options['voiceover'],
			'alert' => $options['alert'],
		);
		update_option( 'ctcb',$default_options );
	}
} // ends ctcb_set_options 
ctcb_set_options();
