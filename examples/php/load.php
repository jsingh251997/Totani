<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../../lib/main.css' rel='stylesheet' />
<title>Title with database</title>
</head>
<body>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Cause</th>
        <th>Section</th>
        <th>Solution</th>
    </tr>
    <?php
       $conn = mysqli_connect("localhost","root","","totani_alerts");
       $sql = "SELECT id,Section,Problem,Cause,Solution from posts";
       $result = $conn-> query($sql);
       if($result-> num_rows > 0){
            while($row = $result-> fetch_assoc()){
                echo "<tr><td>".$row["id"]."</td><td>".$row["Section"]."</td><td>"
                .$row["Problem"]."</td><td>".$row["Cause"]."</td><td>".$row["Solution"]."</tr><td>";
            }
            echo "</table>";
       }
     $conn-> close();   
    ?>
    
</table>
</body>

</html>