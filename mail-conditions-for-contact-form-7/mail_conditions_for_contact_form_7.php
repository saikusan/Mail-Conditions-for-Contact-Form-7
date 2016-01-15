<?php

/*
  Plugin Name: Mail Conditions for Contact Form 7
  Description: Helps to create mail conditions in Contact Form 7.
  Version: 0.1
  Author: Saikuro
  Author URI: https://twitter.com/saikuro
  License: GPLv3
  License URI: http://www.gnu.org/licenses/gpl.html
  Text Domain: mail-conditions-cf7
  Domain Path: /languages/
 */

/*
  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This plugin becomes active before Contact Form 7 sents a mail. It looks through the body
 * to find if-conditions written in shortcode-style and evaluates them. Based on that, the content
 * inside the if statement will be included in the mail or not.
 * 
 * DO NOT use nested conditions, it won't work.
 *
 * @example
 * [if mail]Contact mail: [mail][/if]
 * [if subject="Error"]<h2>ERROR</h2>[/if]
 * [if radio="Yes"]Chosen option: YES[else]Chosen option: NO[/if]
 *
 * @package default
 * @author Claudio Ilea
 * */
class Mail_Conditions_CF7 {

    /**
     * Creates a new instance of the Mail Conditions plugin.
     *
     * @return Mail_Conditions_CF7
     * */
    public function __construct() {
        $this->init_admin();
        $this->init_action();
        $this->regexp = '/\[if\s+(\S+?)\s*=\s*["\']([\S\s]+?)["\']\s*\]([\S\s]*?)(?:(?:\[else\])([\S\s]*?))*?\[\/if\]/';
    }
    
    /**
     * Starts admin specific tasks.
     * 
     * @return void
     */
    public static function init_admin() {
        load_plugin_textdomain('mail-conditions-cf7', false, basename(dirname(__FILE__)) . '/languages/');
    }

    /**
     * Takes the body of the mail, evaluates it and sets it back.
     * 
     * @param [Object] The $WPCF7_ContactForm object.
     * @return void
     */
    public function prepare_body($cf7) {
        $mail = $cf7->prop('mail');
        $mail['body'] = $this->evaluate($mail['body']);
        $cf7->set_properties(array('mail' => $mail));
    }

    /**
     * Takes the body string and modifies it based on the if-conditions.
     * 
     * @param [String] $mail_body
     * @return [String]
     */
    private function evaluate($mail_body) {
        $submission = WPCF7_Submission::get_instance();
        $updated_email_body = $mail_body;
        $matches = array();
        $num_matches = preg_match_all($this->regexp, $updated_email_body, $matches);

        for ($i = 0; $i < $num_matches; $i++) {
            $expression = $matches[0][$i];
            $variable = $matches[1][$i];
            $value = $matches[2][$i];
            $if_true = $matches[3][$i];
            $if_false = $matches[4][$i];

            $mail_variable_value = $submission->get_posted_data((string) $variable);

            if ($mail_variable_value == $value) {
                $updated_email_body = str_replace($expression, $if_true, $updated_email_body);
            } else if (isset($if_false)) {
                $updated_email_body = str_replace($expression, $if_false, $updated_email_body);
            } else {
                $updated_email_body = str_replace($expression, '', $updated_email_body);
            }
        }

        return $updated_email_body;
    }

    /**
     * Initializes the CF7 action.
     */
    private function init_action() {
        add_action("wpcf7_before_send_mail", array($this, 'prepare_body'));
    }

}

new Mail_Conditions_CF7;
