<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
  unset($_SESSION['usuario']);
  unset($_SESSION['senha']);
  header('Location: login.php');
}
//fazer um carrinho para cada usuário
// cria um carrinho de compras para o usuário, caso não exista
if (!isset($_SESSION['usuarios_carrinhos'])) {
  $_SESSION['usuarios_carrinhos'] = array();
}

// Verifica se o carrinho do usuário já existe ou cria um
if (!isset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']])) {
  $_SESSION['usuarios_carrinhos'][$_SESSION['usuario']] = array();
}

// adicionar um item ao carrinho do usuário
function adicionarAoCarrinho($id, $nome, $preco)
{
  if (isset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id])) {
    // Se o item já estiver no carrinho, aumente a quantidade
    $_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id]['quantidade']++;
  } else {
    // Caso contrário, crie um novo item no carrinho do usuário
    $item = array(
      'id' => $id,
      'nome' => $nome,
      'preco' => $preco,
      'quantidade' => 1
    );
    $_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id] = $item;
  }
  header('Location: carrinho.php');
}

//remover um item do carrinho do usuário
function removerDoCarrinho($id)
{
  if (isset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id])) {
    if ($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id]['quantidade'] > 1) {
      // Se houver mais de um item, diminua a quantidade
      $_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id]['quantidade']--;
    } else {
      // Caso contrário, remova o item do carrinho do usuário
      unset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']][$id]);
    }
  }
  header('Location: carrinho.php');
}

//Verifica se algum item foi adicionado ao carrinho
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $preco = $_POST['preco'];

  adicionarAoCarrinho($id, $nome, $preco);
}

// Verifica se algum item foi removido do carrinho
if (isset($_GET['remover'])) {
  $id = $_GET['remover'];
  removerDoCarrinho($id);
}

//calcular o valor total do carrinho do usuário
function calcularValorTotal()
{
  $total = 0;
  if (isset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']])) {
    foreach ($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']] as $item) {
      $total = $total + ($item['preco'] * $item['quantidade']);
    }
  }
  return $total;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Carrinho de Compras</title>
  <link rel="stylesheet" href="../css/carrinho.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
  <header>
    <span>Carrinho de compras do <b><?php echo $_SESSION['usuario'] ?></b></span>

  </header>
  <main>
    <div class="page-title">Seu Carrinho, <?php echo $_SESSION['usuario'] ?></div>
    <div class="content">
      <section>
        <table>
          <thead>
            <tr>
              <th>Produto</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th>Total</th>
              <th>-</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']])) {
              foreach ($_SESSION['usuarios_carrinhos'][$_SESSION['usuario']] as $id => $item) {
                echo "<tr class='product-row'>";
                echo "<td>{$item['nome']}</td>";
                echo "<td>R$ {$item['preco']}</td>";
                echo "<td>{$item['quantidade']}</td>";
                echo "<td>R$ " . ($item['preco'] * $item['quantidade']) . "</td>";
                echo "<td><a href='carrinho.php?remover={$id}' class='remove-link'>Remover</a></td>";
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </section>
      <aside>
        <div class="box">
          <header>Resumo da compra</header>
          <div class="info">
            <div><span>Sub-total</span><span>R$ <?php echo calcularValorTotal(); ?></span></div>
            <div><span>Frete</span><span>Gratuito</span></div>
            <div>
              <button>
                Adicionar cupom de desconto
                <i class="bx bx-right-arrow-alt"></i>
              </button>
            </div>
          </div>
          <footer>
            <span>Total</span>
            <span>R$ <?php echo calcularValorTotal(); ?></span>
          </footer>
        </div>
        <form method="post" action="confirmar_pedido.php">
          <button class="confirm-button" type="submit" name="confirmar_pedido">Confirmar Compra</button>
        </form>
      </aside>
    </div>
    <div>
      <span>
        <a class="home" href="../index.php"><button>Home</button></a>
      </span>
      <span>
        <a class="sairbt" href="./sair.php"><button>Sair</button></a>
      </span>
    </div>
  </main>
</body>

</html>