<?php
/**
 * SendGrid Web PHP API ...
 * extends sendgridConnect
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
 * CHECK sample.php for list of methods, variables and code samples
 * 
*/

require_once "core/sendgrid-connect.php";

class sendgridWeb extends sendgridConnect {

	/**
	 * Retrieve a list of bounces with addresses and response codes, optionally with dates.
	 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks. 
	 */
	public function bounces_get($date = '' , $days = '' , $start_date = '' , $end_date = '') {
		$url = "bounces.get";
		
		$postData = array(
			'date'		=> $date,
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}
	
	/**
	 * Delete an address from the Bounce list.
	 * @param string $email - Email bounce address to remove
	 */
	public function bounces_delete($email) {
		$url = "bounces.delete";
		
		$postData = array(
			'email'		=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}

	/**
	 * Retrieve a list of Blocks with addresses and response codes, optionally with dates.
	 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks. 
	 */
	public function blocks_get($date = '' , $days = '' , $start_date = '' , $end_date = '') {
		$url = "blocks.get";
		
		$postData = array(
			'date'		=> $date,
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}
	
	/**
	 * Delete an address from the Block list.
	 * @param string $email - Email bounce address to remove
	 */
	public function blocks_delete($email) {
		$url = "blocks.delete";
		
		$postData = array(
			'email'	=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}
	
	/**
	 * Retrieve email parse settings.
	 */
	public function email_parse_get() {
		$url = "parse.get";
		
		return $this->makeApiCall ( $url );
	}

	/**
	 * Specify the hostname and url for parsing incoming emails.
	 * @param string $hostname - hostname for parsing incoming mail
	 * @param string $url - url for parsing incoming mail
	 * @param string $spam_check - to check spam set to 1 (default is NO)
	 */
	public function email_parse_set( $hostname , $theurl , $spam_check = 0) {
		$url = "parse.set";
		
		$postData = array(
			'hostname'	=>	$hostname,
			'url'		=>	$theurl,
			'spam_check'=>	$spam_check,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}
	
	
	/**
	 * Edit existing email parse settings.
	 * @param string $hostname - hostname for parsing incoming mail
	 * @param string $url - url for parsing incoming mail
	 * @param string $spam_check - to check spam set to 1 (default is NO)
	 */
	public function email_parse_edit( $hostname , $theurl , $spam_check = 0) {
		$url = "parse.edit";
		
		$postData = array(
			'hostname'	=>	$hostname,
			'url'		=>	$theurl,
			'spam_check'=>	$spam_check,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}

	/**
	 * Edit existing email parse settings.
	 * @param string $hostname - hostname for parsing incoming mail
	 */
	public function email_parse_delete( $hostname ) {
		$url = "parse.delete";
		
		$postData = array(
			'hostname'	=>	$hostname,
		  );
		
		return $this->makeApiCall ( $url , $postData );
	}
	
	/**
	 * Retrieve notification URL.
	 */
	public function event_posturl_get() {
		$url = "eventposturl.get";
		
		return $this->makeApiCall ( $url );
	}

	/**
	 * Update notification URL.
	 * @param string $theurl - The URL to receive event notifications
	 */
	public function event_posturl_set( $theurl ) {
		$url = "eventposturl.set";
		
		$postData = array(
			'url'	=>	$theurl,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Delete notification URL.
	 */
	public function event_posturl_delete() {
		$url = "eventposturl.delete";
				
		return $this->makeApiCall ( $url );
	}
	
	/**
	 * Get a list of available Apps.
	 */
	public function filter_get( $theurl ) {
		$url = "filter.getavailable";
		
		return $this->makeApiCall ( $url );
	}
	
	/**
	 * Update notification URL.
	 * @param string $name - name of the App to activate
	 */
	public function filter_activate( $name ) {
		$url = "filter.activate";
		
		$postData = array(
			'name'	=>	$name,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Update notification URL.
	 * @param string $name - name of the App to deactivate
	 */
	public function filter_deactivate( $name ) {
		$url = "filter.deactivate";
		
		$postData = array(
			'name'	=>	$name,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Change the settings in an App.
	 * @param string $name - name of the App to setup
 	 * @param array $postData - App settings (Name & data)
	 * app settings can be found here: http://docs.sendgrid.com/documentation/api/web-api/filtersettings/
	 */
	public function filter_setup( $name , $postData ) {
		$url = "filter.setup";
		
		$postData['name'] = $name;
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * get app settings.
	 * @param string $name - name of the App to get
	 */
	public function filter_getsettings( $name ) {
		$url = "filter.getsettings";
		
		$postData = array(
			'name'	=>	$name,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Retrieve a list of email addresses that are invalid.
	 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks.
	 */
	public function invalid_emails_get( $date = '' , $days = '' , $start_date = '' , $end_date = '' ) {
		$url = "invalidemails.get";
		
		$postData = array(
			'date'		=> $date,
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Delete an address from the Invalid Email list.
	 * @param string $email - Email Invalid Email address to remove
	 */
	public function invalid_emails_delete( $email ) {
		$url = "invalidemails.delete";
		
		$postData = array(
			'email'	=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
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
	 * @param string $date - Specify the date header of your email. One example: “Thu, 21 Dec 2000 16:01:07 +0200″. PHP developers can use: date(‘r’);
	 * @param array $headers - PHP headers - check here: http://docs.sendgrid.com/documentation/api/smtp-api/
 	 * @param array $files - an array of file names and paths
	 * EX: $files = array('filename1' => 'filepath' , 'filename2' => 'filepath2',)
	*/
	public function mail_send( $to , $toname = '' , $xsmtpapi = '' , $subject , $html , $text , $from , $bcc ='' , $fromname='' , $replyto='' , $date='' , $files='' , $headers='') {
		$url = "mail.send";
		
		$postData = array(
			'to'		=> $to,
			'toname'	=> $toname,
			'x-smtpapi'	=> $xsmtpapi ? json_encode($xsmtpapi) : $xsmtpapi,
			'subject'	=> $subject,
			'html'		=> $html,
			'text'		=> $text,
			'from'		=> $from,
			'bcc'		=> $bcc,
			'fromname'	=> $fromname,
			'replyto'	=> $replyto,
			'date'		=> $date,
			'headers'	=> $headers ? json_encode($headers) : $headers,
		  );
		
		if($files){
			foreach($files as $filename => $filepath){
				$postData['files['.$filename.']'] = '@'.$filepath.'/'.$filename;
			}
		}
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Get profile information.
	 */
	public function profile_get() {
		$url = "profile.get";
		
		return $this->makeApiCall ( $url );
	}
	
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
	public function profile_set( $first_name ='' , $last_name ='' , $address ='' , $city ='' , $state ='' , $country ='' , $zip ='' , $phone ='' , $website ='') {
		$url = "profile.set";
		
		$postData = array(
			'first_name'=> $first_name,
			'last_name'	=> $last_name,
			'address'	=> $address,
			'city'		=> $city,
			'state'		=> $state,
			'country'	=> $country,
			'zip'		=> $zip,
			'phone'		=> $phone,
			'website'	=> $website,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * This is the new username we will be authenticating with our SMTP servers and our website. Changes take effect immediately
	 * @param string $username - Your first name
	 */
	public function profile_setUsername( $username ) {
		$url = "profile.setUsername";
		
		$postData = array(
			'username'=> $username,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Reset Your password
	 * @param string $password - Your new password
 	 * @param string $confirm_password - Confirm new password
	 */
	public function profile_setPassword( $password , $confirm_password) {
		$url = "profile.setPassword";
		
		$postData = array(
			'password'			=> $password,
			'confirm_password'	=> $confirm_password,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Update contact email address.
	 * @param string $email - This is the new email address we will be contacting you with. Changes take effect immediately
	 */
	public function profile_setEmail( $email) {
		$url = "profile.setEmail";
		
		$postData = array(
			'email'	=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Retrieve a list of email addresses that are spam reports.
	 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks.
	 */
	public function spamreports_get( $date = '' , $days = '' , $start_date = '' , $end_date = '') {
		$url = "spamreports.get";
		
		$postData = array(
			'date'		=> $date,
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Remove an email address from your spam report list.
	 * @param string $email - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
	 */
	public function spamreports_delete(  $email ) {
		$url = "spamreports.delete";
		
		$postData = array(
			'email'		=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * This module allows you to retrieve statistics on statistics on multiple metrics such as requests, bounces, spam reports, categories, and others.
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks.
	 */
	public function stats_get( $days = '' , $start_date = '' , $end_date = '') {
		$url = "stats.get";
		
		$postData = array(
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Add an email to your unsubscribe list.
 	 * @param string $email - Email address to add to unsubscribe list
	 */
	public function unsubscribes_add( $email ) {
		$url = "unsubscribes.add";
		
		$postData = array(
			'email'		=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Retrieve a list of unsubscribed email addresses.
	 * @param string $date - Retrieve the timestamp of the bounce records. It will return a date in a MySQL timestamp format – YYYY-MM-DD HH:MM:SS 
 	 * @param string $days - Number of days in the past for which to retrieve bounces (includes today) 
	 * @param string $start_date  - The start of the date range for which to retrieve bounces. 
	 * @param string $end_date  - The end of the date range for which to retrieve blocks.
	 */
	public function unsubscribes_get( $date = '' , $days = '' , $start_date = '' , $end_date = '' ) {
		$url = "unsubscribes.get";
		
		$postData = array(
			'date'		=> $date,
			'days'		=> $days,
		    'start_date'=> $start_date,
		    'end_date'  => $end_date,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
	
	/**
	 * Delete an address from the Unsubscribe list.
 	 * @param string $email - Unsubscribed email address to remove
	 */
	public function unsubscribes_delete( $email ) {
		$url = "unsubscribes.delete";
		
		$postData = array(
			'email'		=> $email,
		  );
		
		return $this->makeApiCall ( $url , $postData);
	}
}
?>