<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelValidator
{
	function __construct()
	{
		
	}
	
	function valideInsert(&$inputs, $attributes, $unset_attributes=array())
	{
        $i = 0;
        $isNotInside = $attributes;
        $result["error"] = "";
        $result["warning"] = "";
        //kontrola prázdnosti a nežádanosti
        foreach ($inputs as $key => $value)
        {
            if (in_array($key, $attributes))
            {
                $i++;
                if ($value == "")
                    $result["error"] = $result["error"] . "Atribut '" . $key . "' je prázdný!</br>";
                unset($isNotInside[$key]);
            }
            else
            {
                $result["warning"] = $result["warning"] . "Atribut '". $key . "' je nežádaný</br>";
            }
        }
        //unset bcs of registration
        foreach ($unset_attributes as $key => $value)
        {
            unset($inputs[$value]);
        }
        //kontrola povinosti
        foreach ($isNotInside as $key => $value)
        {
            $result["error"] = $result["error"] . "Atribut '". $value . "' je povinný</br>";
        }
        
        $result["res"] = false;
        if ($i == count($attributes))
            $result["res"] = true;
        
	    return $result;
	}
    function valideUpdate(&$inputs, $attributes)
    {
        return $this->valideInsert($inputs, $attributes);
    }
}
