<?php
include('conexao.php');

if (!isset($_GET['id'])) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}
$id=intval($_GET['id']);

$sql="SELECT id_carro, modelo, tipo, preco, cor, cambio, capacidade, descricao, tanque, imagem FROM carro WHERE id_carro = ?";
$stmt=$conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado=$stmt->get_result();

if($resultado && $resultado->num_rows > 0) echo json_encode($resultado->fetch_assoc(), JSON_UNESCAPED_UNICODE);
else echo json_encode(["erro" => "Carro não encontrado"]);

$stmt->close();
$conexao->close();
?>