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
				$returnQuery=mysqli_query($link, "SELECT * FROM categories");
                while($row=mysqli_fetch_assoc($returnQuery)){
                  $id=$row["id"];
                  $category=$row["category"];
		          $desc=$row["description"];
                  $query=$link->query("SELECT id FROM posts WHERE category = $id");
                    $posts =0;
                  while($row=mysqli_fetch_assoc($query)){
                    $posts++;
                  }
                    echo "<div class='cat' style='border-top: none'>
                            <p style='text-indent: 100px; padding-top: 20px; font-size: 25px;'><a href='category.php?cat=$id'>$category</a>";
                    
                    if(isset($_SESSION["zalogowany"]))
                    {
                        if($login == "admin")
                         echo "<span style='float: right; font-size: 13px; margin-right: 10px; margin-top: 10px;'>
                            <a href='editCategory.php?cat=$id'>Edytuj Kategorie</a>&emsp;
                            <a href='deleteCategory.php?cat=$id'>Usun Kategorie (razem z postami)</a>
                            </span>";
                    }
                    echo "</p><p style='text-indent: 100px;'><i>$desc</i></p>
                            <p style='float: right; font-size: 14px; margin-right: 10px;'>Liczba postów: $posts</p>
                        </div>";
                }
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>