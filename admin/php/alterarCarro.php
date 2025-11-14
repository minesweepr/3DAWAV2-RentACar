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

if (!$dados || !isset($dados['id_carro'])) {
    echo json_encode(["erro" => "ID do carro não informado"]);
    exit;
}

$sql = $conn->prepare("
    UPDATE carro SET 
        modelo = ?, 
        imagem = ?, 
        tipo = ?, 
        cambio = ?, 
        preco = ?, 
        cor = ?, 
        placa = ?, 
        capacidade = ?, 
        tanque = ?, 
        ano = ?, 
        descricao = ?
    WHERE id_carro = ?
");

$sql->bind_param(
    "ssssissiiisi",
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
    $dados["descricao"],
    $dados["id_carro"]
);

if ($sql->execute()) {
    echo json_encode(["sucesso" => true]);
} else {
    echo json_encode(["erro" => $conn->error]);
}

$conn->close();
?>
