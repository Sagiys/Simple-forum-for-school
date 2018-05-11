<?php
    session_start();
?>

<html>
    <head>
        <link href="forum.css" rel="stylesheet">
        <title><?php  if (isset($_GET["cat"]))
			         $cat=$_GET["cat"];
            $link=mysqli_connect("localhost", "root", "", "forum");
            $query=mysqli_query($link, "SELECT * FROM categories WHERE id=$cat");
            $row=mysqli_fetch_assoc($query);
            $xxx=$row["category"];
            echo "$xxx";
            ?>
        </title>
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
                if(isset($_SESSION["login"]))
                {
                    if($_SESSION["login"] == "admin")
                    {
                        $returnQuery=mysqli_query($link, "SELECT * FROM users,posts WHERE posts.creator = users.id AND category=$cat ORDER BY posts.id DESC");

                    }
                    else
                    {
                        $returnQuery=mysqli_query($link, "SELECT * FROM  users, posts WHERE posts.creator = users.id AND category=$cat AND posts.published = 1 ORDER BY posts.id DESC");
                    }
                }else{
                    $returnQuery=mysqli_query($link, "SELECT * FROM users, posts WHERE posts.creator = users.id AND category=$cat AND posts.published = 1 ORDER BY posts.id DESC");
                }
                while($row=mysqli_fetch_assoc($returnQuery)){
                    $id=$row["id"];
                    $title=$row["title"];
                    $content=$row["content"];
                    $creator=$row["login"];
                    $published=$row["published"];
                    if(strlen($content) > 77)
                        $content = mb_substr($content, 0, 77)."...";
                    $conToDisplay = mb_substr($content, 0, 77);
                    
                    if($published == 1)
                    {
                        echo "<div class='post'>
                        <p style='text-indent: 100px; padding-top: 20px; font-size: 25px;'><a href='post.php?post=$id'>$title</a>";
                        echo"<p>";
                        echo "<p style='text-indent: 100px;'><i>$content</i></p>";
                    }else{
                        echo "<div class='post'>
                        <p style='text-indent: 100px; padding-top: 20px; font-size: 25px;'><a href='post.php?post=$id'>$title (Nieopublikowany)</a>";
                        echo "<p>";
                        echo "<p style='text-indent: 100px;'><i>$content</i></p>";
                    }
                    echo "<div style='float:right; padding-right: 10px; font-size: 14px;'>Autor: <a href='profil.php?user=$creator'>$creator</a></div>
                    </div>";
                }
				
            
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>