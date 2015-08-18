<?php

function ctcb_admin_panel() {
	$vo_path = plugin_dir_path( dirname( __FILE__ ) ) .'audio/';
?>

	<h1>
		Click to Call Button Settings
		<span style="float:right;right:0px;margin-right:20px;position:fixed;">
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=andy%40andymoore%2einfo&lc=GB&item_name=Click%20to%20Call%20Plugin%20install%20at%20<?php echo get_site_url();?>&item_number=ctcb_v<?php echo CTCB_VERSION;?>&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest" target="_blank">
				<img src="<?php echo plugins_url( 'images/paypal_donate_button.gif', dirname( __FILE__ ) );?>" />
			</a>
		</span>
	</h1>

	<form method="post" action="options.php">

		<?php settings_fields( 'ctcb_options' ); ?>
	  <?php $options = ctcb_get_options(); ?>

		<hr />
		<h2>Basic Settings</h2>
		<hr />

	  <table class="form-table" style="margin-top:-0px;">
			<tr valign="top"><th scope="row">Plugin Active</th>
	    	<td>
	        <label title="on">
	      		<input name="ctcb[active]" id="on" type="radio" value="1" <?php checked('1', $options['active']); ?> /> Yes<br />
	      	</label>
	        <label title="off">
		        <input name="ctcb[active]" id="off" type="radio" value="0" <?php checked('0', $options['active']); ?> /> No
	      	</label>
	      </td>
	    </tr>
	  </table>
		<hr />

		<p>Getting your <strong>Mobile Click to Call Button</strong> setup is easy; all the plugin needs to know is your phone number. </p>
		<p>The <strong>phone number</strong> value needs to be in <strong>international format</strong> without any spaces, for example: <i><strong>+12345678909</strong></i> or <i><strong>+4478987654321</strong></i>:</p>

	  <table class="form-table" style="margin-top:-20px;">
	    <tr valign="top"><th scope="row"><label for="public_number">Phone Number</label></th>
	    	<td><input type="text" name="ctcb[public_number]" id="public_number" value="<?php echo sanitize_text_field( $options['public_number'] ) ?>" placeholder="+12345678909" /></td>
	    </tr>
	  </table>

		<hr />
		<h2>Display</h2>
		<hr />

		<p>Your <strong>Click to Call Button</strong> can be tailored to fit the style of your website.</p>
		<p>The options below should give you enough flexibility to make the button feel at home on your pages.</p>

	  <table class="form-table" style="margin-top:-20px;">

			<tr valign="top"><th scope="row"><label for="color_ready">Button Color</label></th>
      	<td><input name="ctcb[color_ready]" id="color_ready" type="text" value="<?php echo sanitize_text_field( $options['color_ready'] ) ?>" class="button_colour" data-default-color="<?php echo sanitize_text_field( $options['color_ready'] ); ?>" placeholder="<?php echo $options['color_ready']; ?>" /></td>
      </tr>

			<tr valign="top"><th scope="row">Button Position</th>
      	<td>
          <label title="full">
          	<input type="radio" name="ctcb[positioning]" value="full" <?php checked('full', $options['positioning']); ?>>
            <span>Full Screen Botton</span>
          </label><br />
        	<label title="left">
          	<input type="radio" name="ctcb[positioning]" value="left" <?php checked('left', $options['positioning']); ?>>
            <span>Bottom Left</span>
          </label><br />
          <label title="middle">
          	<input type="radio" name="ctcb[positioning]" value="middle" <?php checked('middle', $options['positioning']); ?>>
            <span>Bottom Center</span>
          </label><br />
          <label title="right">
          	<input type="radio" name="ctcb[positioning]" value="right" <?php checked('right', $options['positioning']); ?>>
            <span>Bottom Right</span>
          </label>
        </td>
      </tr>

			<tr valign="top"><th scope="row">Button Corners</th>
  	  	<td>
	      	<label title="no_curves">
					 	<input type="radio" name="ctcb[radius]" value="0" <?php checked('0', $options['radius']); ?>>
	          <span>Square Edges</span>
	        </label><br />
	        <label title="small_curves">
	        	<input type="radio" name="ctcb[radius]" value="10" <?php checked('10', $options['radius']); ?>>
	          <span>Small Curves</span>
	        </label><br />
	        <label title="big_curves">
	        	<input type="radio" name="ctcb[radius]" value="20" <?php checked('20', $options['radius']); ?>>
	          <span>Big Curves</span>
	        </label><br />
	        <label title="large_curves">
	        	<input type="radio" name="ctcb[radius]" value="50" <?php checked('50', $options['radius']); ?>>
	          <span>Rounded Top</span>
	        </label>
	 			</td>
			</tr>

	    <tr valign="top"><th scope="row">Transparency</th>
  	  	<td>
	        <label title="No transparency">
          	<input type="radio" name="ctcb[opacity]" value="1" <?php checked('1', $options['opacity']); ?>>
            <span>Strong: No transparency</span>
          </label><br />
	        <label title="50% transparency">
          	<input type="radio" name="ctcb[opacity]" value=".5" <?php checked('.5', $options['opacity']); ?>>
            <span>Stylish: 50% transparency</span>
          </label><br />
	        <label title="75% transparency">
          	<input type="radio" name="ctcb[opacity]" value=".25" <?php checked('.25', $options['opacity']); ?>>
            <span>Subtle: 75% transparency</span>
          </label>
				</td>
	    </tr>

	    <tr valign="top"><th scope="row"><label for="delay_seconds">Show After Seconds</label></th>
  	  	<td>
	        <label title="Show on page load">
          	<input type="radio" name="ctcb[delay_seconds]" value="0" <?php checked('0', $options['delay_seconds']); ?>>
            <span>Show upon page load</span>
          </label><br />
	        <label title="Show after 30 seconds">
          	<input type="radio" name="ctcb[delay_seconds]" value="30" <?php checked('30', $options['delay_seconds']); ?>>
            <span>Show after 30 seconds</span>
          </label><br />
	        <label title="Show after a minute">
          	<input type="radio" name="ctcb[delay_seconds]" value="60" <?php checked('60', $options['delay_seconds']); ?>>
            <span>Show after a minute</span>
          </label><br />
	        <label title="Show after 90 seoonds">
          	<input type="radio" name="ctcb[delay_seconds]" value="90" <?php checked('90', $options['delay_seconds']); ?>>
            <span>Show after 90 seconds</span>
          </label>
				</td>
			</tr>

		</table>

		<hr />
		<h2>Hours of Business</h2>
		<hr />

		<?php
		$time = current_time( 'timestamp', '0');
		?>

		<p>Set the hours of the working week during which you want the button to be shown.</p>
		<p>Current time: <strong><?php echo date('l H:i a',$time); ?></strong><br />

		<?php
		echo 'Service status: <strong>'.(ctcb_is_open() === true ? '<span style="color:green;">Operational</span>' : '<span style="color:red;">Outside business hours</span>').'</strong></p>';
		?>
		
		<table class="" cellpadding="0">
			<tr>
				<td></td>
				<td width="50px;"></td>
				<td><strong>Available from</strong></td>
				<td width="50px;"></td>
				<td><strong>Available till</strong></td>
			</tr>

			<?php
			
			$ctcb_weekdays = array(
			    'Monday' => '1',
			    'Tuesday' => '2',
			    'Wednesday' => '3',
			    'Thursday' => '4',
			    'Friday' => '5',
			    'Saturday' => '6',
			    'Sunday' => '7',
			);
			
			foreach ( $ctcb_weekdays as $ctcb_day => $ctcb_value ) {
    
				echo '<tr>
				<td><strong>'.$ctcb_day.'</strong></td>
				<td>&nbsp;</td>
				<td>
					<select name="ctcb[business_hours]['.$ctcb_value.'][start_hour]">';

						$wtinc = '-1';
						while(23 > $wtinc){
							++$wtinc; 
							$wtincr = sprintf("%02s", $wtinc); 
							echo '<option value="'.$wtincr.'"'.selected( $options['business_hours'][$ctcb_value]['start_hour'], $wtincr ).'>'.$wtincr.'</option>';
						}

				echo '</select>
				<select name="ctcb[business_hours]['.$ctcb_value.'][start_minute]">';
						
					$wtinc = '-1';
					while($wtinc<59){
						++$wtinc;
						$wtincr = sprintf("%02s", $wtinc);
						echo '<option value="'.$wtincr.'" '.selected( $options['business_hours'][$ctcb_value]['start_minute'], $wtincr ).'>'.$wtincr.'</option>';
					}

				echo '</select>
				</td>
				<td>&nbsp;</td>
				<td>
					<select name="ctcb[business_hours]['.$ctcb_value.'][stop_hour]">';

						$wtinc = '-1';
						while(23 > $wtinc){
							++$wtinc;
							$wtincr = sprintf("%02s", $wtinc); 
							echo '<option value="'.$wtincr.'" '.selected( $options['business_hours'][$ctcb_value]['stop_hour'], $wtincr ).'>'.$wtincr.'</option>';								
						}

				echo '</select>
				<select name="ctcb[business_hours]['.$ctcb_value.'][stop_minute]">';

				$wtinc = '-1';
				while($wtinc<59){
					++$wtinc;
					$wtincr = sprintf("%02s", $wtinc);
					echo '<option value="'.$wtincr.'" '.selected( $options['business_hours'][$ctcb_value]['stop_minute'], $wtincr ).'>'.$wtincr.'</option>';										
				}

				echo '</select>
					</td>
				</tr>';
			}

		?>

		</table>



		<hr />
		<h2>Advanced Settings</h2>
		<hr />

	  <table class="form-table" style="margin-top:-0px;">
			<tr valign="top"><th scope="row">Advanced Mode</th>
	    	<td>
	        <label title="Turn advanced mode on">
          	<input type="radio" name="ctcb[advanced]" value="1" <?php checked('1', $options['advanced']); ?>>
            <span>On</span>
          </label><br />
	        <label title="Turn advanced mode off">
          	<input type="radio" name="ctcb[advanced]" value="0" <?php checked('0', $options['advanced']); ?>>
            <span>Off</span>
          </label>
      	</td>
    	</tr>
  	</table>
		<hr />

		<p>Getting your <strong>Desktop Click to Call Button</strong> setup is a little more complicated but should only take you a couple of minutes.</p>
		<p>When your button is clicked on fully featured browsers like Chrome it will turn your website into a telephone and connect your visitor to the number you set.</p>

		<hr />
		<h3>Twilio API</h3>
		<hr />
		<p>The advanced features of this plugin are <a href="https://www.twilio.com/" target="_blank"><strong>powered by Twilio</strong></a>, if you do not have a <a href="https://www.twilio.com/user/account/" target="_blank"><strong>Twilio account</strong></a> you can <a href="https://www.twilio.com/try-twilio" target="_blank"><strong>create one here</strong></a>.</p>
		<p>So that the plugin can communicate with the <a href="https://www.twilio.com/docs/api/" target="_blank"><strong>Twilio API</strong></a> please enter your <strong>AccountSID</strong> and <strong>AuthToken</strong> from your <strong><a href="https://www.twilio.com/user/account/settings" target="_blank">Twilio Account Settings</a></strong> page below.</p>

	  <table class="form-table" style="margin-top:-20px;">
			<tr valign="top"><th scope="row"><label for="accountsid">Account SID</label></th>
	    	<td><input type="text" name="ctcb[accountsid]" id="accountsid" value="<?php echo sanitize_text_field( $options['accountsid'] ) ?>" placeholder="AC098765432109876543210987654321" /></td>
      </tr>
			<tr valign="top"><th scope="row"><label for="authtoken">Auth Token</label></th>
	    	<td><input type="text" name="ctcb[authtoken]" id="authtoken" value="<?php echo sanitize_text_field( $options['authtoken'] ) ?>" placeholder="123456789012345678901234567890" /></td>
      </tr>
    </table>

		<hr />
		<h3>Application ID</h3>
		<hr />
		<p>In order to make outbound calls through the web the plugin needs configuring with the <strong>App ID</strong> of a <a href="https://www.twilio.com/user/account/apps" target="_blank"><strong>TwiML Application</strong></a>.</p>
		<p>Create or configure an App with a <strong>Request URL</strong> of <strong><?php echo get_site_url();?>?click_to_call_button=twilio-request</strong> and a <strong>method</strong> of <strong>HTTP/POST</strong> then enter the <strong>App ID</strong> below.</p> 

	  <table class="form-table" style="margin-top:-20px;">
			<tr valign="top"><th scope="row"><label for="appid">App ID</label></th>
	    	<td><input type="text" name="ctcb[appid]" id="appid" value="<?php echo sanitize_text_field( $options['appid'] ) ?>" placeholder="AP098765432109876543210987654321"/></td>
      </tr>
		</table>

		<hr />
		<h3>Web Telephone Dial Out</h3>
		<hr />
		<p>The <strong>Route Calls To</strong> value is the number you want to calls to be forwarded to; this number needs to be in international format, for example: <i><strong>+12345678909</strong></i> or <i><strong>+4478987654321</strong></i>.</p>
		<p>The <a href="https://www.twilio.com/user/account/phone-numbers/" target="_blank"><strong>Twilio Number</strong></a> value is the <strong>voice capable</strong> number which you will be <strong>called from</strong>.</p>
		<p>The button background color will change to the value set in <strong>button active color</strong> when the button has been clicked and a call is active.</p>
		<p>The <strong>On a Call Alert</strong> text will be shown as a JavaScript confirmation box when a visitor is in an active call and has tried to navigate away from the page. </p>

	  <table class="form-table" style="margin-top:-20px;">

	    <tr valign="top"><th scope="row"><label for="call_to">Route Calls To</label></th>
	    	<td><input type="text" name="ctcb[call_to]" id="call_to" value="<?php echo sanitize_text_field( $options['call_to'] ) ?>" placeholder="+12345678909"  /></td>
	    </tr>

	    <tr valign="top"><th scope="row"><label for="call_from">Twilio Number</label></th>
	    	<td><input type="text" name="ctcb[call_from]" id="call_from" value="<?php echo sanitize_text_field( $options['call_from'] ) ?>" placeholder="+12345678909" /></td>
	    </tr>
	
			<tr valign="top"><th scope="row"><label for="color_active">Button In Call Color</label></th>
      	<td><input name="ctcb[color_active]" id="color_active" type="text" value="<?php echo sanitize_text_field( $options['color_active'] ) ?>" class="active_colour" data-default-color="<?php echo $options['color_active']; ?>" placeholder="<?php echo $options['color_active']; ?>" /></td>
    	</tr>

			<tr valign="top"><th scope="row"><label for="alert">On a Call Alert</label></th>
	    	<td><textarea name="ctcb[alert]" id="alert" maxlength="100" cols="30" rows="3" placeholder="If you leave this page now your call will end!" ><?php echo sanitize_text_field( $options['alert'] ) ?></textarea></td>
    	</tr>

	  </table>

		<hr />
		<h3>Voice Over</h3>
		<hr />
		<p>The plugin comes complete with professionally recorded male and female voice overs. The voice over mp3 files and a copy of the <a href="<?php echo plugins_url( 'audio/script.txt', dirname( __FILE__ ) );?>" target="_blank"><strong>script</strong></a> are stored in <strong><?php echo $vo_path;?></strong> where each voice over has their own directory of files, for example: <strong>male-voice-over</strong> and <strong>female-voice-over</strong>.</p>
		<p>Adding a new voice over is easy: just upload a directory with your recorded files and select it from the list. <strong><a href="https://andymoore.info" target="_blank">Get in touch with me</a></strong> if you'd like me to arrange a professional voice over to record cusom recordings for your business.</p>

	  <table class="form-table" style="margin-top:-20px;">
	    <tr valign="top"><th scope="row"><label for="voiceover">Voice Over</label></th>
	    	<td>
					<select name="ctcb[voiceover]" id="voiceover">
						<?php
						$voiceovers = scandir($vo_path);
						foreach( $voiceovers as $voiceover ){
							if( $voiceover!= '.' && $voiceover != '..' && $voiceover != 'script.txt' ){
								echo '<option value="'.trim( $voiceover ).'" '.($options['voiceover']===trim( $voiceover ) ? 'selected="selected"' : '').'>'.$voiceover.'</option>';
							}
						}
						?>
					</select>
				</td>
	    </tr>
	  </table>

		<hr />
		<h3>Inbound Call Handling</h3>
		<hr />
		<p>This plugin can answer the phone during your hours of business and take voice mail messages outside those hours. To enable this feature create or configure a <a href="https://www.twilio.com/user/account/phone-numbers/" target="_blank"><strong>Twilio Number</strong></a> with a <strong>Request URL</strong> of <strong><?php echo get_site_url();?>?click_to_call_button=twilio-request&amp;answer</strong> and a <strong>method</strong> of <strong>HTTP/POST</strong>.</p>

		<hr />
		<h3>Call Recording and Voicemail Notification</h3>
		<hr />
		<p>You can <strong>record conversations</strong> through your Click to Call button and when you are unable to answer the phone the plugin will turn your website into an <strong>answering machine</strong>.</p>

	  <table class="form-table" style="margin-top:-20px;">

	    <tr valign="top"><th scope="row">Call Recording</th>
	    	<td>
	        <label title="call_record">
	      		<input name="ctcb[recording]" id="call_record" type="radio" value="1" <?php checked('1', $options['recording']); ?> /> Recording Enabled<br />
	      	</label>
	        <label title="call_record">
		        <input name="ctcb[recording]" id="call_record" type="radio" value="0" <?php checked('0', $options['recording']); ?> /> Recording  Disabled
	      	</label>
				</td>
	    </tr>

	    <tr valign="top"><th scope="row">Voicemail Service</th>
	    	<td>
	        <label title="voicemail">
	      		<input name="ctcb[voicemail]" id="voicemail" type="radio" value="1" <?php checked('1', $options['voicemail']); ?> /> Voicemail Enabled<br />
	      	</label>
	        <label title="voicemail">
		        <input name="ctcb[voicemail]" id="voicemail" type="radio" value="0" <?php checked('0', $options['voicemail']); ?> /> Voicemail Disabled
	      	</label>
				</td>
	    </tr>

	    <tr valign="top"><th scope="row">Notification Method</th>
	    	<td>
	        <label title="Email">
	      		<input name="ctcb[notification]" id="notifications_email" type="radio" value="email" <?php checked('email', $options['notification']); ?> /> Email<br />
	      	</label>
	        <label title="Text Message">
		        <input name="ctcb[notification]" id="notifications_sms" type="radio" value="sms" <?php checked('sms', $options['notification']); ?> /> Text Message<br />
	      	</label>
	        <label title="Email and Text Message">
		        <input name="ctcb[notification]" id="notifications_both" type="radio" value="both" <?php checked('both', $options['notification']); ?> /> Email and Text Message
	      	</label>
				</td>
	    </tr>
	
	    <tr valign="top"><th scope="row"><label for="email">Email Address</label></th>
	    	<td><input type="text" name="ctcb[email]" id="email" value="<?php echo sanitize_text_field( $options['email'] ) ?>" placeholder="<?php echo get_option('admin_email');?>"/></td>
	    </tr>
	
		</table>


		<hr />
		<h3>Text Messaging Notifications</h3>
		<hr />

		<p>The <strong>Text To</strong> value is the <strong>international format mobile number</strong> you want your recordings and voicemail messages <strong>sent to</strong>.  

		<p>The <strong>Text From</strong> value needs to be a <strong><a href="https://www.twilio.com/user/account/phone-numbers/" target="_blank">Twilio Number</a></strong> which is <strong>SMS capable</strong>; this is the number that your notification messages will be <strong>sent from</strong>.</p>


	  <table class="form-table" style="margin-top:-20px;">
	    <tr valign="top"><th scope="row"><label for="sms_to">Text To</label></th>
	    	<td><input type="text" name="ctcb[sms_to]" id="sms_to" value="<?php echo sanitize_text_field( $options['sms_to'] ) ?>" placeholder="+12345678909" /></td>
	    </tr>

	    <tr valign="top"><th scope="row"><label for="sms_from">Text From</label></th>
	    	<td><input type="text" name="ctcb[sms_from]" id="sms_from" value="<?php echo sanitize_text_field( $options['sms_from'] ) ?>" placeholder="+12345678909" /></td>
	    </tr>

		</table>

		<hr />
		<h3>SMS Gateway / SMS Autoresponder</h3>
		<hr />

		<p>To enable the <strong>SMS Gateway</strong> / <strong>SMS Autoresponder</strong> configure a <a href="https://www.twilio.com/user/account/phone-numbers/" target="_blank"><strong>Twilio Number</strong></a> which is <strong>SMS enabled</strong> with a <strong>Request URL</strong> set to <strong><?php echo get_site_url();?>?click_to_call_button=sms-request</strong> and a <strong>method</strong> of <strong>HTTP/POST</strong>; then when people text your Twilio SMS line they will be sent the <strong>Default Reply</strong> value. </p>
		<p>The number set in the <strong>Text To</strong> value above can enable and disable the plugin by texting <strong>ON</strong> or <strong>OFF</strong> to any number pointing to the address set above</p>

	  <table class="form-table" style="margin-top:-20px;">

	    <tr valign="top"><th scope="row"><label for="default_reply">Default Reply</label></th>
	    	<td><textarea name="ctcb[default_reply]" id="default_reply" maxlength="160" cols="30" rows="4" placeholder="Thank you for your message. We will be in touch soon." ><?php echo sanitize_text_field( $options['default_reply'] ) ?></textarea></td>
	    </tr>

		</table>

		<span style="float:right;right:0px;bottom:10px;margin-right:20px;position:fixed;">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</span>

		<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>

	</form>

	<hr />
	<h3>Extensible with Action Hooks</h3>
	<p>You can make your own WordPress plugins extend this one through action hooks which are placed at core positions: before a call is answered '<strong>ctcb_pre_twiml_response</strong>', before a text message is replied to '<strong>ctcb_pre_twiml_text_message_response</strong>' and before the service status output is sent to the JavaScript '<strong>ctcb_pre_service_status</strong>'.</p>
	<hr />
	<h3>SMS Keywords to PHP Functions</h3>
	<p>You can <strong>extend the SMS Gateway</strong> with <strong>custom functions</strong> in your WordPress site's <strong>functions.php</strong> file. This works on the concept of <strong>SMS keywords</strong>; a keyword being the first word in an <strong>inbound text message</strong>. For example a user could text <strong>DISCOUNT</strong> and the plugin would check to see if the function <strong>ctcb_sms_discount</strong> exists; if the function is found the plugin will <strong>reply with the function's return value</strong>. Please ensure your function names start <strong>ctcb_sms_</strong> folowed by your keyword in <i>lower case</i>, example: <strong>ctcb_sms_demo</strong></p>

	<hr />
	<h2>Custom Upgrades Available</h2>
	<hr />
	<p>If you'd like me to extend the plugin with additional features please <strong><a href="https://andymoore.info" target="_blank">get in touch with me</a></strong> and tell me your requirements. </p>

	<hr />
	<div style="padding-top:10px;">
		<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=andy%40andymoore%2einfo&lc=GB&item_name=Click%20to%20Call%20Plugin%20install%20at%20<?php echo get_site_url();?>&item_number=ctcb_v<?php echo CTCB_VERSION;?>&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest" target="_blank">
			<img src="<?php echo plugins_url( 'images/paypal_donate_button.gif', dirname( __FILE__ ) );?>" />
		</a>
	</div>

	<hr />
	<p style="color:gray;"><i>Donate via BitCoin to 1GuZAhJnZbvbh5MDCn9GQY6GCMHsHfqywK<br />Thank you for using my plugin! <a href="https://andymoore.info" target="_blank" style="text-decoration:none;">Andy Moore</a></i></p>

<?php 
}

function ctcb_register_admin_panel() {
	add_submenu_page( 'options-general.php', 'Click to Call Button', 'Click to Call Button', 'manage_options', 'click-to-call-button', 'ctcb_admin_panel' );
}
add_action( 'admin_menu', 'ctcb_register_admin_panel' );

function ctcb_options_init() {
	register_setting( 'ctcb_options','ctcb' );
}
add_action( 'admin_init', 'ctcb_options_init' );

function ctcb_enqueue_admin() {
		wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url( 'admin/ctcb_admin.js', dirname( __FILE__ ) ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'ctcb_enqueue_admin' );

