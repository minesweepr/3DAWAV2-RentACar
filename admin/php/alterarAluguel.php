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

$sql = $conn->prepare("
    UPDATE aluguel SET
        id_usuario = ?,
        id_carro = ?,
        data_inicio = ?,
        data_fim = ?,
        horario_inicio = ?,
        horario_fim = ?,
        lugar = ?,
        valor_pago = ?
    WHERE id_aluguel = ?
");

$sql->bind_param(
    "iisssssdi",
    $dados["id_usuario"],
    $dados["id_carro"],
    $dados["data_inicio"],
    $dados["data_fim"],
    $dados["horario_inicio"],
    $dados["horario_fim"],
    $dados["lugar"],
    $dados["valor_pago"],
    $dados["id_aluguel"]
);

if ($sql->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$sql->close();
$conn->close();
?>
