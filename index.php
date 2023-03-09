<?php
include('conexao2.php');


if(isset($_POST['email']) || isset($_POST['senha'])){

    if(strlen($_POST['email']) == 0){
    echo "Preencha seu email";
} else if(strlen($_POST['senha']) == 0){
    echo("Preencha sua senha");
} else{

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
 
    $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha ='$senha'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do codigo sql: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if($quantidade == 1){

        $usuario = $sql_query->fetch_assoc();

        if(!isset($_SESSION)){
            session_start();
        }

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['email'];


        header("location: painel.php");

    } else {
        echo "Falha ao logar! E-mail ou senha incorretos";
    }

    }

 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        acesse sua conta
    </h1>
    <form method="post">
    <p>
        <label>E-mail</label>
        <input type="text" name="email" placeholder="email">
    </p>
    <p>
        <label>senha</label>
        <input type="text" name="senha" placeholder="senha"> 
    </p>
 
    <p>
        <button type="submit">Entrar</button>
    </p>
</form>
</body>
</html>