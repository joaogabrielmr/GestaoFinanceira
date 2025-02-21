<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Relatório de Funcionários</title>
<?php include('config.php'); ?>
</head>
<body>
<div class="container">
    <table class="report-table">
        <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>RG</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Data de Nascimento</th>
            <th>Estado Civil</th>
            <th>Cargo</th>
        </tr>
        <?php
            $query_func = "SELECT codigo_funcionario, nome, cpf, rg, estado, cidade, data_nascimento, estado_civil, cargo
                           FROM funcionarios
                           ORDER BY codigo_funcionario";
            $result_func = mysqli_query($mysqli, $query_func);

            while ($coluna = mysqli_fetch_array($result_func)) {
        ?>
        <tr>
            <td><?php echo $coluna['codigo_funcionario']; ?></td>
            <td><?php echo $coluna['nome']; ?></td>
            <td><?php echo $coluna['cpf']; ?></td>
            <td><?php echo $coluna['rg']; ?></td>
            <td><?php echo $coluna['estado']; ?></td>
            <td><?php echo $coluna['cidade']; ?></td>
            <td><?php echo $coluna['data_nascimento']; ?></td>
            <td><?php echo $coluna['estado_civil']; ?></td>
            <td><?php echo $coluna['cargo']; ?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <a href="../../cadastro_funcionario.php" class="home-link">Adicionar Funcionarios</a>
</div>
</body>
</html>
