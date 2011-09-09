<?php
/**
 * SendGrid Web PHP API ...
 *
 * Copyright (C) 2011  Alon Ben David
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/gpl-3.0.txt>.
 *
 *
 * @author Alon Ben David - CoolGeex.com
 * 
 * All the methods returns an array of data or one string / int
 * If false returned you can run getLastResponseError() to see the error information
 * If error information == NULL then no error accrued (like deleting a record returns 0 records deleted if no record found)
 * 
*/

require_once "sendgrid/web.php";


$sg_user = 'YOUR_SEND_GRID_USER'; 
$sg_api_key = 'YOUR_SEND_GRID_PASSWORD';

//Creates a new SendGrid Web API object to make calls with
/*
 * YOU CAN ALSO SET $debug to true for DEBUGGING and $curl_ssl_verify to false for disabling cert verification
 * ($user, $key , $debug = false , $curl_ssl_verify = true)
 *
*/ 
$sendgridweb = new sendgridWeb($sg_user,$sg_api_key); 

/**
 * Retrieve a list of bounces with addresses and response codes, optionally with dates.
 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks. 
 */
$sendgridweb->bounces_get($date = '' , $days = '' , $start_date = '' , $end_date = ''); 

/**
 * Delete an address from the Bounce list.
 * @param string $email - Email bounce address to remove
 */
$sendgridweb->bounces_delete($email); 

/**
 * Retrieve a list of Blocks with addresses and response codes, optionally with dates.
 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks. 
 */
$sendgridweb->blocks_get($date = '' , $days = '' , $start_date = '' , $end_date = ''); 

/**
 * Delete an address from the Block list.
 * @param string $email - Email bounce address to remove
 */
$sendgridweb->blocks_delete($email); 

/**
 * Retrieve email parse settings.
 */
$sendgridweb->email_parse_get(); 

/**
 * Specify the hostname and url for parsing incoming emails.
 * @param string $hostname - hostname for parsing incoming mail
 * @param string $url - url for parsing incoming mail
 * @param string $spam_check - to check spam set to 1 (default is NO);
 */
$sendgridweb->email_parse_set( $hostname , $theurl , $spam_check = 0); 

/**
 * Edit existing email parse settings.
 * @param string $hostname - hostname for parsing incoming mail
 * @param string $url - url for parsing incoming mail
 * @param string $spam_check - to check spam set to 1 (default is NO);
 */
$sendgridweb->email_parse_edit( $hostname , $theurl , $spam_check = 0);

/**
 * Edit existing email parse settings.
 * @param string $hostname - hostname for parsing incoming mail
 */
$sendgridweb->email_parse_delete( $hostname ); 

/**
 * Retrieve notification URL.
 */
$sendgridweb->event_posturl_get();

/**
 * Update notification URL.
 * @param string $theurl - The URL to receive event notifications
 */
$sendgridweb->event_posturl_set( $theurl ); 

/**
 * Delete notification URL.
 */
$sendgridweb->event_posturl_delete(); 

/**
 * Get a list of available Apps.
 */
$sendgridweb->filter_get( $theurl ); 

/**
 * Update notification URL.
 * @param string $name - name of the App to activate
 */
$sendgridweb->filter_activate( $name ); 

/**
 * Update notification URL.
 * @param string $name - name of the App to deactivate
 */
$sendgridweb->filter_deactivate( $name ); 

/**
 * Change the settings in an App.
 * @param string $name - name of the App to setup
 * @param array $postData - App settings (Name & data);
 * app settings can be found here: http://docs.sendgrid.com/documentation/api/web-api/filtersettings/
 */
$sendgridweb->filter_setup( $name , $postData ); 
/**
 * get app settings.
 * @param string $name - name of the App to get
 */
$sendgridweb->filter_getsettings( $name ); 

/**
 * Retrieve a list of email addresses that are invalid.
 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks.
 */
$sendgridweb->invalid_emails_get( $date = '' , $days = '' , $start_date = '' , $end_date = '' ); 

/**
 * Delete an address from the Invalid Email list.
 * @param string $email - Email Invalid Email address to remove
 */
$sendgridweb->invalid_emails_delete( $email ); 

/**
 * This module allows you to send email.
 * @param string/array $to - This can also be passed in as an array, to send to multiple locations
 * @param string/array $toname - Must be a string. If to parameter is an array, toname must be an array with the exact number of array elements as the to field 
 * @param array $xsmtpapi - PHP headers - check here: http://docs.sendgrid.com/documentation/api/smtp-api/
 * @param string $subject - The subject of your email
 * @param string $html - The actual content of your email message. HTML for the user to display
 * @param string $text - The actual content of your email message. TEXT for the user to display
 * @param string $from - This is where the email will appear to originate from for your recipient
 * @param string $bcc - This can also be passed in as an array of email addresses for multiple recipients
 * @param string $fromname - This is name appended to the from email field. IE – Your name or company name
 * @param string $replyto - Append a reply-to field to your email message
 * @param string $date - Specify the date header of your email. One example: “Thu, 21 Dec 2000 16:01:07 +0200″. PHP developers can use: date(‘r’);;
 * @param array $headers - PHP headers - check here: http://docs.sendgrid.com/documentation/api/smtp-api/
 * @param array $files - an array of file names and paths
 * EX: $files = array('filename1' => 'filepath' , 'filename2' => 'filepath2',);
*/
$sendgridweb->mail_send( $to , $toname = '' , $xsmtpapi = '' , $subject , $html , $text , $from , $bcc ='' , $fromname='' , $replyto='' , $date='' , $files='' , $headers=''); 

/**
 * Get profile information.
 */
$sendgridweb->profile_get(); 

/**
 * Selectively update multiple profile fields.
 * @param string $first_name - Your first name
 * @param string $last_name - Your last name
 * @param string $address - Company address
 * @param string $city - City where your company is located
 * @param string $state - State where your company is located
 * @param string $country - Country where your company is located
 * @param string $zip - Zipcode where your company is located
 * @param string $phone - Valid phone number where we can reach you
 * @param string $website - Your company’s website
 */
$sendgridweb->profile_set( $first_name ='' , $last_name ='' , $address ='' , $city ='' , $state ='' , $country ='' , $zip ='' , $phone ='' , $website =''); 

/**
 * This is the new username we will be authenticating with our SMTP servers and our website. Changes take effect immediately
 * @param string $username - Your first name
 */
$sendgridweb->profile_setUsername( $username ); 

/**
 * Reset Your password
 * @param string $password - Your new password
 * @param string $confirm_password - Confirm new password
 */
$sendgridweb->profile_setPassword( $password , $confirm_password); 
/**
 * Update contact email address.
 * @param string $email - This is the new email address we will be contacting you with. Changes take effect immediately
 */
$sendgridweb->profile_setEmail( $email); 

/**
 * Retrieve a list of email addresses that are spam reports.
 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks.
 */
$sendgridweb->spamreports_get( $date = '' , $days = '' , $start_date = '' , $end_date = ''); 

/**
 * Remove an email address from your spam report list.
 * @param string $email - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 */
$sendgridweb->spamreports_delete(  $email ); 

/**
 * This module allows you to retrieve statistics on statistics on multiple metrics such as requests, bounces, spam reports, categories, and others.
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks.
 */
$sendgridweb->stats_get( $days = '' , $start_date = '' , $end_date = ''); 

/**
 * Add an email to your unsubscribe list.
 * @param string $email - Email address to add to unsubscribe list
 */
$sendgridweb->unsubscribes_add( $email ); 

/**
 * Retrieve a list of unsubscribed email addresses.
 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 * @param string $days - Number of days in the past for which to retrieve bounces (includes today); 
 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
 * @param string $end_date  - The end of the date range for which to retrieve blocks.
 */
$sendgridweb->unsubscribes_get( $date = '' , $days = '' , $start_date = '' , $end_date = '' ); 

/**
 * Delete an address from the Unsubscribe list.
 * @param string $email - Unsubscribed email address to remove
 */
$sendgridweb->unsubscribes_delete( $email );

?>