<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$database = "locarro";
$usuario = "root";
$senha = "";

$conn = new mysqli($servidor, $usuario, $senha, $database);
if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão com o banco de dados"], JSON_UNESCAPED_UNICODE);
    exit;
}

$data = $_POST['data'] ?? date("Y-m-d");
$ano = date("Y", strtotime($data));
$mes = date("m", strtotime($data));

$dados = [];

function pegarValor($conn, $sql, $campo, $padrao = 0) {
    $resultado = $conn->query($sql);
    if ($resultado && $row = $resultado->fetch_assoc()) {
        return $row[$campo] ?? $padrao;
    }
    return $padrao;
}

$sql = "
SELECT CONCAT('R$ ', FORMAT(COALESCE(SUM(valor_pago), 0), 2, 'pt_BR')) AS receita_mes
FROM aluguel
WHERE YEAR(data_inicio) = '$ano'
  AND MONTH(data_inicio) = '$mes';
";
$dados['receita_mes'] = pegarValor($conn, $sql, 'receita_mes', "R$ 0,00");

$hoje = date('Y-m-d');
$sql = "
SELECT COUNT(*) AS alugueis_ativos
FROM aluguel
WHERE data_fim >= '$hoje';
";
$dados['alugueis_ativos'] = pegarValor($conn, $sql, 'alugueis_ativos', 0);

$sql = "
SELECT COUNT(*) AS retiradas
FROM aluguel
WHERE DATE(data_inicio) = '$data';
";
$dados['retiradas'] = pegarValor($conn, $sql, 'retiradas', 0);

$sql = "
SELECT COUNT(*) AS devolucoes
FROM aluguel
WHERE DATE(data_fim) = '$data';
";
$dados['devolucoes'] = pegarValor($conn, $sql, 'devolucoes', 0);

echo json_encode($dados, JSON_UNESCAPED_UNICODE);

$conn->close();
