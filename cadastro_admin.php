<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Administradores</title>

    <?php include('config.php'); ?>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <form action="cadastro_admin.php" method="post" name="admins">
        <h2>Cadastro de Administradores</h2>
        <table>
            <tr>
                <td>Código:</td>
                <td><input type="number" name="codigo_adm" required></td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><input type="text" name="nome" required></td>
            </tr>
            <tr>
                <td>Telefone:</td>
                <td><input type="number" name="telefone" required></td>
            </tr>
            <tr>
                <td>CPF:</td>
                <td><input type="number" name="cpf" required></td>
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
                <td>Email:</td>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <td>Senha:</td>
                <td><input type="password" name="senha" required></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Gravar" name="botao2"></td>
            </tr>
        </table>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && @$_POST['botao2'] == "Gravar") {
        $codigo_adm = $_POST['codigo_adm'];
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $insere = "INSERT INTO admins (codigo_adm, nome, telefone, cpf, estado, cidade, email, senha) 
        VALUES ('$codigo_adm', '$nome', '$telefone', '$cpf', '$estado', '$cidade', '$email', '$senha')";
        
        if (mysqli_query($mysqli, $insere)) {
            echo "<script>window.open('http://localhost/financeiro/dashboard/html/adm.html', '_blank');</script>";
        } else {
            echo "Não foi possível inserir os dados: " . mysqli_error($mysqli);
        }
    }
    ?>
</body>

</html>
