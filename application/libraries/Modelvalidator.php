<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelValidator
{
	function __construct()
	{
		
	}
	
	function valideInsert(&$inputs, $attributes, $unset_attributes, $non_empty)
	{
        $i = 0;
        $isNotInside = $attributes;
        $result["error"] = "";
        $result["warning"] = "";
        foreach ($inputs as $key => $value)
        {
            if (in_array($key, $attributes))
            {
                // kontrolujeme zadane 
                if (in_array($key, $non_empty))
                {
                    if ($value == NULL || $value == "")
                        $result["error"] = $result["error"] . "Atribut '" . $key . "' je prázdný!</br>";
                }
                $i++;
                $isNotInside = array_diff($isNotInside, array($key));
            }
            else
            {
                // odpalime nezadane
                $result["warning"] = $result["warning"] . "Atribut '". $key . "' je nežádaný</br>";
                unset($inputs[$key]);
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
        
        if ($i == count($attributes) && $result["error"] == "")
            $result["res"] = true;
        
	    return $result;
	}
    function valideUpdate(&$inputs, $attributes, $unset_attributes, $non_empty, $old_values)
    {
        $inputs['changed'] = FALSE;
        foreach ($inputs as $key => $value)
        {
            if (in_array($key, $attributes))
            {
                if ($value != $old_value[$key])
                {
                    $inputs['changed'] = TRUE;
                    break;
                }
            }
        }
        return $this->valideInsert($inputs, $attributes, $unset_attributes, $non_empty);
    }
}
