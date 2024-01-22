<?php
session_start();
include_once('conn.php');
// Verificar se ta logado
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'teste4') {
    header('Location: ../index.php');
    exit; // Certifique-se de sair após o redirecionamento
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adm.css">
    <title>Administração</title>
</head>

<body>
    <header>
        <h1> Bem vindo, <?php echo $_SESSION['usuario'] ?></h1>
    </header>

    <body>
        <div class="main-login">
            <div class="esquerda">
                <h1>AOKI BAGS</h1>
                <a href="../index.php"><img src=../img/logo_eco-removebg-preview.png alt="logo"></a>
                <!-- <img src="../img/logo_eco-removebg-preview.png" class="logo" alt="sacolas"> -->
            </div>

            <div class="direita">
                <div class="caixa-login">
                    <h1>Selecione a opção: </h1>
                    <div class="text">
                        <form action="./clientes.php" method="POST">
                            <input class="bt-adm" type="submit" value="Clientes">
                        </form>
                    </div>
                    <div class="text">
                        <form action="./pedidos.php" method="POST">
                            <input class="bt-adm" type="submit" value="Pedidos">
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </body>

</body>

</html>