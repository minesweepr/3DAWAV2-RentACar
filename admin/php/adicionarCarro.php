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

$sql = $conn->prepare("
    INSERT INTO carro 
    (modelo, imagem, tipo, cambio, preco, cor, placa, capacidade, tanque, ano, descricao)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$sql->bind_param(
    "ssssissiiis",
    $dados["modelo"],
    $dados["imagem"],
    $dados["tipo"],
    $dados["cambio"],
    $dados["preco"],
    $dados["cor"],
    $dados["placa"],
    $dados["capacidade"],
    $dados["tanque"],
    $dados["ano"],
    $dados["descricao"]
);

if ($sql->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$conn->close();
?>
