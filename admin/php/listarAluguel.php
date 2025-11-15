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
    $sql = "
        SELECT 
            a.id_aluguel,
            a.id_usuario,
            a.id_carro,
            a.data_inicio,
            a.data_fim,
            a.horario_inicio,
            a.horario_fim,
            a.lugar,
            a.valor_pago
        FROM aluguel a
        WHERE a.id_aluguel = $id
    ";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $aluguel = $resultado->fetch_assoc();
        echo json_encode($aluguel, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "aluguel não encontrado"]);
    }
} else {
    $filtro = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

    $sql = "
        SELECT 
            a.id_aluguel,
            c.nome,
            CONCAT(DATE_FORMAT(a.data_inicio, '%d/%m/%Y'), ' até ', DATE_FORMAT(a.data_fim, '%d/%m/%Y')) AS periodo,
            car.modelo AS carro,
            CONCAT('R$ ', FORMAT(a.valor_pago, 2, 'pt_BR')) AS valor_pago
        FROM aluguel a
        JOIN carro car ON a.id_carro = car.id_carro
        JOIN usuario u ON a.id_usuario = u.id_usuario
        JOIN cliente c ON u.id_usuario = c.id_usuario
    ";

    if ($filtro) {
        $sql .= " WHERE c.nome LIKE '%$filtro%' OR car.modelo LIKE '%$filtro%' OR CONCAT(DATE_FORMAT(a.data_inicio, '%d/%m/%Y'), ' até ', DATE_FORMAT(a.data_fim, '%d/%m/%Y')) LIKE '%$filtro%'";
    }

    $sql .= " ORDER BY a.data_inicio DESC;";

    $resultado = $conn->query($sql);

    $alugueis = [];
    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $alugueis[] = $row;
        }
    }

    echo json_encode($alugueis, JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
