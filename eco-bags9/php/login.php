<?php
session_start();
include_once('conn.php');
// Verificar se ta logado
if (!isset($_SESSION['usuario'])) {
    header("Location: novo_login.php");
} else {
    header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <div class="esquerda">
            <h1>AOKI BAGS</h1>
            <a href="../index.php"><img src=../img/logo_eco-removebg-preview.png alt="logo"></a>
            <!-- <img src="../img/logo_eco-removebg-preview.png" class="logo" alt="sacolas"> -->
        </div>
        <form action="testeLogin.php" method="POST">
            <div class="direita">
                <div class="caixa-login">
                    <h1>Login</h1>
                    <div class="text">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" placeholder="Usuário" required>
                    </div>
                    <div class="text">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="h-captcha" data-sitekey="b09bf48a-b9f0-47ba-9809-610f81227411"></div>
                    <input class="botao-login" type="submit" value="Login">
                    <p class="cad">Ainda não tem uma conta?<a href="./cadastro.php" target="_parent">Cadastre-se
                            aqui!</a></p>
                    <p class="rec">Esqueceu sua senha? Recupere aqui.</p>
                </div>
            </div>
        </form>
    </div>
</body>

</html>