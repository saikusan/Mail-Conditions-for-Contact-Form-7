# Mail Conditions for Contact Form 7

Mail Conditions for Contact Form 7 checks for if-conditions inside sent mails by Contact Form 7 helping you to create dynamic mails.

## Description

This plugin becomes active before Contact Form 7 sents a mail. It looks through the body to find if-conditions written in shortcode-style and evaluates them. Based on that, the content inside the if statement will be included in the mail or not.
 
**DO NOT use nested conditions, it won't work.**

Examples:

* ```[if mail]Contact mail: [mail][/if]```
* ```[if subject="Error"]ERROR[/if]```
* ```[if radio="Yes"]Chosen option: YES[else]Chosen option: NO[/if]```

## Installation

1. Copy mail-conditions-for-contact-form-7 inside your plugins folder.
2. Activate the plugin.

## Frequently Asked Questions

Can I do something like ```[if][if][/if][else][/if]```? No support for nested conditions yet.

# Changelog

### 1.1.0
Release Date - 5 July 2016
- Updated the plugin to work with the latest Contact Form 7 and WordPress release.
- Improved shortcode detection.

### 1.0.0
Release Date - 4 August 2015
- Initial release.