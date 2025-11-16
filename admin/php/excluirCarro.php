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

$dados = json_decode(file_get_contents("php://input"), true);
if (!$dados || !isset($dados['id_carro'])) {
    echo json_encode(["erro" => "ID do carro não informado"]);
    exit;
}

$id = intval($dados['id_carro']);

try {
    $sql = $conn->prepare("DELETE FROM carro WHERE id_carro = ?");
    $sql->bind_param("i", $id);
    $sql->execute();

    if ($sql->affected_rows > 0) {
        echo json_encode(["sucesso" => true]);
    } else {
        echo json_encode(["erro" => "Carro não encontrado"]);
    }

} catch (mysqli_sql_exception $e) {
    if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
        echo json_encode(["erro" => "Não é possível excluir o carro, existem alugueis relacionados."]);
    } else {
        echo json_encode(["erro" => $e->getMessage()]);
    }
}

$conn->close();
exit;
?>
