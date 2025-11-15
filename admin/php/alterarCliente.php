<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$database = "locarro";
$usuario = "root";
$senha = "";

$conn = new mysqli($servidor, $usuario, $senha, $database);
if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão com o banco de dados"]);
    exit;
}

$dados = json_decode(file_get_contents("php://input"), true);

if (!$dados || !isset($dados['id_cliente'])) {
    echo json_encode(["erro" => "ID do cliente não informado"]);
    exit;
}

$sql = $conn->prepare("
    UPDATE cliente SET
        nome = ?,
        cpf = ?,
        telefone = ?,
        endereco = ?
    WHERE id_cliente = ?
");

$sql->bind_param(
    "ssssi",
    $dados["nome"],
    $dados["cpf"],
    $dados["telefone"],
    $dados["endereco"],
    $dados["id_cliente"]
);

if ($sql->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$sql->close();
$conn->close();
?>
