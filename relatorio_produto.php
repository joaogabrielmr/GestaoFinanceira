<?php
include('config.php');

// Seleciona apenas os produtos que têm quantidade em estoque maior que 0
$sql = "SELECT * FROM produtos WHERE quantidade > 0";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos</title>
</head>
<body>

<div class="container">
<table class="report-table">
    <tr>
        <th>Código do Produto</th>
        <th>Nome do Produto</th>
        <th>Tipo de Produto</th>
        <th>Estado</th>
        <th>Cidade</th>
        <th>Quantidade em Estoque</th>
        <th>Valor</th>
    </tr>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['codigo_produto'] . "</td>";
                        echo "<td>" . $row['nome'] . "</td>"; 
                        echo "<td>" . $row['tipo'] . "</td>"; 
                        echo "<td>" . $row['estado'] . "</td>"; 
                        echo "<td>" . $row['cidade'] . "</td>"; 
                        echo "<td>" . $row['quantidade'] . "</td>"; 
                        echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum produto cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../../cadastro_produto.php" class="home-link">Adicionar Produtos</a>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
