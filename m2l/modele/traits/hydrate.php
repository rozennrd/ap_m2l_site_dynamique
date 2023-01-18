<?php 
trait Hydrate {
    function hydrate(array $donnees) 
    {
         
        foreach($donnees as $key=>$value)
        {
            $method = 'set'.ucfirst($key);
            echo method_exists($this, $method); 
            if (method_exists($this, $method)) 
            {
                $this->$method($value);
            }

        }
    }
}