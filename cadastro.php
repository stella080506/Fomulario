<?php
include "bancoPHP.php"; // Inclui um arquivo chamado bancoPHP.php, que deve conter o código para conectar ao banco de dados

// Verifica se a conexão foi bem-sucedida, Verifica se ocorreu um erro durante a conexão.
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);//Se houver um erro, o script é encerrado e uma mensagem de erro é exibida.
}
//Define uma consulta SQL para selecionar colunas específicas da tabela Cad_user.
$sql = "SELECT ID_User, nome, email, data_nascimento, genero, biografia FROM Cad_user";
//Executa a consulta SQL e armazena o resultado em $result.
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="index.css"> <!-- Corrigido para index.css -->
</head>
<body>
    <div class="results-container">
        <h1>Usuários Cadastrados</h1>
        <!--Verifica se existem resultados retornados pela consulta.-->
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                        <th>Gênero</th>
                        <th>Biografia</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Inicia um loop que irá percorrer cada linha do resultado, armazenando a linha atual em $row.-->
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <!--Exibe os dados da coluna específica, usando htmlspecialchars para evitar problemas de segurança, como XSS.-->
                            <td><?php echo htmlspecialchars($row['ID_User']); ?></td>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['data_nascimento']); ?></td>
                            <td><?php echo htmlspecialchars($row['genero']); ?></td>
                            <td><?php echo htmlspecialchars($row['biografia']); ?></td>
                        </tr>
                        <!--Finaliza o loop.-->
                         <?php endwhile; ?>
                </tbody>
            </table>
           
        <?php else: ?> <!--Se não houver resultados, exibe uma mensagem informando que não há usuários cadastrados.-->
            <p>Não há usuários cadastrados.</p> <!--Mensagem exibida -->

        <?php endif; ?> <!--Finaliza a estrutura condicional. -->

        <p><a href="index.php">Voltar ao formulário</a></p><!--Um link para voltar à página do formulário de cadastro.-->
    </div>

    <?php
    $conn->close(); //Fecha a conexão com o banco de dados.
    ?>
</body>
</html>
