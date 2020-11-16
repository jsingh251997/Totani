<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../style.css' rel='stylesheet' />
<style type="text/css">
    table{
        border-collapse: collapse;
        width: 100%;
        color: black;
        font-family: monospace;
        font-size: 25px;
        text-align: left;
    }
    th{
        background-color: darkcyan;
        color: white;
    }
</style>
</head>
<body>
<h2>YOOO LET'S FILTER</h2>
<div id="demo-grid">
    <form method="POST" name="search" action="load.php">
    <select name="Time" id="Tim">
    <option selected="Time" value="0">Time</option>
    <?php
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Time FROM posts");
    while($row = mysqli_fetch_array($res)) {
        echo "<option value=\"$row[Time]\"";
        if (isset($_POST["Tim"])&&$_POST['Tim']==$row['Time']) {echo "selected='selected'"; } ;
        echo ">$row[Time]</option>";
    }
    ?>
    <label for="Time">Time</Time>
    </select>
    <select name="Section" id="Sect">
    <option selected="selected" value="0">Section</option>
    <?php
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Section FROM posts");
    while($row = mysqli_fetch_array($res)) {
        // echo("<option value='".$row['id']."'>".$row['Section']."</option>");
        // if($_POST['Section']==0){
        //     echo("<option value='".$row['id']."'>".$row['Section']."</option>");
        // }
        // else{
        echo "<option value=\"$row[Section]\"";
        if (isset($_POST["Sect"])&&$_POST['Sect']==$row['Section']) {echo "selected='selected'"; } ;
        echo ">$row[Section]</option>";
        // }
    }
    ?>
    </select>
    <select name="Problem" id="Prob">
    <option selected="selected" value="0">Problem</option>
    <?php
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Problem FROM posts");
    while($row = mysqli_fetch_array($res)) {
        echo "<option value=\"$row[Problem]\"";
        if (isset($_POST["Prob"])&&$_POST['Prob']==$row['Problem']) {echo "selected='selected'"; } ;
        echo ">$row[Problem]</option>";
    }
    ?>
    <label for="Problem">Problem</label>
    </select>
    <select name="Cause" id="Cau">
    <option selected="selected" value="0">Cause</option>
    <?php
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Cause FROM posts");
    while($row = mysqli_fetch_array($res)) {
        echo "<option value=\"$row[Cause]\"";
        if (isset($_POST["Cau"])&&$_POST['Cau']==$row['Cause']) {echo "selected='selected'"; } ;
        echo ">$row[Cause]</option>";
    }
    ?>
    <label for="Cause">Cause</label>
    </select>
    <select name="Solution" id="Sol">
    <option selected="Solution" value="0">Solution</option>
    <?php
    $db = mysqli_connect("localhost","root","","totani_alerts");
    $res = mysqli_query($db, "SELECT DISTINCT Solution FROM posts");
    while($row = mysqli_fetch_array($res)) {
        echo "<option value=\"$row[Solution]\"";
        if (isset($_POST["Sol"])&&$_POST['Sol']==$row['Solution']) {echo "selected='selected'"; } ;
        echo ">$row[Solution]</option>";
    }
    ?>
    <label for="Solution">Solution</label>
    </select>
    <input type="submit" id="submit" value="Submit">
    </form>
</div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    ?>
    <table>
    <tr>
        <th>Id</th>
        <th>Section</th>
        <th>Problem</th>
        <th>Cause</th>
        <th>Solution</th>
        <th>Time</th>
    </tr>
    <?php

       $query = "SELECT * from posts";
       $i = 0;
       $selectedTime = $_POST['Time'];
       $selectedSection = $_POST['Section'];
       $selectedProblem = $_POST['Problem'];
       $selectedCause = $_POST['Cause'];
       $selectedSolution = $_POST['Solution'];
       $conn = mysqli_connect("localhost","root","","totani_alerts");
       $sql_default = "SELECT id,Section,Problem,Cause,Solution,Time from posts WHERE";
       if($selectedSection != '0')
       { 
           $a = " Section='$selectedSection'";
       }
       else{
           $a = " Section IS NOT NULL";
       }
       if($selectedProblem != '0')
       { 
           $b= "AND Problem='$selectedProblem'";
       }
       else{
           $b = " AND Problem IS NOT NULL";
       }
       if($selectedCause != '0')
       { 
           $c = " AND Cause='$selectedCause'";
       }
       else{
           $c = " AND Cause IS NOT NULL";
       }
       if($selectedSolution != '0')
       { 
           $d = " AND Solution='$selectedSolution'";
       }
       else{
           $d = " AND Solution IS NOT NULL";
       }
       $sql = $sql_default.$a.$b.$c.$d;
       echo($sql);
       $result = $conn-> query($sql);
       if($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
                echo "<tr><td>".$row["id"]."</td><td>".$row["Section"]."</td><td>"
                .$row["Problem"]."</td><td>".$row["Cause"]."</td><td>".$row["Solution"]."</td><td>"
                .$row["Time"]."</tr><td>";
            }
            echo "</table>";
       }
     $conn-> close();   
    ?>
    
</table>
<?php
    }
    else{
        echo("SHIIIIIIIIT");
    }
    ?>
</body>

</html>