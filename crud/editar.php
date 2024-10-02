<?php
 
$host = "127.0.0.1";
$usuario = "root";
$senha= "";
$db="webdb";
 
$conn = new mysqli($host, $usuario, $senha, $db);
 
if ($conn->connect_error)
{
    die("Falha na conexão: " . $conn->connect_error);
}
 
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "select nome, email from usuarios where id = ?"; // ? usado para pegar a informação através de uma função e assim evitar o sql injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); //Vincula o valor do parametro no id
    $stmt->execute(); //executa no banco de dados com o valor do id vinculado a consulta e edição
    $stmt->bind_result($nome, $email);
    $stmt->fetch(); //pega as informações da linha vinculada ao id
    $stmt->close(); //fecha minha conexão
 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nome = $_POST["nome"];
        $email = $_POST["email"];
       
        $sql = "update usuarios SET nome = ?, email = ? where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt = bind_param("ssi", $nome, $email, $id);
 
        if($stmt->execute()){
            header(location: 'listar.php');
        } else {
            echo "Erro ao atualizar usuário:" . $conn->error;
        }
        $smt->close();
    }
}else {
    echo "Usuário não informado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <br><h1>Edição de Usuários</h1><br>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($nome) ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>