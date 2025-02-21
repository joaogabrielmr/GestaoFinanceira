<?php
include('config.php');

// Recupera as vendas do banco de dados agrupadas por ano e mês
$sql = "SELECT YEAR(data_venda) AS ano, MONTH(data_venda) AS mes, SUM(valor) AS total_vendas 
        FROM vendas 
        GROUP BY YEAR(data_venda), MONTH(data_venda)
        ORDER BY ano ASC, mes ASC";
$result = $mysqli->query($sql);

$meses = [];
$total_vendas = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Converte o número do mês para o nome do mês com o ano
        $meses[] = date("F Y", mktime(0, 0, 0, $row['mes'], 10, $row['ano']));
        $total_vendas[] = $row['total_vendas'];
    }
} else {
    echo json_encode(['labels' => [], 'values' => []]);
    exit;
}

$mysqli->close();

// Retorna os dados como JSON
echo json_encode(['labels' => $meses, 'values' => $total_vendas]);
?>
