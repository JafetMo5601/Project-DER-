
<?php session_start();

    if(isset($_SESSION['User_Name'])) {
        header('location: Main.php');
    }else{
        header('location: Login.php');
    }


?>
