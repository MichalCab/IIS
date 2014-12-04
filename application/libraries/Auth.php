<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	private $CI;
	private $user = NULL;
	private $cookieAuthName = 'userId';

	function __construct()
	{
	    $this->CI =& get_instance();

	    session_start();
	    
	    $id = isset($_SESSION['userId']) ? $_SESSION['userId'] : FALSE;
	    
		//$id = $this->CI->input->cookie($this->cookieAuthName, FALSE);
		
		if ($id)
		{
			$this->CI->db->where('id', $id);
			$query = $this->CI->db->get('vClen');

			$this->user = $query->row();
			$query->free_result();
		}
	}
	
	function getUserData()
	{
	    return $this->user;
	}
	
	function isLogged()
	{
	    return ($this->user) ? true : false;
	}
	
	function isCustomer()
	{
	    return ($this->user && $this->user->typ == 'ZAK') ? true : false;
	}
	
	function isDriver()
	{
	    return ($this->user && $this->user->typ == 'VOD') ? true : false;
	}
	
	function isAdmin()
	{
	    return ($this->user && $this->user->typ == 'ADM') ? true : false;
	}
	
	function login($login, $password)
	{
	    $this->CI->db->where('login', $login);
	    $this->CI->db->where('heslo', $password);
	    $query = $this->CI->db->get('vClen');
	    
	    $this->user = $query->row();
	    $query->free_result();
	    
	    if ($this->isLogged())
	    {
	        //$this->CI->cookieman->setCookie($this->cookieAuthName, $this->user->id);
	        $_SESSION['userId'] = $this->user->id;
	        session_regenerate_id(true);
	        return true;
	    }
	    
	    return false;
	}
	
	function logout()
	{
	    unset($_SESSION['userId']);
	    //$this->CI->cookieman->deleteCookie($this->cookieAuthName);
	}
	
	function getCookieAuthName ()
	{
	    return $this->cookieAuthName;
	}
}
