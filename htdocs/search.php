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
            <p style="text-align:center; margin-top: 15px; font-size: 30px;">Wyszukiwarka</p>
            <form action='search.php' method='post' style='text-align:center; margin: 0px; margin-top: 20px;'>
                Szukaj po tytułach:<br> <input type='text' name='title'><br>
                <input type='submit' value='Szukaj' name='sub1'><br><br>
                Szukaj w postach:<br> <input type='text' name='content'><br>
                <input type='submit' value='Szukaj' name='sub2'><br><br>
                Szukaj po tagach:<br> <input type='text' name='tags'><br>
                <input type='submit' value='Szukaj' name='sub3'>
            </form>
            <hr style='width: 95%'>
            <?php
                    
                if(isset($_POST["sub1"]) || isset($_POST["sub2"]) || isset($_POST["sub3"]))
                {
                    $link=mysqli_connect("localhost", "root", "", "forum");
                    $query;
                    if(isset($_POST["sub1"]))
                    {
                        $phrase=$_POST["title"];
                        $query=mysqli_query($link, "SELECT * FROM users,posts WHERE posts.title LIKE '%$phrase%' AND posts.published=1 AND posts.creator = users.id ORDER BY posts.id DESC");
                    }
                    if(isset($_POST["sub2"]))
                    {
                        $phrase=$_POST["content"];
                        $query=mysqli_query($link, "SELECT * FROM users,posts WHERE posts.content LIKE '%$phrase%' AND posts.published=1 AND posts.creator = users.id ORDER BY posts.id DESC");
                    }
                    if(isset($_POST["sub3"]))
                    {
                        $phrase=$_POST["tags"];
                        $query=mysqli_query($link, "SELECT * FROM users,posts WHERE posts.tags LIKE '%$phrase%' AND posts.published=1 AND posts.creator = users.id ORDER BY posts.id DESC");
                    }
            
                    while($row=mysqli_fetch_assoc($query))
                    {
                        $id=$row["id"];
                        $title=$row["title"];
                        $content=$row["content"];
                        $creator=$row["login"];
                        if(strlen($content) > 77)
                        $content = mb_substr($content, 0, 77)."...";
                        $conToDisplay = mb_substr($content, 0, 77);
                        echo "<div class='post'>
                        <p style='text-indent: 100px; padding-top: 20px; font-size: 25px;'><a href='post.php?post=$id'>$title</a>";
                        echo"<p>";
                        echo "<p style='text-indent: 100px;'><i>$content</i></p>";
                        echo "<div style='float:right; padding-right: 10px; font-size: 14px;'>Autor: <a href='profil.php?user=$creator'>$creator</a></div>
                        </div>";
                    }
                }
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>