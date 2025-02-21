<?php
include('config.php');

// Consulta SQL para o relatório de vendas agrupado por estado, cidade e mês nos últimos 12 meses
$sql = "SELECT 
            YEAR(data_venda) AS ano,
            MONTH(data_venda) AS mes,
            estado_venda,
            cidade_venda,
            data_venda,
            SUM(quantidade) AS total_vendas
        FROM vendas
        WHERE data_venda >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
        GROUP BY YEAR(data_venda), MONTH(data_venda), estado_venda, cidade_venda
        ORDER BY ano DESC, mes DESC, estado_venda, cidade_venda";

$result = $mysqli->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'estado' => $row['estado_venda'],
            'cidade' => $row['cidade_venda'],
            'data_venda' => date('F Y', strtotime($row['data_venda'])),
            'total_vendas' => $row['total_vendas']
        ];
    }
}

$mysqli->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
