<?php
    
    try{
         $conexion = new PDO('mysql:host=localhost;dbname=Access', 'ProjectDER', 'ProjectDER');
    }catch(PDOException $prueba_error){
        echo "Error: " . $prueba_error->getMessage();
    }


?>
