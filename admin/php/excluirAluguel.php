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
if (!$dados || !isset($dados['id_aluguel'])) {
    echo json_encode(["erro" => "ID do aluguel não informado"]);
    exit;
}

$id_aluguel = intval($dados['id_aluguel']);

$stmt = $conn->prepare("DELETE FROM aluguel WHERE id_aluguel = ?");
$stmt->bind_param("i", $id_aluguel);

if ($stmt->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$stmt->close();
$conn->close();
?>
