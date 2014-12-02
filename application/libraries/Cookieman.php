<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cookieman
{
	private $CI;

	private $cookieExpire = '-1';
	private $cookieExpireToDelete;
	private $cookieDomain;
	private $cookiePath = '/';
	
	function __construct()
	{
	    $this->CI =& get_instance();
	    
	    $cookieDomain = $this->CI->input->server('SERVER_NAME');
	    $cookieExpireToDelete = time() - 3600;
	}
	
	function setCookie($key, $value)
	{
	    $cookie = array(
	        'name'   => $key,
	        'value'  => $value,
	        'expire' => $this->cookieExpire,
	        'domain' => $this->cookieDomain,
	        'path'   => $this->cookiePath
	    );
	    
	    $this->CI->input->set_cookie($cookie);
	}
	
	function deleteCookie($key)
	{
	    $cookie = array(
	        'name'   => $key,
	        'value'  => '',
	        'expire' => $this->cookieExpireToDelete,
	        'domain' => $this->cookieDomain,
	        'path'   => $this->cookiePath
	    );
	     
	    $this->CI->input->set_cookie($cookie);
	}
	
}