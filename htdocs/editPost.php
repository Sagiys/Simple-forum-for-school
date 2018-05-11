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
            <p style="text-align: center; margin-top: 20px; font-size: 20px;"><b>Edytuj Post</b></p>
            <?php
                if (isset($_GET["post"]))
			         $post=$_GET["post"];
            
            $link=mysqli_connect("localhost", "root", "", "forum");
            $returnQuery=mysqli_query($link, "SELECT posts.title, posts.priority, posts.content, posts.category, posts.tags, posts.published, users.login FROM posts, users WHERE posts.id=$post AND posts.creator=users.id");
            $categories=mysqli_query($link, "SELECT id, category FROM categories");
            $row=mysqli_fetch_assoc($returnQuery);
            $title=$row["title"];
            $priority=$row["priority"];
            $content=$row["content"];
            $category=$row["category"];
            $tags=$row["tags"];
            $published=$row["published"];
            $login=$row["login"];
            
            if(isset($_SESSION["zalogowany"]))
            {
                if($_SESSION["login"] == $login)
                {
            
                echo "<form action='editPost.php?post=$post' method='post' style='text-align: center; margin:0px; margin-top: 30px;'>
                    Tytuł: <br><input type=text name='title' value='$title'><br><br>";

                    if($priority == 1)
                    echo "Post Dnia: <input type='checkbox' name='priority' checked><br><br>";
                    if($priority == 0)
                    echo "Post Dnia: <input type='checkbox' name='priority'><br><br>";

                    echo "Treść: <br><textarea type='text' rows='7' cols='40' name='content' style='resize:none'>$content</textarea><br><br>
                    Kategoria: <br><select name='category'> ";
                    while($row=mysqli_fetch_assoc($categories))
                        {
                            $cat=$row["category"];
                            $catID=$row["id"];
                            if($category == $catID)
                            echo "<option value='$cat' selected>$cat</option>";
                            if($category != $catID)
                            echo "<option value='$cat'>$cat</option>";
                        }
                    echo " </select><br><br>
                    Tagi: <br><input type=text name='tags' value='$tags'><br><br>";
                    if($published == 1)
                    echo "Opublikować: <input type='checkbox' name='published' checked><br><br>";
                    if($published == 0)
                    echo "Opublikować: <input type='checkbox' name='published'><br><br>";
                    echo "<input type='submit' value='Edytuj Post!' name='sub'>
                    </form>";
                    
                    if(isset($_POST["sub"]))
                        {
                           if(empty($_POST["title"]) || empty($_POST["content"]))
                           {
                               echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                           }else{
                               $rtitle=$_POST["title"];
                               $rcontent=$_POST["content"];
                               $rtags=$_POST["tags"];
                               $rpublished = 0;
                               if(isset($_POST["published"])) $rpublished = 1;
                               $rpriority = 0;
                               if(isset($_POST["priority"])) {
                                   mysqli_query($link, "UPDATE posts SET priority=0");
                                   $rpriority = 1;
                               }
                               $rcategory=$_POST["category"];
                               $getCatID=mysqli_query($link, "SELECT id FROM categories WHERE category='$rcategory'");
                               $rrr=mysqli_fetch_assoc($getCatID);
                               $rcategory=$rrr["id"];
                               
                               mysqli_query($link, "UPDATE posts SET title='$rtitle', content='$rcontent', published=$rpublished, priority=$rpriority, category=$rcategory, tags='$rtags' WHERE id=$post");
                               header("Location: post.php?post=$post");
                           }
                        }
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