<?php
// Muda o fuso horário do PHP para São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Variáveis para guardar os parâmetros GET
$u_AR = $_GET['u'];
$temperatura = $_GET['t'];
$u_TERRA = $_GET['c'];
$chave = $_GET['key'];
// Verifica se a chave enviada é válida
if($chave != 'secreto'){ 
    echo 'chave invalida' ;
    die();
}

// Variáveis do PDO:
//Database handler para se conectar e gerenciar o banco de dados
$dbh;
// Statement para armazenar uma query do banco e executa-la
$stmt;

// String de conexão do banco de dados
$connStr = 'mysql:host=localhost:3306;dbname=iot_casa'; // testEsp32
// Comando que tenta se conectar ao banco (try, catch)
try{
    // Se conecta ao banco da string
    //com usuário root e senha em branco (padrões do XAMPP)
    $dbh = new PDO($connStr, 'edmar', 'S&gredo87'); //root @123Comida
}
catch(PDOException $e){
    // Caso ocorra erro o retorna e encerra a execução (função die)
    echo $e->getMessage();
    die();
}
// Prepara uma query com quatro parâmetros nomeados
$stmt = $dbh->prepare('INSERT INTO plantinha(umidade_AR,temperatura,data_hora,umidade_TERRA) VALUES (:u_AR, :temperatura, :data_hora, :u_TERRA)'); //, :corrente)'

// Define os valores das variáveis aos parâmetros nomeados da query
//no último define formato yyyy-mm-dd hh:ii:ss
$stmt->bindValue(':u_AR', $u_AR);
$stmt->bindValue(':temperatura', $temperatura); 
//$stmt->bindvalue(':data_hora','2022-01-18 09:31:10');
$stmt->bindValue(':data_hora', date("Y-m-d H:i:s"));
$stmt->bindValue(':u_TERRA', $u_TERRA);

// Tenta executar o comando e retorna sucesso ou erro
if($stmt->execute()){
    echo 'sucesso';
}else{
    echo 'erro';
}
