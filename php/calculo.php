<?php
$user = "edmar";
$password = "S&gredo87";
$database = "iot_casa";
$table = "plantinha";

try{
  $db = new PDO("mysql:host=localhost;dbname=$database",$user,$password);
  echo "<h2>DADOS PLANTINHA</h2>";
  foreach($db->query("SELECT item_id, umidade_AR, temperatura, data_hora, umidade_TERRA  FROM $table ORDER BY item_id DESC LIMIT 1") as $row) {
    echo "<li>Umidade do Ar: " .  $row['umidade_AR'] . " %</li>";
    echo "<li>Temperatura: " . $row['temperatura'] . "C</li>";
    echo "<li>Umidade da Terra: " . $row['umidade_TERRA'] . "%</li>";
    echo "<li>Data e hora: " . $row['data_hora'] . "</li>";
  }
    echo "</ul>";
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
