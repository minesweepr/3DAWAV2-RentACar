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
if (!$dados) {
    echo json_encode(["erro" => "Nenhum dado enviado"]);
    exit;
}

$stmtUser = $conn->prepare("SELECT id_usuario FROM usuario WHERE id_usuario = ?");
$stmtUser->bind_param("i", $dados["id_usuario"]);
$stmtUser->execute();
if ($stmtUser->get_result()->num_rows === 0) {
    echo json_encode(["erro" => "Usuário não existe"]);
    exit;
}

$stmtCar = $conn->prepare("SELECT id_carro FROM carro WHERE id_carro = ?");
$stmtCar->bind_param("i", $dados["id_carro"]);
$stmtCar->execute();
if ($stmtCar->get_result()->num_rows === 0) {
    echo json_encode(["erro" => "Carro não existe"]);
    exit;
}

$sql = $conn->prepare("
    INSERT INTO aluguel
    (id_usuario, id_carro, data_inicio, data_fim, horario_inicio, horario_fim, lugar, valor_pago)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$sql->bind_param(
    "iisssssd",
    $dados["id_usuario"],
    $dados["id_carro"],
    $dados["data_inicio"],
    $dados["data_fim"],
    $dados["horario_inicio"],
    $dados["horario_fim"],
    $dados["lugar"],
    $dados["valor_pago"]
);

if ($sql->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$conn->close();
?>
