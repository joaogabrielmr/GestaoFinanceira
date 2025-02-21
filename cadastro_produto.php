<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/style/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/style/styles_header.css">
    <title>Cadastro de Produto</title>
</head>
<body>
<header>
        <a href="index.html">
        <div class="logo">
            <img src="assets/images/logo.jpeg" alt="Detran PR Logo">
        </div> </a>
        <div  class="site-name">Gestão Financeira</div> 
        <nav>
            <ul class="nav-links">
                <li><a href="sobre.html">Contato</a></li>

            </ul>
        </nav>
    </header>
    <div class="container"></div>
    <form action="cadastro_produto.php" method="post">
        <h2>Cadastro de Produto</h2>
        <table>
            <tr>
                <td>Código do Produto:</td>
                <td><input type="number" id="codigo_produto" name="codigo_produto" required></td>
            </tr>
            <tr>
                <td>Nome do Produto:</td>
                <td><input type="text" id="nome" name="nome" required></td>
            </tr>
            <tr>
                <td>Tipo de Produto:</td>
                <td><input type="text" id="tipo" name="tipo" required></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input type="text" id="estado" name="estado" required></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input type="text" id="cidade" name="cidade" required></td>
            </tr>
            <tr>
                <td>Quantidade em Estoque:</td>
                <td><input type="number" id="quantidade" name="quantidade" required></td>
            </tr>
            <tr>
                <td>Valor:</td>
                <td><input type="number" step="0.01" id="valor" name="valor" required></td>
            </tr>
            <tr>
                <td class='botao' colspan="2"><input type="submit" value="Gravar" name="botao"></td>
            </tr>    
        </table>
    </form>

    <?php
    include('config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo_produto = $_POST['codigo_produto'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $estado = $_POST['estado'];  // Corrected variable
        $cidade = $_POST['cidade'];  // Corrected variable
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor'];

        $sql = "INSERT INTO produtos (codigo_produto, nome, tipo, estado, cidade, quantidade, valor) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("issssdi", $codigo_produto, $nome, $tipo, $estado, $cidade, $quantidade, $valor); // Corrected types and added parameters

        if ($stmt->execute()) {
            echo "<script>window.open('http://localhost/financeiro/dashboard/html/estoque_produtos.html', '_blank');</script>";
        } else {
            echo "Erro ao cadastrar produto: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }
    ?>
</body>
</html>
