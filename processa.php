<?php
include "bancoPHP.php"; //Inclui um arquivo chamado bancoPHP.php, que deve conter o código para conectar ao banco de dados.

// Função para validar se o nome contém ao menos dois nomes
function validarNome($nome) { //Define uma função que verifica se o nome contém pelo menos dois nomes.
    $nomes = explode(' ', trim($nome));//Usa trim() para remover espaços em branco e explode() para dividir a string em um array de nomes com base nos espaços.
    return count($nomes) >= 2;//Usa trim() para remover espaços em branco e explode() para dividir a string em um array de nomes com base nos espaços.
}

// Verifica se o formulário foi enviado usando o método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Captura os dados do formulário. trim() é usado para remover espaços em branco dos campos de texto.
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $data_nascimento = $_POST["data_nascimento"];
    $genero = $_POST["genero"];
    $biografia = trim($_POST["biografia"]);


    $erros = [];// Cria um array vazio para armazenar mensagens de erro.

    // Valida os campos
    //Verifica se o campo nome está vazio ou não contém pelo menos dois nomes. Se verdadeiro, adiciona uma mensagem de erro ao array $erros.
    if (empty($nome) || !validarNome($nome)) {
        $erros[] = "O nome deve conter pelo menos dois nomes.";
    }
//Verifica se o campo email está vazio ou não é um email válido. Se verdadeiro, adiciona uma mensagem de erro.
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "E-mail inválido.";
    }
//As três verificações seguintes fazem o mesmo: checam se os campos data_nascimento, genero e biografia estão vazios e adicionam mensagens de erro, se necessário.
    if (empty($data_nascimento)) {
        $erros[] = "A data de nascimento é obrigatória.";
    }

    if (empty($genero)) {
        $erros[] = "O gênero é obrigatório.";
    }

    if (empty($biografia)) {
        $erros[] = "A biografia é obrigatória.";
    }

    // Se houver erros, exibe-os
    if (!empty($erros)) {//Verifica se há mensagens de erro armazenadas.
        foreach ($erros as $erro) {// Itera sobre cada erro e exibe um alerta no navegador.
            echo "<script>alert('$erro');</script>";//Redireciona o usuário de volta para a página do formulário.
        }
        echo "<script>window.location.href = 'index.php';</script>";
    } else {// Se não houver erros, entra neste bloco.

        // Prepara e executa a inserção no banco de dados
        $stmt = $conn->prepare("INSERT INTO Cad_User (nome, email, data_nascimento, genero, biografia) VALUES (?, ?, ?, ?, ?)");//Prepara uma instrução SQL para inserir os dados no banco de dados.
        $stmt->bind_param("sssss", $nome, $email, $data_nascimento, $genero, $biografia);// Liga as variáveis aos parâmetros da consulta, onde "s" indica que todos são do tipo string.

        if ($stmt->execute()) {// Executa a consulta preparada. Se for bem-sucedida, exibe um alerta de sucesso; caso contrário, um alerta de erro.
            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
        } else {//Eculta o que if não conseguiu
            echo "<script>alert('Erro ao realizar o cadastro.');</script>";
        }

        $stmt->close();//Fecha a declaração preparada.
        $conn->close();//Fecha a conexão com o banco de dados.
        
        //Redireciona o usuário de volta à página do formulário após o cadastro.
        echo "<script>window.location.href = 'index.php';</script>";
    }
}
?>
