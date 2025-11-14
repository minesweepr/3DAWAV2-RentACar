<?php
include('conexao.php');
$sql="SELECT id_carro, modelo, tipo, preco, cor, tanque, cambio, capacidade, descricao, imagem FROM carro ORDER BY id_carro ASC";
$resultado=$conexao->query($sql);

$carros=[];
while($row=$resultado->fetch_assoc()){
  $carros[]=$row;
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($carros, JSON_UNESCAPED_UNICODE);
?>