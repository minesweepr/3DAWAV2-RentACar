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

$sql = "
SELECT
    a.id_aluguel AS id,
    c.nome AS nome,
    CONCAT(DATE_FORMAT(a.data_inicio, '%d/%m/%Y'), ' até ', DATE_FORMAT(a.data_fim, '%d/%m/%Y')) AS periodo,
    car.modelo AS carro,
    CONCAT('R$ ', FORMAT(a.valor_pago, 2, 'pt_BR')) AS valor_pago
FROM aluguel a
JOIN carro car ON a.id_carro = car.id_carro
JOIN usuario u ON a.id_usuario = u.id_usuario
JOIN cliente c ON u.id_usuario = c.id_usuario
ORDER BY a.data_inicio DESC;
";

$resultado = $conn->query($sql);

$reservas = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $reservas[] = $row;
    }
}
echo json_encode($reservas, JSON_UNESCAPED_UNICODE);

$conn->close();
?>