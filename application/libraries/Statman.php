<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statman
{
	private $CI;
	
	private $variableName = 'postMsg';
	
	private $successVariableName = 'SUCC';
	private $errorVariableName = 'ERR';
	
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
	        $this->CI->cookieman->deleteCookie($this->cookieSuccessName);
	        $result = array($this->variableName => array($this->successVariableName => $cookieSuccess));
	    } 
	    else if ($cookieError)
	    {
	        $this->CI->cookieman->deleteCookie($this->cookieErrorName);
	        $result = array($this->variableName => array($this->errorVariableName => $cookieError));
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
	
	function setErrorNow($data = true, $array = array())
	{	    
        return array_merge(array($this->variableName => array($this->errorVariableName => $data)), $array);
	}
	
	function setSuccessNow($data = true, $array = array())
	{
	    return array_merge(array($this->variableName => array($this->successVariableName => $data)), $array);
	}
}
