<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth
{
	private $CI;
	private $user = NULL;
	private $cookieAuthName = 'userId';

	function __construct()
	{
		$this->CI =& get_instance();

		$id = $this->CI->input->cookie($this->cookieAuthName, FALSE);
		
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
	        $this->CI->input->set_cookie(array($this->cookieAuthName => $this->user->id));
	        return true;
	    }
	    
	    return false;
	}
}