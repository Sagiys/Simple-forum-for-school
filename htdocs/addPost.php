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
            <?php
                $link=mysqli_connect("localhost", "root", "", "forum");
                $categories=mysqli_query($link, "SELECT category FROM categories");
                $idusr=mysqli_query($link, "SELECT id FROM users WHERE login='$login'");
                $row=mysqli_fetch_assoc($idusr);
                $userId=$row["id"];
            ?>
            <p style="text-align: center; margin-top: 20px; font-size: 20px;"><b>Dodaj Post</b></p>
            <form action="addPost.php" method="post" style="text-align: center; margin:0px; margin-top: 30px;">
                Tytuł: <br><input type=text name="title" ><br><br>
                Post Dnia: <input type="checkbox" name="priority"><br><br>
                Treść: <br><textarea type="text" rows="7" cols="40" name="content" style="resize:none"></textarea><br><br>
                Kategoria: <br><select name="category"> 
                <?php
                    while($row=mysqli_fetch_assoc($categories))
                    {
                        $category=$row["category"];
                        echo "<option value='$category'>$category</option>";
                    }
                ?>
                </select><br><br>
                Tagi: <br><input type=text name="tags"><br><br>
                Opublikować: <input type="checkbox" name="published" checked><br><br>
                <input type="submit" value="Dodaj Post!" name="sub">
            </form>
            <?php
               if(isset($_POST["sub"]))
               {
                   if(empty($_POST["title"]) || empty($_POST["content"]))
                   {
                       echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                   }else{
                       $title=$_POST["title"];
                       $content=$_POST["content"];
                       $tags=$_POST["tags"];
                       $published = 0;
                       if(isset($_POST["published"])) $published = 1;
                       $priority = 0;
                       if(isset($_POST["priority"])) 
                       {
                           mysqli_query($link, "UPDATE posts SET priority=0");
                           $priority = 1;
                       }
                       $category=$_POST["category"];
                       $getCatID=mysqli_query($link, "SELECT id FROM categories WHERE category='$category'");
                       $row=mysqli_fetch_assoc($getCatID);
                       $category=$row["id"];
                       mysqli_query($link, "INSERT INTO posts VALUES('', $published, $priority, '$title', '$content', $category, '$tags', $userId)");
                       $getPostID=mysqli_query($link, "SELECT posts.id FROM posts WHERE title='$title'");
                       $roww=mysqli_fetch_assoc($getPostID);
                       $postID=$roww["id"];
                       header("Location: post.php?post=$postID");
                   }
               }
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>