<?php

// generate the public side of the function
if( get_option( 'ctcb' ) ) {
	
	// to style the button we need to inject some css into the header
	function ctcb_header_inject() {

		// allow other plugins to hook into the header as a replacement to this
		do_action( 'ctcb_pre_header_inject' );

		// bring in the options 
		$options = ctcb_get_options();

		// build a swtich that works through the 4 possible positions the button can be shown in
		switch( true ) {
			case ( $options['positioning']==='left' );
				$ctc_values['style']['left_position'] = 'left:0;';
				$ctc_values['style']['button_width'] = 'width:60px;';
			break;
			case ( $options['positioning']==='middle' );
				$ctc_values['style']['left_position'] = 'left: 0; right: 0; margin: auto;';
				$ctc_values['style']['button_width'] = 'width:60px;';
			break;
			case ( $options['positioning']==='full' );
				$ctc_values['style']['left_position'] = 'left:0;';
				$ctc_values['style']['button_width'] = 'width:100%;';
			break;
			case ( $options['positioning']==='right' );
			default;
				$ctc_values['style']['left_position'] = '';
				$ctc_values['style']['button_width'] = 'width:60px;right:0;';
			break;
		} // ends positioning css switch

		// generate the styleheet
		$return = '

<!-- click to call button header code starts here -->

<style> 
	
	#click_to_call_button {
		background:url('.plugins_url( 'images/phone-icon-ready.png', dirname( __FILE__ ) ).') center 10px no-repeat '.esc_html( $options['color_ready'] ).';
		text-align:center;
		'.$ctc_values['style']['button_width'].'
		'.$ctc_values['style']['left_position'].'
		display:none;
		opacity: '.$options['opacity'].';
		height:60px; 
		position:fixed; 
		bottom:-10px; 
		z-index:9999;
		border-top-left-radius:'.$options['radius'].'px;
		border-top-right-radius:'.$options['radius'].'px;
	} 
	body {
		padding-bottom:25px;
	}
	#click_to_call_button:focus {outline:none;}

</style>

<!-- click to call button header code ends here -->';

			echo $return;

	} // ends ctcb_header_inject
	
	// make this hook into the header of the page
	add_action( 'wp_head', 'ctcb_header_inject' );

	// we also need to inject the button itself and the javascript to initiate calls into the footer
	function ctcb_footer_inject() {

		// allow other plugins to hook into the header as a replacement to this
		do_action( 'ctcb_pre_ctcb_footer_inject' );

		// bring in the options 
		$options = ctcb_get_options();
		
		// generate the javascript
		$return = '
			
<!-- click to call button footer code starts here -->

<a href="tel:'.$options['public_number'].'" id="click_to_call_button" class="click_to_call" onclick="" data-status="" data-token="" data-libraries=""></a>

<script type="text/javascript">

	function ctcb_load_remote_js_resource(url, callback) {
		var head = document.getElementsByTagName("head")[0];
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = url;
		script.onreadystatechange = callback;
		script.onload = callback;
		head.appendChild(script);
	};
	
	var ctcb_check_user_has_flash = function() {
		var isFlashExists = swfobject.hasFlashPlayerVersion("1") ? true : false ;
		if (!isFlashExists) {
			var noflashplugin = true;
		}
		if (!ctcb_check_user_has_user_media()) {
			var nousermedia = true;
		}
		if(noflashplugin && nousermedia) {
			if(screen.width<=999) {
				document.getElementById("click_to_call_button").style.display = "block";
				if(window.ga && ga.create) {
					document.getElementById("click_to_call_button").setAttribute("onclick","ga(\'send\', \'event\', \'click to call button\', \'mobile click\')")
				}
				setTimeout(ctcb_check_status, 5000);
			}
		}else{
			ctcb_load_remote_js_resource("https://static.twilio.com/libs/twiliojs/1.1/twilio.min.js", ctcb_loaded_twilio_client);
		}
	};

	var ctcb_loaded_twilio_client = function() {
		document.getElementById("click_to_call_button").setAttribute("data-libraries", "true");
		var data_element = document.getElementById("click_to_call_button");
		var token = data_element.getAttribute("data-token");
		Twilio.Device.setup( token, {
		 } 
		);

		Twilio.Device.ready(function (device) {
      device.sounds.outgoing(false);
      device.sounds.disconnect(false);
			document.getElementById("click_to_call_button").style.display = "block";
			document.getElementById("click_to_call_button").style.backgroundColor = "'.esc_html( $options['color_ready'] ).'";
			document.getElementById("click_to_call_button").setAttribute("onclick","ctcb_click_to_call_start();return false;")
			setTimeout(ctcb_check_status, 5000);
		});
		
		Twilio.Device.offline(function (device) {
			if(window.ga && ga.create) {
				ga("send", "event", "click to call button", "offline");
			}
			document.getElementById("click_to_call_button").style.display = "none";
		});
		
		Twilio.Device.error(function (error) {
			ctcb_click_to_call_stop("1");
		});
		
		Twilio.Device.disconnect(function (conn) {
			document.getElementById("click_to_call_button").setAttribute("data-status", "");
			document.getElementById("click_to_call_button").style.backgroundColor = "'.esc_html( $options['color_ready'] ).'";
			document.getElementById("click_to_call_button").setAttribute("onclick","ctcb_click_to_call_start();return false;");
		});

	};
	
	function ctcb_check_user_has_user_media() {
		return !! (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
	}
	
	function ctcb_click_to_call_start() {
		if(window.ga && ga.create) {
			ga("send", "event", "click to call button", "start");
		}
		document.getElementById("click_to_call_button").style.backgroundColor = "'.esc_html( $options['color_active'] ).'";
		document.getElementById("click_to_call_button").style.backgroundImage = "url('.plugins_url( 'images/phone-icon-active.png', dirname( __FILE__ ) ).')";
		document.getElementById("click_to_call_button").setAttribute("data-status", "busy");
		Twilio.Device.connect({});
		document.getElementById("click_to_call_button").setAttribute("onclick","ctcb_click_to_call_stop();return false;")
	}

	function ctcb_click_to_call_stop(err) {
		document.getElementById("click_to_call_button").setAttribute("data-status", "");
		if(window.ga && ga.create && err != "1") {
			ga("send", "event", "click to call button", "stopped");
		}
		Twilio.Device.disconnectAll();
		document.getElementById("click_to_call_button").style.backgroundColor = "'.esc_html( $options['color_ready'] ).'";
		document.getElementById("click_to_call_button").style.backgroundImage = "url('.plugins_url( 'images/phone-icon-ready.png', dirname( __FILE__ ) ).')";
		document.getElementById("click_to_call_button").setAttribute("onclick","ctcb_click_to_call_start();return false;")
	}

	function ctcb_check_status(){
		var xmlhttp;
		if (window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}else{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				if(xmlhttp.responseText === "off"){

			    var data_element = document.getElementById("click_to_call_button");
			    var status = data_element.getAttribute("data-status");

					if(status != "busy"){
						if(document.getElementById("click_to_call_button").style.display==="block"){
							document.getElementById("click_to_call_button").style.display = "none";
						}
					}
	
					setTimeout(ctcb_check_status, 5000);
	
				}else if(xmlhttp.responseText === "on"){
				
					if(screen.width<=999) {
						document.getElementById("click_to_call_button").style.display = "block";
						if(window.ga && ga.create) {
							document.getElementById("click_to_call_button").setAttribute("onclick","ga(\'send\', \'event\', \'click to call button\', \'mobile click\')")
						}
					}else{
						if(document.getElementById("click_to_call_button").style.display==="block"){
							document.getElementById("click_to_call_button").style.display = "none";
						}
					}									
					setTimeout(ctcb_check_status, 5000);
				}else{
	
					mode = xmlhttp.responseText.split("!",2);
					
					if ( mode[0] === "advanced" ) {

						var token = mode[1];
						document.getElementById("click_to_call_button").setAttribute("data-token", token);

						var data_element = document.getElementById("click_to_call_button");
						var loaded = data_element.getAttribute("data-libraries");

						if( loaded === "true"){
							if(document.getElementById("click_to_call_button").style.display!="block"){
								document.getElementById("click_to_call_button").style.display = "block";
							}
							setTimeout(ctcb_check_status, 5000);
						}else{
							ctcb_load_remote_js_resource("https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js", ctcb_check_user_has_flash);
						}
					}
				}
			}
		}
		xmlhttp.open("GET","'.get_site_url().'?click_to_call_button=service-status&" + Math.random(),true);
		xmlhttp.send();
	}

	function ctcb_load_ctcb() { 
		setTimeout(function() { 
			ctcb_check_status();
		}, '.$options['delay_seconds'].'000);
	}

	function ctcb_check_call_not_live_on_page_exit(e) {

		var data_element = document.getElementById("click_to_call_button");
		var status = data_element.getAttribute("data-status");

		if(status === "busy"){
			if(!e) e = window.event;
			e.cancelBubble = true;
			e.returnValue = "'.esc_js( $options['alert'] ).'";
			if (e.stopPropagation) {
				e.stopPropagation();
				e.preventDefault();
			}
		}
	}

	window.onload = ctcb_load_ctcb;
	window.onbeforeunload = ctcb_check_call_not_live_on_page_exit;

</script>

<!-- click to call button footer code ends here -->';
			
			echo $return;
		} // ends ctcb_footer_inject function
		
		// make this hook into the footer of the page
		add_action('wp_footer', 'ctcb_footer_inject');


} // ends generating public side of the button 
