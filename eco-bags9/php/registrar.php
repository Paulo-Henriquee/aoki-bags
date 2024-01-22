<?php

if (isset($_POST['submit'])) {
    

    include_once('conn.php');

    //parametros do DB
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']);
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $data_nasc = $_POST['data_nasc'];
    $endereco = $_POST['endereco'];

    //comparação login ou email já existente
    $sql = "SELECT * FROM clientes WHERE  usuario = '$usuario' OR email = '$email'";

    $resultado = $conexao->query($sql);

      
    if (mysqli_num_rows($resultado) < 1) 
    {
    $result = mysqli_query($conexao, "INSERT INTO clientes(usuario,senha,nome_cliente,email,endereco,data_nasc) 
        VALUES ('$usuario','$senha','$nome','$email', '$endereco', '$data_nasc')");
        
        header('Location: login.php');
    } else {
       //Erro para janela de alerta que está no cadastro 
        header('Location: cadastro.php?erro=1');
       
    }
    

}
