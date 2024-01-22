<?php
if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    echo '<script>alert("Usuário ou email já cadastrado.");</script>';
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro.css">
    <title>Cadastre-se</title>
</head>

<body>
    <div class="main-login">
        <div class="esquerda">
            <h1>AOKI BAGS</h1>
            <a href="../index.php"><img src=../img/logo_eco-removebg-preview.png alt="logo"></a>
            <!-- <img src="../img/logo_eco-removebg-preview.png" class="logo" alt="sacolas"> -->
        </div>
        <form action="registrar.php" method="post">
            <div class="direita">
                <div class="caixa-login">
                    <h1>Cadastro</h1>
                    <div class="text">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="usuario" placeholder="Usuário" required>
                    </div>
                    <div class="text">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>
                    <div class="text">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" placeholder="Nome Completo" required>
                    </div>
                    <div class="text">
                        <label for="email">Email</label>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="text">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" placeholder="Endereço" required>
                    </div>
                    <div class="text">
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" name="data_nasc" required>
                    </div>
                    <input class="botao-cadastro" type="submit" name="submit" value="Cadastre-se">
                </div>
            </div>
        </form>
    </div>
</body>

</html>