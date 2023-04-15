<?php

session_start(); // Iniciar a sessão

// Limpara o buffer de redirecionamento
ob_start();

// Inclusão da conexão com o BD
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
 
  $nome = recuperarNomeToken();
  $id = recuperarIdToken();

  // Receber os dados do formulario
  $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(isset($_FILES['arquivo'])) {
  if(!empty($dados['ok'])){
    $arquivo = $_FILES['arquivo'];

    // Limitando o tamanho do arquivo
    if($arquivo['size'] > 2097152)
        die("Arquivo muito grande! Max: 2MB");
    $pasta = "arquivos/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
    // Salvando no BD
    if($deu_certo){
      $query_img = "INSERT INTO notas 
                  (campo_nota, usuario_id, nome, path, extensao) VALUES
                  (:campo_nota, :usuario_id, :nome, :path, :extensao)";
      $cad_img = $conn->prepare($query_img);
      $cad_img->bindParam(':campo_nota', $nomeDoArquivo);
      $cad_img->bindParam(':usuario_id', $id);
      $cad_img->bindParam(':nome', $nomeDoArquivo);
      $cad_img->bindParam(':path', $path);
      $cad_img->bindParam(':extensao', $extensao);
      $cad_img->execute();

    } else{$query_usuario = "INSERT INTO notas 
      (campo_nota, usuario_id) VALUES
      (:campo_nota, :usuario_id)";
$cad_nota = $conn->prepare($query_usuario);
$cad_nota->bindParam(':campo_nota', $dados['note-content']);
$cad_nota->bindParam(':usuario_id', $id);
$cad_nota->execute();}
  }else{
    
 }
      
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- CSS local -->
  <link rel="stylesheet" href="./css/styles.css" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
  <!-- Google Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e1f53efbff.js" crossorigin="anonymous"></script>
  <title>ARE</title>  
</head>
<style>
  body {
    background-color: #23355F;
  }

  header {
    padding: 1rem 2rem;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-around;
  }
  .topo{
    border:none;
  }

  #search-container {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  #input-busca {
    background-color: white;
    border-radius: 5px;
    border: none;
    padding: 10px;
    font-weight: bold;
    color: black;
    width: 400px;
    outline-offset: -3px;
  }

  #input-busca::placeholder {
    color: black;
  }


  .export-notes,
  #export-notes {
    border: none;
    background-color: #2E3E68;
    border-radius: 4px;
    color: #fff;
    padding: 5px 15px;
    cursor: pointer;
    transform: 0.4s;
  }

  .export-notes:hover {
    background-color: #fff;
    color: #333;
  }

  /* Formulário de nova nota */

  #add-note-container {
    display: flex;
    width: 400px;
    margin: 1rem auto 0;
    gap: 1rem;
  }

  #add-note-container input,
  #add-note-container button {
    padding: 10px;
    border-radius: 5px;
  }

  #add-note-container input {
    flex: 1;
    background-color: transparent;
    border: 1px solid #525356;
    color: #fff;
  }

  #add-note-container button {
    cursor: pointer;
    background-color: #333;
    color: #fff;
  }

  #add-note-container button:hover {
    background-color: #fff;
    color: #333;
  }

  /* Notas */

  #notes-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, 250px);
    padding: 2rem;
    gap: 2rem;
  }

  .note {
    min-height: 200px;
    padding: 1rem;
    border: 1px solid #ccc;
    background-color: #202124;
    border-radius: 10px;
    color: #fff;
    position: relative;
  }

  .note:focus-within {
    border-color: #FBBC04;
    box-shadow: 0px 0px 8px #FBBC04;
    transition: 0.2s;
  }

  .note textarea {
    background-color: transparent;
    resize: none;
    color: #fff;
    border: none;
    height: 100%;
    outline: none;
  }

  .note .bi-pin {
    position: absolute;
    left: 10px;
    bottom: 10px;
    font-size: 1.2rem;
    background-color: #333;
    cursor: pointer;
    padding: 5px 8px;
    border-radius: 3px;
  }

  .note:hover i {
    opacity: 1;
  }

  .note .bi-x-lg,
  .note .bi-file-earmark-plus {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 0.9rem;
    padding: 5px;
    transition: 0.3s;
    color: #555;
    cursor: pointer;
    opacity: 0;
  }

  .note .bi-file-earmark-plus {
    top: 40px;
  }

  .note .bi-x-lg:hover,
  .note .bi-file-earmark-plus:hover {
    color: #fff;
  }

  .note.fixed {
    background-color: #1d1b15;
    border-color: #503c02;
  }

  .return {
    text-decoration: none;
  }
   .form{
    /* background-color: yellow; */
    display: flex;
    flex-direction: row;  
    justify-content: center;
    align-items: center;
  } 
  .form form{
    /* background-color: white; */
    /* border: 1px solid blue; */
    padding: 10px 10px 10px 10px;
    flex-direction: row;
  }
  .note_content{
    border-radius: 5px;
    width: 200px;
    height: 50px;
  }
  .enviar{    
    margin-top: 10px;
    margin-left: 10px;
    width: 100px;
    height: 25px;
  }
  .table-div{
    display: flex;
    flex-direction: column;
  }
  .table{
    background-color: white;
    text-align: center;
  }
  .th{
    background-color: #85A4F5;
  } 
  .formulario{
    display: flex;
    flex-direction: row;  
    justify-content: center;
    align-items: center;
    border: 2px solid #FFFFFF;
    border-radius: 3px;
    margin-top: 50px;
    margin-bottom: 50px;
  }
</style>

<body>
  <header class="topo">
    <h1>NOTAS</h1>
    <div id="search-container">
      <i class="bi bi-search"></i>
      <input type="text" id="input-busca" name="search-input" placeholder="Busque por uma nota" />
    </div>
    <a class="export-notes return" href="../menu/index.php">Voltar</a>
  </header>
  <div class="form">
    <form  class="formulario" method="POST" enctype="multipart/form-data">  
      <input class="note_content" type="text" id="note-content" name="note-content" placeholder="Sua nota" />
      <p><label for="">Anexar:</label>
      <input name="arquivo" type="file"></p>
      <input class="enviar" type="submit" name="ok" value="ok" id="ok">
    </form>
  </div>
    <div class="table-div">
      <table class="table">
            <thead>
                <tr>
                    <th class="th" scope="col">Nota</th>
                    <th class="th" scope="col">Menu</th>
                </tr>
            </thead>
            <tbody id="tabela-notas">
                <?php
                $selecionaLogado = "SELECT * FROM notas WHERE $id = usuario_id";
                try{
                  $result = $conn->prepare($selecionaLogado);
                  $result->execute();
                  $contar = $result->rowCount();

                  if($contar =1){
                    $loop = $result->fetchAll();
                    foreach ($loop as $show){
                      $nota_salva = $show['campo_nota'];
                    }
                  }
                }catch (PDOWException $erro){ echo $erro;}

                // Seleciona os registros
                $resultado_msg_cont = $conn->prepare($selecionaLogado);
                $resultado_msg_cont->execute();

                while($row_msg_count = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)) {                  
                          echo "<tr>";
                          
                          if($row_msg_count['nome'] && ($row_msg_count['extensao']=='jpg' || $row_msg_count['extensao']=='png')){
                            ?>
                            <td><img height="50" src="<?php echo $row_msg_count['path']; ?>" alt=""></td>
                            <!-- <td><audio src="<?php echo $row_msg_count['path']; ?>"></audio></td> -->
                            <?php 
                          }else if($row_msg_count['nome'] && ($row_msg_count['extensao']=='mp3' || $row_msg_count['extensao']=='wav')){
                            ?>
                            <!-- <td><img height="50" src="<?php echo $row_msg_count['path']; ?>" alt=""></td> -->
                            <td><audio src="<?php echo $row_msg_count['path']; ?>" controls></audio></td>
                            <?php                         
                          }else{
                            echo "<td>".$row_msg_count['campo_nota']."</td>";
                          }
                          
                          echo "<td>
                            <a href='edit_nota.php?id=$row_msg_count[id_nota]' title='Editar'><span class='material-icons'>mode_edit</span></a>
                            <a href='delete_nota.php?id=$row_msg_count[id_nota]' title='Apagar'><span class='material-icons'>delete_forever</span></a>
                          </td>";
                          echo "</tr>";
                    
                     }                         
                                                                    
                ?>
                <script src="teste.js"></script>
            </tbody>
        </table>  
     </div>
</body>
</html>