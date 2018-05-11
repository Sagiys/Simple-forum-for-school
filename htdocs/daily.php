<?php
    $link=mysqli_connect("localhost", "root", "", "forum");
    $returnQuery=mysqli_query($link, "SELECT id FROM posts WHERE priority=1");
    if($returnQuery-> num_rows == 1)
    {
        $r=mysqli_fetch_assoc($returnQuery);
        $id=$r["id"];
        header("Location: post.php?post=$id");
    }else{
        header("Location: error.php");        
    }
?>