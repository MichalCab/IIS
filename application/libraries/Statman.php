<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statman
{
	private $CI;
	
	private $errorVariableName = 'ERR';
	private $successVariableName = 'SUCC';
	
	private $cookieSuccessName = 'successCookie';
	private $cookieErrorName = 'errorCookie';

	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	function setActualStatus($array = array())
	{
	    $result = array();
	    
	    $cookieSuccess = $this->CI->input->cookie($this->cookieSuccessName, FALSE);
	    $cookieError = $this->CI->input->cookie($this->cookieErrorName, FALSE);
	    
	    if ($cookieSuccess)
	    {
	        $this->CI->cookieman->deleteCookie($this->cookieSuccessName, FALSE);
	        $result = array($this->cookieSuccessName => $cookieSuccess);
	    } 
	    else if ($cookieError)
	    {
	        $this->CI->cookieman->deleteCookie($this->$cookieErrorName, FALSE);
	        $result = array($this->cookieErrorName => $cookieError);
	    }
	    
	    return array_merge($array, $result);
	}
	
	function setErrorStatus($msg = true)
	{
	    $this->CI->cookieman->setCookie($this->cookieErrorName, $msg);
	}
	
	function setSuccessStatus($msg = true)
	{
	    $this->CI->cookieman->setCookie($this->cookieSuccessName, $msg);
	}
	
	function setErrorNow($data = true)
	{
        return array($this->errorVariableName => $data);	    
	}
	
	function setSuccessNow($data = true)
	{
	    return array($this->successVariableName => $data);
	}
}
