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
            ?>
            <p style="text-align: center; margin-top: 20px; font-size: 20px;"><b>Dodaj Kategorie</b></p>
            <form action="addCategory.php" method="post" style="text-align: center; margin:0px; margin-top: 30px;">
                Tytuł: <br><input type=text name="title" ><br><br>
                Opis: <br><input type=text name="desc"><br><br>
                <input type="submit" value="Dodaj Kategorie!" name="sub">
            </form>
            <?php
               if(isset($_POST["sub"]))
               {
                   if(empty($_POST["title"]) || empty($_POST["desc"]))
                   {
                       echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                   }else{
                       $title=$_POST["title"];
                       $desc=$_POST["desc"];
                       mysqli_query($link, "INSERT INTO categories VALUES('', '$title', '$desc')");
                       header("Location: index.php");
                   }
               }
            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>