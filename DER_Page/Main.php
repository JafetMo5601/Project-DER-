<?php session_start();

    if(isset($_SESSION['User_Name'])){
        require 'Front-End/Main-View.php';
    }else{
        header ('location: Login.php');
    }

?>
