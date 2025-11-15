<?php
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$database = "locarro";
$usuario = "root";
$senha = "";

// Conexão
$conn = new mysqli($servidor, $usuario, $senha, $database);
if ($conn->connect_error) {
    echo json_encode(["erro" => "Falha na conexão com o banco de dados"]);
    exit;
}

if (isset($_GET['id'])) {
     $id = intval($_GET['id']);

    $sql = $conn->prepare("
        SELECT 
            c.id_cliente,
            c.nome,
            c.cpf,
            c.telefone,
            c.endereco
        FROM cliente c
        WHERE c.id_cliente = ?
    ");

    $sql->bind_param("i", $id);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado && $resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
        echo json_encode($cliente, JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(["erro" => "cliente não encontrado"]);
    }
} else {
    $filtro = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

    $sql = "
    SELECT 
        c.id_cliente,
        c.nome,
        c.cpf,
        c.telefone,
        u.email,
        COUNT(a.id_aluguel) AS alugueis
    FROM cliente c
    JOIN usuario u ON c.id_usuario = u.id_usuario
    LEFT JOIN aluguel a ON a.id_usuario = u.id_usuario
    ";

    if ($filtro) {
        $sql .= " WHERE c.nome LIKE '%$filtro%' OR c.cpf LIKE '%$filtro%'";
    }

    $sql .= "
    GROUP BY c.id_cliente, c.nome, c.cpf, c.telefone, u.email
    ORDER BY alugueis DESC;
    ";

    $resultado = $conn->query($sql);

    $clientes = [];
    if ($resultado) {
        while ($row = $resultado->fetch_assoc()) {
            $clientes[] = $row;
        }
    }

    echo json_encode($clientes, JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
