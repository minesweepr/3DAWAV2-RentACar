<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
include('conexao.php');

$id_usuario=$_SESSION['id_usuario'];
$id_carro=$_GET['id'];

if (!$id_carro){
  echo json_encode(['erro' => 'Carro não informado']);
  exit;
}

$sqlUsuario="SELECT nome, cpf, telefone, endereco FROM cliente WHERE id_usuario = ?";
$stmt=$conexao->prepare($sqlUsuario);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultadoUsuario=$stmt->get_result();
$usuario=$resultadoUsuario->fetch_assoc();
$stmt->close();

$sqlCarro="SELECT id_carro, modelo, tipo, preco, cor, cambio, capacidade, descricao, imagem FROM carro WHERE id_carro = ?";
$stmt2=$conexao->prepare($sqlCarro);
$stmt2->bind_param("i", $id_carro);
$stmt2->execute();
$resultadoCarro=$stmt2->get_result();
$carro=$resultadoCarro->fetch_assoc();
$stmt2->close();

if (!$carro) {
  echo json_encode(['erro' => 'Carro não encontrado']);
  exit;
}
echo json_encode(['usuario' => $usuario ?? [], 'carro' => $carro], JSON_UNESCAPED_UNICODE);
$conexao->close();
?>