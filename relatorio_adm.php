<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Relatório de Funcionários </title>
<?php include('config.php'); ?>
</head>
<body>
 
<div class="container">
    <table class="report-table">
        <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Email</th>
            <th>Senha</th>
        </tr>
        <?php
            $query_admin = "SELECT codigo_adm, nome, telefone, cpf, estado, cidade, email, senha
                            FROM admins
                            ORDER BY codigo_adm";
            $result_admin = mysqli_query($mysqli, $query_admin);

            if ($result_admin) {
                while ($coluna = mysqli_fetch_assoc($result_admin)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($coluna['codigo_adm']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['telefone']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['cpf']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['estado']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['cidade']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($coluna['senha']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Erro ao buscar dados</td></tr>";
            }
        ?>
    </table>
    <a href="../../cadastro_admin.php" class="home-link">Cadastrar Administrador</a>
</div>
</body>
</html>
