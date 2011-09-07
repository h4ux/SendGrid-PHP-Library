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
	 */
	public function __construct($user, $key) {
		$this->authUser = $user;
		$this->authKey = $key;
		$this->apiEndpoint = self::SG_ENDPOINT;
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
		$postData['api_key'] = $this->authKey;


		$url.= ".json";

		$jsonUrl = $this->apiEndpoint . '/' . $url;
		// Generate curl request
		$session = curl_init($jsonUrl);
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

		$results  = json_decode ( $jsonResponse, TRUE );
		
		$this->lastResponseError = isset($results['error']) ? $results['error'] : NULL;

		return $this->lastResponseError ? false : $results;
	}
	
	public function getLastResponseError() {
		return $this->lastResponseError;
	}

}