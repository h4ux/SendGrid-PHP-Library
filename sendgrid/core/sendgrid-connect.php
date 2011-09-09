<?php
/**
 * SendGrid Newsletter PHP API ...
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
 * CHECK sample.php for list of methods, variables and code samples
 * 
*/

class sendgridConnect {

	private $apiEndpoint;
	private $authUser;
	private $authKey;
	private $lastResponseError;
	private $_debug;
	private $_curl_ssl_verify;

	/**
	 * Timeout in seconds for an API call to respond
	 * @var integer
	 */
	const TIMEOUT = 20;

	/**
	 *
	 * user agent ...
	 * @var string
	 */
	const USER_AGENT = 'Sendgrid Newsletter PHP API';

	/**
	 *
	 * sendgrid endpoint ...
	 * @var string
	 */
	const SG_ENDPOINT = 'https://sendgrid.com/api';

	/**
	 * Creates a new SendGrid Newsletter API object to make calls with
	 *
	 * Your API key needs to be generated using SendGrid Management
	 * Authentication is done automatically when making the first API call
	 * using this object.
	 *
	 * @param string $user The username of the account to use
	 * @param string $key The API key to use
	 * @param boolean $debug Set to true to get debug information (development)
	 * $param boolean $curl_ssl_verify set false to disable CURL ssl cert verification
	 */
	public function __construct($user, $key , $debug = false , $curl_ssl_verify = true) {
		$this->authUser = $user;
		$this->authKey = $key;
		$this->apiEndpoint = self::SG_ENDPOINT;
		$this->_debug = $debug;
		$this->_curl_ssl_verify = $curl_ssl_verify;
	}

		
	/**
	 * Makes a call to an API
	 *
	 * @param string $url The relative URL to call (example: "/server")
	 * @param string $postData (Optional) The JSON string to send
	 * @param string $method (Optional) The HTTP method to use
	 * @return array The parsed response, or NULL if there was an error
	 */
	protected function makeApiCall($url, $postData = NULL, $method = 'POST') {
		
		//if(!$postData)return false;
		
		$postData['api_user'] = $this->authUser;
		$postData['api_key']  = $this->authKey;
		
		$this->debugCall('DEBUG - Post Data: ' , $postData);

		$url.= ".json";

		$jsonUrl = $this->apiEndpoint . '/' . $url;
		// Generate curl request
		$session = curl_init($jsonUrl);
		
		$this->debugCall('DEBUG - Curl Session: ' , $session);
		
		//Set to FALSE to stop cURL from verifying the peer's certificate (needed for local hosts development mostly)
		if(!$this->_curl_ssl_verify) curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);

		// Tell curl to use HTTP POST
		curl_setopt ( $session, CURLOPT_CUSTOMREQUEST, strtoupper ( $method ) );
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $postData);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt ( $session, CURLOPT_USERAGENT, self::USER_AGENT );
		curl_setopt ( $session, CURLOPT_ENCODING, 'gzip,deflate' );
		curl_setopt ( $session, CURLOPT_TIMEOUT, self::TIMEOUT );
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		// obtain response
		$jsonResponse = curl_exec($session);
		curl_close($session);
		
		$this->debugCall('DEBUG - Json Response: ' , $jsonResponse);
		
		$results  = json_decode ( $jsonResponse, TRUE );
		
		$this->debugCall('DEBUG - Results: ' , $results);
		
		$this->lastResponseError = isset($results['error']) ? $results['error'] : NULL;

		return $this->lastResponseError ? false : $results;
	}
	
	
	/**
	 * Makes a print out of every step of makeApiCall for DEBUGGING
	 *
	 * @param string $text The text to show before the actual debug information EX: DEBUG - Results: 
	 * @param string / array $data the actual debug data to show
	 */
	private function debugCall($text = 'DEBUG : ' , $data){
		if(!$this->_debug) return;
		
		$newLine = isset($_SERVER['HTTP_USER_AGENT']) ? "<br/>" : "\n";
			
		echo $newLine . $text;
		//print_r($data);
		if(is_array($data)){
			foreach($data as $name=>$value){
				if($name == 'api_user' || $name == 'api_key')continue;
				echo $newLine . $name . ' => ' . $value;
			}echo $newLine;
		}else echo $data . $newLine;
	}
	
	public function getLastResponseError() {
		return $this->lastResponseError;
	}

}