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
    <link rel="stylesheet" href="../css/pedidos.css">
    <title>Busca Pedidos</title>
</head>

<body>
    <header>
        <a href="../index.php"><img src=../img/logo_eco-removebg-preview.png alt="logo"></a>
        <h1> Bem vindo, <?php echo $_SESSION['usuario'] ?></h1>
        <a href="./sair.php"><button class="bt-sair">Sair</button></a>
    </header>
    <h1>Pedidos</h1>
    <form action="">
        <input name="busca" value="<?php if (isset($_GET['busca'])) echo $_GET['busca']; ?>" placeholder="Digite os termos de pesquisa" type="text">
        <button type="submit">Pesquisar</button>
    </form>
    <br>
    <table>
        <tr>
            <th>ID Pedido</th>
            <th>Nome do Cliente</th>
            <th>Endereço</th>
            <th>Nome do Produto</th>
            <th>Data do Pedido</th>
            <th>Data da Entrega</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Preço a Pagar</th>
        </tr>
        <?php
        if (!isset($_GET['busca'])) {
        ?>
            <tr>
                <td colspan="9">Digite algo para pesquisar...</td>
            </tr>
            <?php
        } else {
            $pesquisa = $conexao->real_escape_string($_GET['busca']);
            $sql_code = "SELECT pedidos.id_pedidos, 
            clientes.nome_cliente, 
            clientes.endereco, 
            pedidos.nome_pedido, 
            pedidos.data_pedido, 
            pedidos.data_entrega, 
            pedidos.preco, 
            pedidos.quantidade,
            (pedidos.preco * pedidos.quantidade) AS preco_total
            FROM clientes JOIN pedidos ON clientes.id = pedidos.id_clientes
            WHERE pedidos.id_pedidos LIKE '%$pesquisa%' 
            OR clientes.nome_cliente LIKE '%$pesquisa%'
            OR pedidos.nome_pedido LIKE '%$pesquisa%'
            OR pedidos.data_pedido LIKE '%$pesquisa%'
            OR pedidos.data_entrega LIKE '%$pesquisa%'";
            $sql_query = $conexao->query($sql_code) or die("ERRO ao consultar!");

            if ($sql_query->num_rows == 0) {
            ?>
                <tr>
                    <td colspan="9">Nenhum resultado encontrado...</td>
                </tr>
                <?php
            } else {
                while ($dados = $sql_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $dados['id_pedidos']; ?></td>
                        <td><?php echo $dados['nome_cliente']; ?></td>
                        <td><?php echo $dados['endereco']; ?></td>
                        <td><?php echo $dados['nome_pedido']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($dados['data_pedido'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($dados['data_entrega'])); ?></td>
                        <td><?php echo 'R$ ' . number_format($dados['preco'], 2, ',', '.'); ?></td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo 'R$ ' . number_format($dados['preco_total'], 2, ',', '.'); ?></td>

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