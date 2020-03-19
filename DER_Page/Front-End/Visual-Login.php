<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/DER_Page/Front-End/Visual-Login.css">
<link rel="stylesheet" type="text/css" href="/DER_Page/Front-End/Icons/Icons.css">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

<head>

    <title>Login Project DER </title>
    <link rel="shortcut icon" href="/DER_Page/Front-End/Images/DER.ico">
    
</head>

<body>

    <div class="Container_Form">

        <div class="Box" align="center">

            <div class="Header">
        
                <img id="Icon_DER" src="/DER_Page/Front-End/Images/Icon_Drone.png" alt="Project DER Logo" width="67" height="67">
                <img id="Icon_Fire" src="/DER_Page/Front-End/Images/Icon_Bomberos.png" width="72" height="70">
        
            </div>
            
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form">

                <div class="Welcome_Form">

                    <h1>Welcome</h1><h2>Project DER</h2>

                </div>

                <div class="User line-input">

                    <label class="lnr lnr-user"></label>
                    <input type="text" placeholder="User Name" name="User_Name">

                </div>

                <div class="Password line-input">

                    <label class="lnr lnr-lock"></label>
                    <input type="password" placeholder="Password" name="Password">
                
                </div>
                
                 <?php if(!empty($error)): ?>

                <div class="Message">

                    <?php echo $error; ?>

                </div>

                <?php endif; ?>
                
                <button type="submit">

                    Enter<label class="lnr lnr-chevron-right"></label>

                </button>

            </form>

        </div>

    </div>

    <footer class="Footer">

        <a href="https://www.instagram.com/project.der/"><span class="Social-Icons icon-instagrem"></span></a>
        <a href="https://www.facebook.com/project.der/"><span class="Social-Icons icon-facebook"></span></a>
        <a href=""><span class="Social-Icons icon-twitter"></span></a>
        <a href=""><span class="Social-Icons icon-mail"></span></a>

        &copy; 2019 Project DER. All rights reserved.

    </footer>
    
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
