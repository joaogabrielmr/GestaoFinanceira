<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Funcionario</title>

    <?php include('config.php'); ?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/style/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/style/styles_header.css">

    <script>
        function openNewTab() {
            window.open('http://localhost/financeiro/dashboard/html/funcionarios.html', '_blank'); // substitua 'funcionarios.html' pelo caminho da sua nova aba
        }
    </script>
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
    <form action="cadastro_funcionario.php" method="post" name="funcionarios" onsubmit="openNewTab(); return true;">
        <h2>Cadastro de Funcionarios</h2>
        <table>
            <tr>
                <td>Código:</td>
                <td><input type="number" name="codigo_funcionario" required></td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><input type="text" name="nome" required></td>
            </tr>
            <tr>
                <td>CPF:</td>
                <td><input type="number" name="cpf" required></td>
            </tr>
            <tr>
                <td>RG:</td>
                <td><input type="number" name="rg" required></td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><input type="text" name="estado" required></td>
            </tr>
            <tr>
                <td>Cidade:</td>
                <td><input type="text" name="cidade" required></td>
            </tr>
            <tr>
                <td>Data de Nascimento:</td>
                <td><input type="date" name="data_nascimento" required></td>
            </tr>
            <tr>
                <td>Estado Civil:</td>
                <td><input type="text" name="estado_civil" required></td>
            </tr>
            <tr>
                <td>Cargo:</td>
                <td><input type="text" name="cargo" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Gravar" name="botao"></td>
            </tr>
        </table>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $codigo_funcionario = $_POST['codigo_funcionario'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $data_nascimento = $_POST['data_nascimento'];
        $estado_civil = $_POST['estado_civil'];
        $cargo = $_POST['cargo'];

        $insere = "INSERT INTO funcionarios (codigo_funcionario, nome, cpf, rg, estado, cidade, data_nascimento, estado_civil, cargo) 
        VALUES ('$codigo_funcionario', '$nome', '$cpf', '$rg', '$estado', '$cidade', '$data_nascimento', '$estado_civil', '$cargo')";
        if (mysqli_query($mysqli, $insere)) {
            echo "<script>window.open('http://localhost/financeiro/dashboard/html/funcionarios.html', '_blank');</script>";
        } else {
            echo "Não foi possível inserir os dados: " . mysqli_error($mysqli);
        }
    }
    ?>
</body>

</html>
