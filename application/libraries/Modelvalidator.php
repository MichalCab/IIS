<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelValidator
{
	function __construct()
	{
		
	}
	
	function valideInsert($inputs, $attributes)
	{
        $i = 0;
        $isNotInside = $attributes;

        //kontrola prázdnosti a nežádanosti
        foreach ($inputs as $key => $value)
        {
            if (array_key_exists($key, $attributes))
            {
                $i++;
                if ($value == "")
                    $inputs["error"] .= "Atribut '" . $key . "' je prázdný!</br>";
                unset($isNotInside[$key]);
            }   
            else
            {
                $inputs["warning"] .= "Atribut '". $key . "' s hodnotou '" . $value . "' je nežádaný</br>";
            }
        }

        //kontrola povinosti
        foreach ($isNotInside as $key => $value)
        {
            $inputs["error"] .= "Atribut '". $key . "' s hodnotou '" . $value . "' je povinný</br>";
        }

        if ($i == count($attributes))
            return TRUE;
	    return FALSE;
	}
    function valideUpdate($inputs, $attributes)
    {
        return valideInsert($inputs, $attributes);
    }
}
