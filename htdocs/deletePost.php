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
                if (isset($_GET["post"]))
			         $post=$_GET["post"];
            
            $link=mysqli_connect("localhost", "root", "", "forum");
            $returnQuery=mysqli_query($link, "SELECT posts.title, posts.category,  users.login FROM posts, users WHERE posts.id=$post AND posts.creator = users.id");
            $row=mysqli_fetch_assoc($returnQuery);
            $title=$row["title"];
            $login=$row["login"];
            $category=$row["category"];
            
            if(isset($_SESSION["zalogowany"]))
            {
                if($_SESSION["login"] == $login)
                {
                   mysqli_query($link, "DELETE FROM posts WHERE id=$post");
                   header("Location: category.php?cat=$category");
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