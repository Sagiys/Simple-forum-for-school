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
            <div id="banner">
            <button type="button" style="width: 100%; height: 120px; background-image: url('banner.png'); border: none" onclick="location.href='index.php'">
            </button>
        </div>
        </div>
        <div id="fixed">
            <?php 
               include 'fixed.php';
            ?>
        </div>
        
        <div id="main" style="background-color: #ededed;">
            <?php
               if (isset($_GET["cat"]))
			         $cat=$_GET["cat"];
            
                $link=mysqli_connect("localhost", "root", "", "forum");
                if(isset($_SESSION["zalogowany"]))
                {
                    if($login == "admin")
                    {
                        mysqli_query($link, "DELETE FROM posts WHERE category=$cat");
                        mysqli_query($link, "DELETE FROM categories WHERE id=$cat");
                        header("Location: index.php");
                    }else{
                        header("Location: error.php");
                    }
                }else{
                    header("Location: error.php");
                }
				
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>