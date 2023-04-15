<?php
session_start();

// Limpara o buffer de redirecionamento
ob_start();

include '../../conexao.php';

// Incluir o arquivo para validar e recuperar dados do token
include_once '../../validar_token.php';

// Chamar a função validar o token, se a função retornar FALSE significa que o token é inválido e acessa o IF
if(!validarToken()){
    // Criar a mensagem de erro e atribuir para variável global
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário realizar o login para acessar a página!</p>";

    // Redireciona o o usuário para o arquivo index.php
    header("Location: index.php");

    // Pausar o processamento da página
    exit();
}
$id = recuperarIdToken();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));

$query_event = "INSERT INTO events (title, color, start, end, usuario_id) VALUES (:title, :color, :start, :end, :usuario_id)";

$insert_event = $conn->prepare($query_event);
$insert_event->bindParam(':title', $dados['title']);
$insert_event->bindParam(':color', $dados['color']);
$insert_event->bindParam(':start', $data_start_conv);
$insert_event->bindParam(':end', $data_end_conv);
$insert_event->bindParam(':usuario_id', $id);

if ($insert_event->execute()) {
    $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
} else {
    $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
}


header('Content-Type: application/json');
echo json_encode($retorna);
