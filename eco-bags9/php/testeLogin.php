<?php
session_start();

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.hcaptcha.com/siteverify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => [
        'response' => $_POST['h-captcha-response'] ?? '',
        'secret' => 'ES_e7834026661e42ecb868fc3ddb951845'
    ]
]);

$response = curl_exec($curl);
curl_close($curl);

$responseArray = json_decode($response, true);

$sucesso = $responseArray['success'] ?? false;

if (!empty($_POST['usuario']) && !empty($_POST['senha']) && $sucesso)  {
    //Entrar
    include_once('conn.php');
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); //cripto


    $sql = "SELECT * FROM clientes WHERE  usuario = '$usuario' AND senha = '$senha'";

    $result = $conexao->query($sql);



    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    } else {
        $row = $result->fetch_assoc(); //linha de consulta
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;
        $_SESSION['id'] = $row['id']; // pegar o id do row
        $_SESSION['email'] = $row['email']; //pegar o email do row
        header('Location: ../index.php');
    }
} else {
    header('Location: login.php');
}
