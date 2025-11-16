<?php
include('conexao.php');

header('Content-Type: application/json; charset=utf-8');

$dados = json_decode(file_get_contents("php://input"), true);
error_log("PHP RECEBEU: " . print_r($dados, true));

if (!$dados) {
    $sql = "SELECT id_carro, modelo, tipo, preco, cor, tanque, cambio, capacidade, descricao, imagem 
            FROM carro 
            ORDER BY id_carro ASC";

    $resultado = $conexao->query($sql);

    $carros = [];
    while ($row = $resultado->fetch_assoc()) {
        $carros[] = $row;
    }

    echo json_encode($carros, JSON_UNESCAPED_UNICODE);
    exit;
}

$data_inicio = $dados["data_inicio"] ?? null;
$data_fim    = $dados["data_fim"] ?? null;
$horario_inicio = $dados["horario_inicio"] ?? null;
$horario_fim    = $dados["horario_fim"] ?? null;
$cidade      = $dados["cidade_retirada"] ?? null;

$horario_inicio .= ":00"; 
$horario_fim    .= ":00";

$sql = "
  SELECT 
      c.id_carro, c.modelo, c.tipo, c.preco, c.cor, c.tanque, c.cambio, c.capacidade, c.descricao, c.imagem
  FROM carro c
  WHERE NOT EXISTS (
      SELECT 1
      FROM aluguel a
      WHERE a.id_carro = c.id_carro
        AND a.lugar = ?
        AND NOT (
              a.data_fim < ? 
              OR (a.data_fim = ? AND a.horario_fim <= ?)
              OR a.data_inicio > ?
              OR (a.data_inicio = ? AND a.horario_inicio >= ?)
        )
  )
  ORDER BY c.id_carro ASC
";

$stmt = $conexao->prepare($sql);
$stmt->bind_param(
    "sssssss",
    $cidade,
    $data_inicio,
    $data_inicio,
    $horario_inicio,
    $data_fim,
    $data_fim,
    $horario_fim
);


$stmt->execute();
$resultado = $stmt->get_result();

$carros = [];
while ($row = $resultado->fetch_assoc()) {
    $carros[] = $row;
}

echo json_encode($carros, JSON_UNESCAPED_UNICODE);
?>
