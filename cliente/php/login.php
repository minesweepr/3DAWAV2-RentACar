<?php 
session_start();
header('Content-Type: application/json');
include('conexao.php');

$email=isset($_POST['email']) ? trim($_POST['email']) : '';
$senha=isset($_POST['senha']) ? trim($_POST['senha']) : '';
if($email==='' || $senha===''){
    echo json_encode(['sucesso' => false, 'mensagem' => 'Preencha todos os campos.']);
    exit();
}

if($email==='adm@adm' && $senha==='4DM'){
    $_SESSION['usuario_logado']=['id_usuario'=>-1, 'email'=>$email];
    echo json_encode(['sucesso' => true, 'mensagem' => 'Bem-vindo, administrador!', 'redirect' => '../admin/index.html']);
    exit();
}

$stmt=$conexao->prepare('SELECT id_usuario, email, senha FROM usuario WHERE email = ?');
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado=$stmt->get_result();

if($resultado->num_rows===0){
    echo json_encode(['sucesso' => false, 'mensagem' => 'Email não cadastrado.']);
    $stmt->close();
    $conexao->close();
    exit();
}
$usuario=$resultado->fetch_assoc();

if($senha===$usuario['senha']){
    $_SESSION['usuario_logado']=['id_usuario'=>$usuario['id_usuario'], 'email'=>$usuario['email']];
    echo json_encode(['sucesso' => true, 'mensagem' => 'Login realizado com sucesso!']);
} else echo json_encode(['sucesso' => false, 'mensagem' => 'Senha incorreta.']);
$_SESSION['id_usuario'] = $usuario['id_usuario'];
$stmt->close();
$conexao->close();
?>