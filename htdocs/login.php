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
            <form action="login.php" method="post" style="text-align:center;">
                <h2>Zaloguj sie</h2>
                Login <br>
                <input type="text" name="login"><br>
                Password <br>
                <input type="password" name="password"><br>
                <input type="submit" value="Zaloguj" style="margin-top: 5px;">
            </form>
            
            <?php
              if(isset($_POST["login"]) && isset($_POST["password"]))
              {
                  if(empty($_POST["login"]) || empty($_POST["password"]))
                  {
                       echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                  }else{
                      $login=$_POST["login"];
                      $password=$_POST["password"];
                      $password=sha1(sha1($password));
                      $link=mysqli_connect("localhost", "root", "", "forum");
                      $returnQuery=mysqli_query($link, "SELECT * FROM users WHERE login='$login' AND password='$password'");
                      if($returnQuery->num_rows==0) echo "<script>window.alert('Błędne dane logowania');</script>";
                      else{
                          echo "<script>window.alert('Zalogowano użytkownika $login');</script>";
                          $_SESSION["zalogowany"]=1;
                          $_SESSION["login"]=$login;
                          header("Location:index.php");
                          
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