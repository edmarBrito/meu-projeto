<?php
//muda o fuso horario para  Sao Paulo
date_default_timezone_set('America/Sao_Paulo');

// Variaveis para guardar o paramnetro GET
$umidade =  $_GET['u'];
$temperatura =  $_GET['t'];
$corrente = $_GET['c'];
$chave = $_GET['key'];
//Verifica se a chave e valida
if ($chave != 'secreto'){
     echo 'chave invalida' ;
     die();
}

//Variaveis do PDO
//Database handler para se conectar e gerenciar o banco de dados
$dbh;
//statement para armazenar uma query do banco de dados e executa-la
$stm;

//String de conecxao com o banco de dados
$connStr = 'mysql:host=localhost:3306;dbname=testEsp32';
//comando que tenta se conectar com o banco (try, catch)
try{
    //se conecta ao banco da string
    //com usuario root e senha em branco (Padrao do XAMPE)
    $dbh = new PDO($connStr, 'edmar', 'Tecnologia'); //'root', '@123Comida');
}
catch(PDOException $e){
    //Caso ocorra erro retorna e encerra a execucao (Funcao DIE)
    echo $e->getMessage();
    die();
//prepara uma query com tres parametrosd nomeados
$stm = $dbh->prepare('INSERT INTO medicoes_dbt11(umidade, temperatura, data_hora, corrente) VALUES (:umidade, :temperatura, :data_hora, :corrente)');

//Define os valores das variaveis aos paramentros nomeados da query
//no ultimo define formato yyyy-mmdd hh:ii:ss
$stm->bindValue(':umidade', $umidade);
$stm->bindValue(':temperatura', $temperatura);

$stm->bindValue(':data_hora', date("Y-m-d H:i:s"));
$stm->bindValue(':corrente', $corrente);

// Tenta executar o comando e retorna  sucesso ou erro
if($stm->execute()){
    echo'sucesso';
}else{
    echo'erro';
}
