<?php
include('conexao.php');
session_start();

if (!isset($_SESSION['id_usuario'])){
  echo json_encode(['sucesso' => false, 'mensagem'=>'Usuário não logado']);
  exit;
}
$id_usuario=$_SESSION['id_usuario'];
$id_carro=$_POST['id_carro'];
$data_inicio=$_POST['data_inicio'];
$data_fim=$_POST['data_fim'];
$lugar=$_POST['lugar'];
$valor_pago=$_POST['valor_pago'];

$sql="INSERT INTO aluguel (id_usuario, id_carro, data_inicio, data_fim, lugar, valor_pago) VALUES (?, ?, ?, ?, ?, ?)";
$stmt=$conexao->prepare($sql);
$stmt->bind_param("iisssd", $id_usuario, $id_carro, $data_inicio, $data_fim, $lugar, $valor_pago);

if ($stmt->execute()) echo json_encode(['sucesso' => true, 'mensagem' => 'Aluguel registrado com sucesso!']);
else echo json_encode(['sucesso' => false, 'mensagem' => 'Erro.']);
?>