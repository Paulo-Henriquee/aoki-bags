<?php
session_start();

// Verificar se ta logado
if (!isset($_SESSION['usuario']) && !isset($_SESSION['senha'])) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    header('Location: login.php');
    exit; 
}

if (isset($_POST['confirmar_pedido'])) {
    

    include_once('conn.php');

    $id_clientes = $_SESSION['id'];
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM clientes WHERE id = '$id_clientes'";
    
    $resultado = $conexao->query($sql);

    if (mysqli_num_rows($resultado) == 1) {


        foreach ($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']] as $item) {
            $id = $item['id'];
            $nome_pedido = $item['nome'];
            $preco = $item['preco'];
            $quantidade = $item['quantidade'];

            // insert para o banco de dados
            $result = mysqli_query($conexao, "INSERT INTO pedidos (id_clientes, nome_pedido, data_pedido, data_entrega, preco, quantidade) 
        VALUES ($id_clientes, '$nome_pedido', NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), '$preco', $quantidade)");
        }
    }

       

    // zerar carrinho pós compra
    $_SESSION['usuarios_carrinhos'][$_SESSION['usuario']] = array();

   
    // mensagem de confirmação
    header('Location: confirmacao.php');
    
}

?>