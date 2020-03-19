<?php session_start();

    if(isset($_SESSION['User_Name'])) {
        header('location: Index.php');
    }

    $error = '';
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $User_Name = $_POST['User_Name'];
        $Password = $_POST['Password'];
	$Password = MD5($Password);
        
        try{
            $conexion = new PDO('mysql:host=localhost;dbname=Access', 'ProjectDER', 'ProjectDER');
            }catch(PDOException $prueba_error){
                echo "Error: " . $prueba_error->getMessage();
            }
        
        $statement = $conexion->prepare('
        SELECT * FROM Login WHERE User_Name = :User_Name AND Password = :Password'
        );
        
        $statement->execute(array(
            ':User_Name' => $User_Name,
            ':Password' => $Password
        ));
            
        $resultado = $statement->fetch();
        
        if ($resultado !== false){
            $_SESSION['User_Name'] = $User_Name;
            header('location: Main.php');
        }else{
            $error .= '<i>Este usuario no existe</i>';
        }
    }
    
require 'Front-End/Visual-Login.php';


?>
