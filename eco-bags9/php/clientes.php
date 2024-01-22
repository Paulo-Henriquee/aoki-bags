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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/clientes.css">
    <title>Busca Clientes</title>
</head>

<body>
    <header>
        <a href="../index.php"><img src=../img/logo_eco-removebg-preview.png alt="logo"></a>
        <h1> Bem vindo, <?php echo $_SESSION['usuario'] ?></h1>
        <a href="./sair.php"><button class="bt-sair">Sair</button></a>
    </header>
    <h1>Clientes</h1>
    <form action="">
        <input name="busca" value="<?php if (isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nome do Cliente</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Data de Nascimento</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
        ?>
            <tr>
                <td colspan="6">Digite algo para pesquisar...</td>
            </tr>
            <?php
        } else {
            $pesquisa = $conexao->real_escape_string($_GET['busca']);
            $sql_code = "SELECT * 
                FROM clientes 
                WHERE id LIKE '%$pesquisa%' 
                OR usuario LIKE '%$pesquisa%'
                OR nome_cliente LIKE '%$pesquisa%'
                OR email LIKE '%$pesquisa%'";
            $sql_query = $conexao->query($sql_code) or die("ERRO ao consultar!");

            if ($sql_query->num_rows == 0) {
            ?>
                <tr>
                    <td colspan="6">Nenhum resultado encontrado...</td>
                </tr>
                <?php
            } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $dados['id']; ?></td>
                        <td><?php echo $dados['usuario']; ?></td>
                        <td><?php echo $dados['nome_cliente']; ?></td>
                        <td><?php echo $dados['email']; ?></td>
                        <td><?php echo $dados['endereco']; ?></td>
                        <td><?php echo $dados['data_nasc']; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        <?php
        } ?>
    </table>
</body>

</html>

</html>