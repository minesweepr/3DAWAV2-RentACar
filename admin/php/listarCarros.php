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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM carro WHERE id_carro = $id";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $carro = $resultado->fetch_assoc();
        echo json_encode($carro, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "carro não encontrado"]);
    }
} else {
    $sql = "
    SELECT 
        car.id_carro,
        car.modelo,
        car.tipo,
        car.imagem,
        car.cor,
        car.cambio,
        car.capacidade,
        car.preco
    FROM carro car
    ORDER BY car.modelo ASC;
    ";

    $resultado = $conn->query($sql);

    $carros = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $carros[] = $row;
        }
    }
    echo json_encode($carros, JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>