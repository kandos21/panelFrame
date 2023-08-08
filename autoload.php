<?php
  
spl_autoload_register(function($clase)
{  


    $ruta='../'.str_replace("\\","/",$clase).".php";
    
    if(file_exists($ruta))
    {
      require_once $ruta;
    }
    else{ 
        //echo "no se pudo cargar la clase ".$clase;
        die("no se pudo cargar la clase".$clase);

    }
});