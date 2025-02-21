<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venda de Produto</title>
    <link rel="stylesheet" type="text/css" href="assets/style/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/style/styles_header.css">
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
<form action="cadastro_venda.php" method="post">
    <h2>Registrar Venda de Produto</h2>
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
            <td>Estado:</td>
            <td><input type="text" id="estado" name="estado" required></td>
        </tr>
        <tr>
            <td>Cidade:</td>
            <td><input type="text" id="cidade" name="cidade" required></td>
        </tr>
        <tr>
            <td>Data da Venda:</td>
            <td><input type="date" id="data_venda" name="data_venda" required></td>
        </tr>
        <tr>
            <td>Quantidade:</td>
            <td><input type="number" id="quantidade" name="quantidade" required></td>
        </tr>
        <tr>
            <td>Valor (por unidade):</td>
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
    $nome_produto = $_POST['nome'];
    $estado_venda = $_POST['estado'];
    $cidade_venda = $_POST['cidade'];
    $quantidade = $_POST['quantidade'];
    $data_venda = $_POST['data_venda'];
    $valor = $_POST['valor'];
    
    // Verifique se há quantidade suficiente do produto em estoque
    $sql_verifica_estoque = "SELECT quantidade FROM produtos WHERE codigo_produto = ?";
    $stmt_verifica_estoque = $mysqli->prepare($sql_verifica_estoque);
    $stmt_verifica_estoque->bind_param("s", $codigo_produto);
    $stmt_verifica_estoque->execute();
    $stmt_verifica_estoque->store_result();

    if ($stmt_verifica_estoque->num_rows == 1) {
        $stmt_verifica_estoque->bind_result($quantidade_estoque);
        $stmt_verifica_estoque->fetch();
        
        if ($quantidade_estoque >= $quantidade) {
            // Calcule o valor total
            $valor_total = $valor * $quantidade;
            
            // Inicie uma transação
            $mysqli->begin_transaction();
            
            try {
                // Insere a venda no banco de dados
                $sql_venda = "INSERT INTO vendas (codigo_produto, nome_produto, estado_venda, cidade_venda, quantidade, data_venda, valor) 
                              VALUES (?, ?, ?, ?, ?, STR_TO_DATE(?, '%Y-%m-%d'), ?)";
                $stmt_venda = $mysqli->prepare($sql_venda);
                $stmt_venda->bind_param("ssssisd", $codigo_produto, $nome_produto, $estado_venda, $cidade_venda, $quantidade, $data_venda, $valor_total);
                $stmt_venda->execute();
                
                // Atualiza a quantidade do produto no estoque
                $sql_estoque = "UPDATE produtos SET quantidade = quantidade - ? WHERE codigo_produto = ?";
                $stmt_estoque = $mysqli->prepare($sql_estoque);
                $stmt_estoque->bind_param("is", $quantidade, $codigo_produto);
                $stmt_estoque->execute();
                
                // Commit a transação
                $mysqli->commit();
                echo "<script>window.open('http://localhost/financeiro/dashboard/html/index.html', '_blank');</script>";
            } catch (Exception $e) {
                // Rollback a transação em caso de erro
                $mysqli->rollback();
                echo "Erro ao registrar a venda ou atualizar o estoque: " . $mysqli->error;
            }
        } else {
            echo "Erro: Quantidade insuficiente em estoque.";
        }
    } else {
        echo "Erro: Produto não encontrado.";
    }
}
?>


</body>
</html>
