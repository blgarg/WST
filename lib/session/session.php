<?php
/**
 * Defines the interface for the session class
 *
 */
class session{

	private static $instance = null;
	
	function __construct() {
		@session_start();
	}
	
	public static function getInstance() {
		if (session::$instance === null) {
			session::$instance = new session();
		}
		return session::$instance;
	}

	/**
	 * 
	 * Create/Update a session variable
	 *
	 * @param $sessionName: Name of the session variable
	 * @param $sessionValue: value for the session variable
	 *
	 */
	public function setSessionVar($sessionName, $sessionValue) {
		$_SESSION[$sessionName] = $sessionValue; 
	}

	/**
	 * 
	 * Returns the value of session variable given in $sessionName
	 *
	 * @param $sessionName: Name of the session variable
	 *
	 */
	public function getSessionVar($sessionName) {
		if (isset($_SESSION[$sessionName])) {
			return $_SESSION[$sessionName];
		}
		else {
			return "";
		}
	}

	/**
	 * 
	 * Returns the true if session variable exists with any value other than blank else return false
	 *
	 * @param $sessionName: Name of the session variable
	 *
	 */
	public function isSessionAlive($sessionName) { 
		if (isset($_SESSION[$sessionName]) && $_SESSION[$sessionName] != "") {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * 
	 * Unset a session variable and returns true
	 *
	 * @param $sessionName: Name of the session variable
	 *
	 */
	public function unsetSessionVar($sessionName) {
		if (isset($_SESSION[$sessionName]) && $_SESSION[$sessionName] != "") {
			unset($_SESSION[$sessionName]);
			return true;
		}
	}

	/**
	 * 
	 * Destroy session and returns true
	 *
	 * @param : NA
	 *
	 */
	public function destroySession() { 
		session_destroy();
		return true;
	}

	/**
	 * 
	 * Get session Id
	 *
	 * @param : NA
	 *
	 */
	public function setSessionId($sessionId) {
		$_SESSION[$sessionId] = session_id();
	}

    public function getSessionId($sessionId) {
		return $_SESSION[$sessionId];
	}
	

	public function printSession(){
		print"<pre>";
		print_r($_SESSION);
	}
	
	
	function setVar($varName,$varValue){		
		$_SESSION[$varName] = $varValue;
	}
	
	function getVar($varName){	
	if(isset($_SESSION[$varName])){	return $_SESSION[$varName];}
	}
	
} // class ends 

?>