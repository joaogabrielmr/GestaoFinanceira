<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Vendas</title>
</head>
<body>

    <div class="container">
       
        <table class="report-table">
            <tr>
                <th>Código do Produto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Data de Venda</th>
                <th>UF</th>
                <th>Estado</th>
                <th>Valor Total</th>
            </tr>
            <?php
            include('config.php');

            // Assuming the correct table name is 'vendas' instead of 'vendas2'
            $sql = "SELECT v.codigo_produto, v.nome_produto as nome, v.quantidade, v.data_venda, p.estado as uf, p.cidade as estado, v.valor as valor_total
                    FROM vendas v
                    JOIN produtos p ON v.codigo_produto = p.codigo_produto";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["codigo_produto"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["quantidade"] . "</td>";
                    echo "<td>" . $row["data_venda"] . "</td>";
                    echo "<td>" . $row["uf"] . "</td>";
                    echo "<td>" . $row["estado"] . "</td>";
                    echo "<td>" . number_format($row["valor_total"], 2, ',', '.') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nenhuma venda encontrada</td></tr>";
            }

            $mysqli->close();
            ?>
        </table>
        <a href="../../cadastro_venda.php" class="home-link">Registrar venda</a>
</body>
</html>
