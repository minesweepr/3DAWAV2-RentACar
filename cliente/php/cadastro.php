<?php
session_start();
header('Content-Type: application/json');
include('conexao.php');

$nome=trim($_POST['nome'] ?? '');
$email=trim($_POST['email'] ?? '');
$senha=trim($_POST['senha'] ?? '');
$cpf=trim($_POST['cpf'] ?? '');
$telefone=trim($_POST['telefone'] ?? '');
$endereco=trim($_POST['endereco'] ?? '');

if ($nome === '' || $email === '' || $senha === '' || $cpf === '' || $telefone === '' || $endereco === ''){
    echo json_encode(['sucesso' => false, 'mensagem' => 'Preencha todos os campos.']);
    exit();
}

$sql="SELECT id_usuario FROM usuario WHERE email = ?";
$stmt=$conexao->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado=$stmt->get_result();

if($resultado->num_rows>0){
    echo json_encode(['sucesso' => false, 'mensagem' => 'Email já cadastrado.']);
    $stmt->close();
    $conexao->close();
    exit();
}
$stmt->close();

$sqlCpf="SELECT id_cliente FROM cliente WHERE cpf = ?";
$stmtCpf=$conexao->prepare($sqlCpf);
$stmtCpf->bind_param("s", $cpf);
$stmtCpf->execute();
$resultadoCpf = $stmtCpf->get_result();

if($resultadoCpf->num_rows>0){
    echo json_encode(['sucesso' => false, 'mensagem' => 'CPF já cadastrado.']);
    $stmtCpf->close();
    $conexao->close();
    exit();
}
$stmtCpf->close();

$conexao->begin_transaction();
$sqlUsuario="INSERT INTO usuario (email, senha) VALUES (?, ?)";
$stmtUsuario=$conexao->prepare($sqlUsuario);
$stmtUsuario->bind_param("ss", $email, $senha);

if($stmtUsuario->execute()){
    $idUsuario = $conexao->insert_id;

    $sqlCliente="INSERT INTO cliente (nome, cpf, telefone, endereco, id_usuario) VALUES (?, ?, ?, ?, ?)";
    $stmtCliente=$conexao->prepare($sqlCliente);
    $stmtCliente->bind_param("ssssi", $nome, $cpf, $telefone, $endereco, $idUsuario);

    if($stmtCliente->execute()){
        $conexao->commit();
        echo json_encode(['sucesso' => true, 'mensagem' => 'Cadastro realizado com sucesso!']);
    }else{
        $conexao->rollback();
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao cadastrar cliente.']);
    }
    $stmtCliente->close();
}else{
    $conexao->rollback();
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao cadastrar usuário.']);
}
$stmtUsuario->close();
$conexao->close();
?>