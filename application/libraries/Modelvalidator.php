<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelValidator
{
	function __construct()
	{
		
	}
	
	function valideInsert($inputs, $attributes)
	{
        $i = 0;
        foreach ($inputs as $key => $value)
        {
            if (array_key_exists($key, $attributes))
                $i++;
        }
        if ($i == count($attributes))
            return TRUE;
	    return FALSE;
	}
}
