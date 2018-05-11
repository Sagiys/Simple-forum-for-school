<?php 
    if(isset($_SESSION["zalogowany"])){
        if(isset($_SESSION["login"]))
            $login=$_SESSION["login"];
        echo "Witaj $login";
        echo "<span><a href='search.php'>Szukaj</a>&emsp;<a href='daily.php'>Post dnia</a>
        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
        <a href='profil.php?user=$login'>Moj Profil</a> &emsp; <a href='logout.php'>Wyloguj się</a></span>";
    }else{
        echo "Witaj!";
        echo "<span><a href='login.php'>Zaloguj się</a> &emsp; <a href='register.php'>Zarejestruj się</a></span>";
    }
?>