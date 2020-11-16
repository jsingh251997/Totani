<?php

//INSERT ADDS THE ACTUAL EVENTS TO THE CALENDAR

$connect = new PDO('mysql:host=localhost;dbname=totani_alerts', 'root', '');

$data = array();

$query = "SELECT * FROM posts ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["Section"],
  'start'   => $row["Time"],
  'Section' => $row["Section"]
 );
}
echo json_encode($data);

?>