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
                        $query=mysqli_query($link, "SELECT * FROM categories WHERE id=$cat");
                        $row=mysqli_fetch_assoc($query);
                        $title=$row["category"];
                        $desc=$row["description"];
                        echo "<p style='text-align: center; margin-top: 20px; font-size: 20px;'><b>Edytuj Kategorie</b></p>";
                        echo "<form action='editCategory.php?cat=$cat' method='post' style='text-align: center; margin: 0px; margin-top: 30px;'>
                                Tytuł:<br><input type='text' name='title' value='$title'><br><br>
                                Opis: <br><input type='text' name='desc' size='40' value='$desc'><br><br>
                                <input type='submit' value='Edytuj Kategorie!' name='sub'>
                              </form>";
                       if(isset($_POST["sub"]))
                       {
                           if(empty($_POST["title"]) || empty($_POST["desc"]))
                           {
                               echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                           }else{
                               $title=$_POST["title"];
                               $desc=$_POST["desc"];
                               echo "$title<br>$desc";
                               mysqli_query($link, "UPDATE categories SET category='$title', description='$desc' WHERE id=$cat");
                               header("Location: index.php");
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