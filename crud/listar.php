<?php

$host = "127.0.0.1";
$usuario = "root";
$senha = "";
$webdb = "webdb";

// Conexão com o banco de dados
$conn = new mysqli($host, $usuario, $senha, $webdb);

// Verificação da conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para selecionar todos os usuários
$sql = "SELECT id, nome, email, data_criacao FROM usuarios";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-4">
        <h1>Lista de Usuários</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de Cadastro</th>
                    <th scope="col">Ação</th>
                    <th scope='col'>Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($result->num_rows > 0)
                {
                    while($row =$result->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["data_criacao"] . "</td>";
                        // Botão de editar com o ID do usuário enviado como parametro
                        echo "<td><a href='editar.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Editar</a></td>";
                        echo "<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!--Incluir o botão Cadastrar -->
        <a href="index.php" class="btn btn-primary">Cadastrar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
