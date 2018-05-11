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
                if(isset($_GET["user"]))
                    $user=$_GET["user"];
            
                $link=mysqli_connect("localhost", "root", "", "forum");
                $returnQuery=mysqli_query($link, "SELECT users.login, users.descr FROM users WHERE login='$user'");
                $returnQuery2=mysqli_query($link, "SELECT COUNT(posts.id) AS 'id' FROM users,posts WHERE login='$user' AND posts.creator = users.id");
                $row=mysqli_fetch_assoc($returnQuery);
                $row2=mysqli_fetch_assoc($returnQuery2);
                $postCount=$row2["id"];
                $login=$row["login"];
                $desc=$row["descr"];
                echo "<div style='width: 300px; height: 100%; background-color: #777777; color: white; float: left; border-right: 2px solid black'>
                <p style='text-align: center; margin-top: 30px; margin-bottom: 30px; font-size: 23px;'><b> $user</b></p>
                <p style='text-align:center;'><b>Liczba postów</b>: $postCount</p>";
                
                if(isset($_SESSION["zalogowany"]))
                {
                    $c=$_SESSION["login"];
                    if($c == "$user")
                    {
                         echo "<button type='button' style='width: 100px; height: 20px; margin-top: 15px; margin-left: 100px;' onclick='location.href=`addPost.php`'>Dodaj post</button>";  
                        if($c =="admin") 
                        echo "<button type='button' style='width: 100px; height: 40px; margin-top: 15px; margin-left: 100px;' onclick='location.href=`addCategory.php`'>Dodaj Kategorie</button>";  
                    }
                }
                echo "</div>";
                echo "<div style='width: 698px; height: 100%; background-color: #ededed;float: left; overflow: auto;'>
                    <p style='text-align: center; margin-top: 10px;'><b>Opis użytkownika</b></p>
                    <form action='profil.php?user=$user' method='post' style='margin: 0px;'>
                    <textarea name='describtion' type='text' id='area'>$desc</textarea>
                    <input type='submit' value='Zaktualizuj opis' style='margin-top:5px; margin-left: 290px;' name='przycisk'>
                    </form>
                </div>";
            
                if(isset($_POST["przycisk"]))
                {
                    if(isset($_SESSION["login"]))
                    {
                        if($_SESSION["login"] == "$user")
                        {
                            $data=$_POST["describtion"];
                            mysqli_query($link, "UPDATE users SET descr='$data' WHERE login='$user'");
                            header("Refresh: 0");
                        }
                    }
                }

            ?>
        </div>
        <div id="footer">
            @Copyright Adam Hallmann
        </div>
        
    </body>
</html>