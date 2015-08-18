=== Click to Call Button ===

Contributors: AndyMoore
Donate link:https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=andy%40andymoore%2einfo&lc=GB&item_name=Click%20to%20Call%20Plugin&item_number=ctcb_donate_link&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHostedGuest
Tags: click to call button, click to call, call now button, answering machine, voicemail, sms, text messaging, sms gateway, sms autoresponder, sms to email, twilio, twilio client, webrtc
Requires at least: 3.5
Tested up to: 4.2.2
Stable tag: 0.0.1
License: GPLv2 or later

Shows a Click to Call / Call Now Button to your visitors and turns your website into a phone with call recording, voicemail and SMS.

== Description ==

Research has proven **click to call buttons on mobile friendly websites raise conversions, increase revenues and customer satisfaction**. The easier you make it for your visitors to call you the more times your phone will ring, it really is that simple!

This plugin was built to help get my own phone ringing. It soon became something more powerful which could answer the phone, record calls, take voicemail when I wasn't around and automatically reply to text messages. 

= Basic version =

This "**Click to Call Button**" / "**Call Now Button**" plugin will show an icon to your visitors on mobile devices which makes it easy for them to call you. 

This link uses the '*tel*' link protocol which instructs mobile phones to prompt the user to confirm their intent to call, here's an example link:

    &#x3C;a href=&#x22;tel:+447987654321&#x22;&#x3E;Call Me!&#x3C;/a&#x3E;

The button can be styled with options for different colors; curves on corners, transparency / opacity plus control over where it is placed.

The settings page for the plugin lets you specify what days and times the button should be displayed on your site; it then uses JavaScript to show and hide itself automatically.

You can choose to show the button the moment a page loads or you can wait thirty, sixty or ninety seconds before making it visible. 

The button will automatically include Google Analytics *onclick events tracking* so you can monitor the number of calls you get.

If you're only running the basic version of the plugin the button will be hidden on large screen browsers. That's the biggest limitation of all the click to call and call now button plugins which use the tel link protocol: they don't work on desktop machines with fully featured browsers like Chrome! That's why I wrote some advanced options into the plugin to overcome that restriction. 

= Advanced version =

**The advanced options of the plugin turns your website into a telephone with call recording, voicemail and SMS / text message features thanks to the [Twilio API](https://www.twilio.com/docs/api).**

*Please note: you do not need a Twilio account to use the basic features of the plugin, only the advanced ones.*

Using **WEBRTC** (*web real time communications*) it is possible to turn browsers into telephones which enable your users to click and call from their computer, no additional software is required, the user simply clicks the icon and grants your website access to their microphone, see screenshots.

Within moments the phone number you set in the options will start ringing and you'll be able to chat with your visitor; the only difference is instead of them using a phone to call you they're using the microphone and speakers on their computer to chat with you. 

The user doesn't have to fill in any forms as they call through their computer; this gives them instant satisfaction waiting for a callback; they don't need any extra software and most modern browsers are supported. If your user's browser does not support the features needed to make a phone call through the web the button will be hidden from their view. 

**Advanced features:**

* **Inbound Call Handler** You can point an unlimited amount of Twilio numbers to the plugin and have them forward calls to the number you set; see the settings page for the Request URL you need to configure your numbers with. 

* **Call Recording** Call recording can easily be enabled or disabled. This records both calls through the website button and inbound phone calls. 

* **Answering Machine / Voicemail** When you are unable to take a call the built in answering machine will ask your callers to leave a message. This also works on both the button and inbound phone calls. 

* **SMS and email notifications** Get recordings of calls and voicemail messages sent to you by SMS text message, email or both.

* **Control the plugin by SMS** If you point a SMS capable Twilio Number to the plugin you will be able to turn the service on and off by texting *on* or *off* to that number. See the settings page for the Request URL to point your numbers to. This gives you control over the button when you're away from your desk; at the airport departure lounge or just playing golf!

* **SMS forwarder** You can point any number of SMS capable Twilio numbers at the plugin and each time someone texts your number they will receive your default reply and you'll get their message forwarded on to you by SMS, email or both. This tiny feature turns your site into an SMS to email client and makes it easy to get your inbound text messages sent to an inbox. 

* **SMS Keywords to PHP Functions** The first word of any inbound text message is called a 'keyword', the plugin maps keywords to PHP functions which make the text message gateway flexible and extensible. Start your function names with ctcb_sms_ followed by the keyword, for example: ctcb_sms_hello, this function would then be executed each time you received a message starting with the word hello. 

* **Action Hook'able** There are action hooks at the core points in the plugin so that you can write your own plugins to extend the functionality of this one. 

== Installation ==

Extract the zip file and upload the click_to_call_button directory to your wp-content/plugins/ directory of your WordPress installation and then activate the plugin.

**Basic Configuration**

Under the settings menu you should then see the link to the plugin's settings page, click that and follow this quick setup guide:

* **Plugin Active**: set to 'Yes'
* **Phone Number**: enter the phone number you want people to call, this must be in *international format* for example *+12345678909 or +447987654321*
* **Button Color**: use the color picker and select the color which compliments your site's design the best.
* **Button Position**: this allows you to select where you want the button to be shown on the bottom of the screen
 * Full Screen Bottom
 * Bottom Left 
 * Bottom Center 
 * Bottom Right
* **Button Corners**: this allows you to control how curved your button is
 * Square Edges
 * Small Curves 
 * Big Curves
 * Rounded Top
* **Transparency**: take control over how much emphasis the button has
 * Strong: No transparency 
 * Stylish: 50% transparency 
 * Subtle: 75% transparency
* **Show After Seconds**: gives you control over when the button is show
 * Show upon page load 
 * Show after 30 seconds 
 * Show after a minute
 * Show after 90 seconds
* **Hours of Business**: set the start and stop times for each day of the week, this automatically defaults to 0900 to 1700 Monday through Friday and is disabled at the weekend.
* Save the settings then use your mobile phone to navigate to your site and you should see the button, click it and check you've got the right number then you're sorted with the basic version!

**Advanced configuration**

**Please make sure your basic click to call button is working before you take the steps required to enable the advanced features.**

**The advanced features of this plugin require a Twilio Account. Create a [Twilio Account here](https://www.twilio.com/try-twilio).**

So that the plugin can communicate with the Twilio API it needs to know two values from from your Twilio Account Settings page; they are Account SID and Auth Token. It also needs an App ID plus at least one voice capable number, ideally a voice and SMS capable number. 

* **Advanced Mode**: set to 'On'
* Enter the '**Account SID**' value 
* Enter the '**Auth Token**' value.
* Create or configure a Twilio App with the request URL the plugin gives ou on the settings page, then enter the '**App ID**' value.
* Enter the number you want Twilio to phone in the '**Route Calls To**' value; this needs to be in *international format* for example: *+12345678909 or +447987654321*
* In the '**Twilio Number**' field you need to enter a Voice Capable Twilio Number. This is the number which you will be called from.
* The '**Button In Call Color**' is the color the button will turn when a call is active. 
* The '**On a Call Alert**' will only be shown to visitors if they are on an active call with you and try to navigate away from the page, if we don't stop them leaving the page it's like them hanging up the phone on you.
* Select either the male of female '**Voice Over**' from the list 
* Choose if you want '**Call Recording**' enabled or disabled.
* Choose if you want the '**Voicemail Service**' enabled or disabled.
* Select a '**Notification Method**' or how you want to be notified about recordings and voicemail messages: Email, Text Message or Email and Text Message.
* Enter the '**Email Address**' you want the recordings sent to. 
* To receive text message notifications in the 'Text To' value enter the international mobile number you want the messages sent to.
* In the '**Text From**' value you need to enter the number of a SMS Capable Twilio number, this is the number which will send the messages to you.
* If you wish to use the plugin as a SMS autoresponder enter the '**Default Reply**' value and make sure your SMS Twilio number is pointing to the Request URL the plugin specifies. 

== Frequently Asked Questions ==

= Do I need a Twilio account to show the basic button? =

No. You only need a Twilio account if you want to take advantage of the advanced features in the plugin. 

= Can I change the icon? =

I wanted to keep the icon uniform on all the sites that use the plugin in the hope that end users will be able to associate the button with the ability to call through the web; that's why there's not actually an option to change the icon. However, if you really want to change the icons just replace the two files in the plugin's images directory and you should be sorted. The icons used are 32px by 32px and came from [Flat Icon](http://www.flaticon.com/search/phone).

= I'm not seeing the button, why not? =

If you're using the basic version of the plugin and are viewing your site on a desktop computer or laptop through a fully featured browser you will not see the button as it is only visible on mobile devices. Check your site on a mobile and you should see the button.

If you still don't see the button when viewing the site on a phone check that the plugin is enabled then check the hours of business, it could be that you're trying to view the button outside those hours. 

= How do I format / enter my phone number? =

You need to enter all phone numbers on the settings page in full international format including the plus sign at the start, for example: +12345678909 or +447987654321. 

[Twilio Guide to Formatting International Phone Numbers](https://www.twilio.com/help/faq/phone-numbers/how-do-i-format-phone-numbers-to-work-internationally).

= What are the browser requirements to turn it into a phone? =

See [Minimum Web Browser Requirements for Twilio Client](https://www.twilio.com/help/faq/twilio-client/what-are-the-minimum-system-requirements-for-twilio-client).

Also see [Which browsers support WebRTC?](https://www.twilio.com/help/faq/twilio-client/which-browsers-support-webrtc).

= Can I record my own voiceovers? =

Yes. You can record your own voice prompts or hire a professional voiceover to record them for you. 

The details below include details of the file names used and the suggested wording; please record your files in mp3 format (*44,100 / mono*) and make sure your file names match: this will ensure the system can use the files. 

> **Voiceover files and script**

> * **thank-you.mp3** "*Thank you*" This is played through the browser when a visitor to your website has clicked your click to call button.

> * **hello-and-thank-you-for-calling.mp3** "*Hello and thank you for calling*" This is played down the phone to anyone who calls one of your Twilio numbers which has a request URL pointing to the plugin.

> * **about-to-connect.mp3** "*I will try to connect your call*" This is played before the plugin attempts to connect the call to the number you specified in the settings page.

> * **calls-are-recorded.mp3** "*Please note all calls are recorded*" This is only played when you've chosen to record calls through the plugin.

> * **im-sorry.mp3** "*I'm sorry*" This is played when something hasn't gone to plan.

> * **closed.mp3** "*Lines are currently closed*"

> * **no-answer.mp3** "*There was no answer*"

> * **cant-connect.mp3** "*I was unable to connect your call*" 

> * **engaged.mp3** "*That number is busy*"

> * **please-leave-your-message-after-the-tone.mp3** "*Please leave your message after the tone, you'll have sixty seconds, remember to include your name, mobile number and email address*" This is only heard if you have voicemail enabled.

> * **thank-you-for-calling-and-goodbye.mp3** "*Thank you for calling and goodbye*"

Once you have your recordings store them in a folder with a name that makes sense, for example: custom-voice-recording-files, then upload that folder to the audio directory, navigate to the plugin's settings page and you will see the voiceover in the list, select the voice you want to use and save your settings.

To test your new recordings just click your button or place a call to any Twilio number which has a request URL of the plugin and you should hear the new prompts you just added to the system. 

Please note: deleting the plugin will also delete any custom recordings you upload. 

= How does the 'SMS Keyword to PHP Functions' feature work? =

The first word of any received text message is called the 'keyword' and upon receipt of a message the plugin will check to see if there's a function for that keyword; this means the plugin doubles up as a powerful text message / SMS gateway which can perform almost any task. 

You can create your own custom functions in your WordPress site's functions.php file, these functions need to start **ctcb_sms_** followed by your keyword, for example if the user sent "**DISCOUNT**" the script would check to see if a function named **ctcb_sms_discount** exists, if it does it will reply to the user with the return of the function. 

An example function for the keyword DISCOUNT:

    function ctcb_sms_discount(){
     return "Show this text in store to get a 10% discount on your next order!"
    }

All of the POST values from the Twilio request are available to your function, core values are 'From' which is the international format mobile number which sent the text to you; plus 'Body' which is the full contents of the message the user sent. The Body value can be exploded by a space to give you all the individual words used in the message; this opens up further possibilities, for example 'WEATHER LONDON' or 'WEATHER PARIS' could connect to a remote API and return the forecast for the city which formed the second word. 

If there is no keyword function set the plugin will automatically respond to the user with the contents of the default reply value from the settings page.

= Can the plugin be made to do X / Y / X? =

Yes. The plugin is extensible through action hooks at core points in the execution; this makes it easy for you to build your own plugins around this plugin without having to touch the core code.

= Can you make it do X / Y / X for me? = 

I'd be happy to help extend the plugin for you. [Get in touch](https://andymoore.info/).

== Screenshots ==

1. The Click to Call Button on my website; viewed with an iPhone.
2. Once I click the button my iPhone asks me to confirm my intent to place a call; the number shown is a Twilio number which is powered by this plugin and that value can be configured on the plugin's settings page. 
3. Advanced mode - button dormant: The Click to Call Button in action on my laptop; viewed with the latest version of the Chrome browser the button. The color can be changed in the settings page to match the look and style of your wite. 
4. Advanced mode - button clicked: The button will change to the color you specify in the settings page once it has been clicked. 
5. Advanced mode - microphone access: The browser will ask your visitor if it can have access to their microphone; if your website is SSL secure (https) the browser will only ask this once, on unsecure sites (http) it will ask the user to confirm every time they click the button. 
6. Advanced mode - microphone live status: in the title bar of the browser (right at the very top of the screen) there should be an icon that indicates the microphone is live.
7. The end result. My phone ringing with a call through my click to call button.
8. Phone number field from settings page. The number you enter needs to be in international format, for example: +12345678909 or +4478987654321.
9. Button color, position, corners, transpaency and delay settings. These options give you control over where the button is placed and how it will appear. 
10. Hours of business schedule. The button will only be visible during the hours of business you set. When a Twilio Number is routed to the plugin any calls outside these hours will be given the option to leave voicemail if it is enabled. 
11. Browser requesting to use the microphone. 
12. Title bar in browser changes to reflect in call status.
13. Twilio AccountSID and AuthToken fields from the settings page.
14. Twilio 'Request URL' field from both numbers and apps pages.
15. App ID field from the settings page.
16. Advanced call routing options for the plugin.
17. Call recording and voicemail settings and notification options.
18. SMS configuration settings. 

== Changelog ==

= 0.0.1 =
* First version released!

== Upgrade Notice ==
 
There are no upgrades available yet. 
 
