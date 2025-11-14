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
    c.nome AS nome,
    c.cpf AS cpf,
    c.telefone AS telefone,
    u.email AS email,
    COUNT(a.id_aluguel) AS alugueis
FROM cliente c
JOIN usuario u ON c.id_usuario = u.id_usuario
LEFT JOIN aluguel a ON a.id_usuario = u.id_usuario
GROUP BY c.id_cliente, c.nome, c.cpf, c.telefone, u.email
ORDER BY alugueis DESC;
";

$resultado = $conn->query($sql);

$clientes = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $clientes[] = $row;
    }
}
echo json_encode($clientes, JSON_UNESCAPED_UNICODE);

$conn->close();
?>