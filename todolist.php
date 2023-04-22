<?php
$user = "edmar";
$password = "S&gredo87";
$database = "iot_casa";
$table = "todo_list";

try{
  $db = new PDO("mysql:host=localhost;dbname=$database",$user,$password);
  echo "<h2>BANCO DE DADOS TODO</h2>"; 
  foreach($db->query("SELECT content FROM $table") as $row) {
    echo "<li>" . $row['content'] . "</li>";
  }
  echo "</ol>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

