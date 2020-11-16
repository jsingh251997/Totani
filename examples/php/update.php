<?php

    echo("INSIDE POST ID");
    $id=$_POST['data'];
    echo $id;  
    echo("<br>");
    echo("AFTER ID PRINT");
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Time FROM posts WHERE id = '$id'");
    while($row = mysqli_fetch_array($res)) {
        echo($row['Time']);
        echo("<br>");
    }
    // $id = 1;

?>