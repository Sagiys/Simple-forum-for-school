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
            <form action="register.php" method="post" style="text-align:center;">
                <h2>Zarejestruj</h2>
                Login <br>
                <input type="text" name="login"><br>
                Password <br>
                <input type="password" name="password"><br>
                Powtorz Haslo <br>
                <input type="password" name="rePassword"><br>
                <input type="submit" value="Zarejestruj" style="margin-top: 5px;">
            </form>
            
            <?php
              if(isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["rePassword"]))
              {
                  if(empty($_POST["login"]) || empty($_POST["password"]) || empty($_POST["rePassword"]))
                  {
                      echo "<script>window.alert('Wypelnij wszystkie pola');</script>";
                  }else
                  {
                      $login=$_POST["login"];
                      $password=$_POST["password"];
                      $rePassword=$_POST["rePassword"];
                      if($password==$rePassword)
                      {
                          $link=mysqli_connect("localhost", "root", "", "forum");
                          $returnQuery=mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
                          if($returnQuery->num_rows != 0) echo "<script>window.alert('Taki użytkownik już istnieje');</script>";
                          else {
                              $password=sha1(sha1($password));
                              mysqli_query($link, "INSERT INTO users VALUES('', '$login', '$password', '')");
                              echo "<script>window.alert('Pomyslnie zarejestrowano uzytkownika o nicku $login');</script>";
                          }
                    }else{
                          echo "<script>window.alert('Hasla nie są zgodne');</script>";
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