=== Mail Conditions for Contact Form 7 ===
Contributors: saikuro
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5RXFBQ5ZHL64S
Tags: contact form 7, dynamic mail, conditional mail, forms
Requires at least: 3.9
Tested up to: 4.2.2
Stable tag: trunk
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html

Mail Conditions for Contact Form 7 checks for if-conditions inside sent mails by Contact Form 7 helping you to create dynamic mails.

== Description ==

This plugin becomes active before Contact Form 7 sents a mail. It looks through the body to find if-conditions written in shortcode-style and evaluates them. Based on that, the content inside the if statement will be included in the mail or not.
 
**DO NOT use nested conditions, it won't work.**

Examples:

* [if mail]Contact mail: [mail][/if]
* [if subject="Error"]ERROR[/if]
* [if radio="Yes"]Chosen option: YES[else]Chosen option: NO[/if]

== Installation ==

1. Copy mail-conditions-for-contact-form-7 inside your plugins folder.
2. Activate the plugin.

== Frequently Asked Questions ==

= Can I do something like [if][if][/if][else][/if] ? =
It's not possible at the moment.

== Changelog ==

= 1.0.0 =
*Release Date - 4 August 2015*

* Initial release.