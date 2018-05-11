<?php
    session_start();
?>

<html>
    <head>
        <link href="forum.css" rel="stylesheet">
        <title>平仮名ナ片仮名</title>
    </head>
    
    <body>
        
        <div id="banner">
            <button type="button" style="width: 100%; height: 120px; background-image: url('banner.png'); border: none" onclick="location.href='index.php'">
            </button>
        </div>
        <div id="fixed">
            <?php 
               include 'fixed.php';
            ?>
        </div>
        
        <div id="main">
            <p style="text-align: center; font-size: 35px; margin-top: 20px;">Brak uprawnień lub błąd strony!</p>
            <a href="index.php" style="color: black; text-decoration: none; margin-left: 380px; margin-top: 10px;">--> Powrót na strone główną &lt;--</a>
            
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>