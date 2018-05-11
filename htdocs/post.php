<?php
    session_start();
?>

<html>
    <head>
        <link href="forum.css" rel="stylesheet">
        <title><?php  if (isset($_GET["post"]))
			         $post=$_GET["post"];
            $link=mysqli_connect("localhost", "root", "", "forum");
            $query=mysqli_query($link, "SELECT categories.category, title FROM categories, posts WHERE categories.id = posts.category AND posts.id = $post");
            $row=mysqli_fetch_assoc($query);
            $xx=$row["category"];
            $xxx=$row["title"];
            echo "$xx - $xxx";
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
                if (isset($_GET["post"]))
			         $post=$_GET["post"];
            
            $link=mysqli_connect("localhost", "root", "", "forum");
            $returnQuery=mysqli_query($link, "SELECT posts.id AS 'id', posts.title, posts.content, posts.tags, users.login, categories.category FROM categories, posts, users WHERE posts.creator = users.id AND posts.category = categories.id AND posts.id = $post");
            $row=mysqli_fetch_assoc($returnQuery);
            $title=$row["title"];
            $login=$row["login"];
            $category=$row["category"];
            $content=$row["content"];
            $tags=$row["tags"];
            $id=$row["id"];

            echo "<div style='width: 300px; height: 100%; background-color: #777777; color: white; float: left; border-right: 2px solid black'>
                <p style='text-align: center; margin-top: 30px; margin-bottom: 30px; font-size: 23px;'><b>Autor</b>: $login</p>
                <p style='text-indent: 20px;'><b>Kategoria</b>: $category</p>
                <p style='text-indent: 20px; margin-top: 10px;'><b>Tagi</b>: $tags</p>
                <br>
                <hr style='width: 95%; border-color: #ebebeb;'>";
            if(isset($_SESSION["zalogowany"])){
                if($_SESSION["login"] == $login)
                {
                  echo "<button type='button' style='width: 100px; height: 20px; margin-left: 100px;' onclick='location.href=`editPost.php?post=$id`'>Edytuj Post</button><br>";
                  echo "<button type='button' style='width: 100px; height: 20px; margin-top: 10px; margin-left: 100px' onclick='location.href=`deletePost.php?post=$id`'>Usuń Post</button>";   
                }
            }
            echo "</div>";
            echo "<div style='width: 698px; height: 100%; background-color: #ededed;float: left; overflow: auto;'>
                <p style='margin: 10px; text-indent: 10px; font-size: 25px;'>$title</p>
                <hr style='width: 95%; border-color: #777777;'>
                <p style='margin: 15px; text-indent: 30px;'>$content</p>
            </div>";
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>