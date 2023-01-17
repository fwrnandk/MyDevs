<?php
    include 'config.php';
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $email_log = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Devs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <link rel="stylesheet" href="css/stylenav2.css">
  <link rel="icon" type="image/x-icon" href="img/icon.png">
    <script src="js/script.js" defer></script>

</head>
<body>

<dialog id="modalpost">
  
    <div class="modal-header">
              <h2> Faça seu post</h2>
              <button id="close-modal">Fechar</button>
          </div>
  
          <div class="modal-body">
              <form action="" method="POST" enctype="multipart/form-data">
                  <label for="titulo">Titulo:</label>
                  <br>
                  <input type="text" id="titulo" name="titulo" style="color: white;">
                  <br><br>
                  <label for="conteudo">Conteudo:</label>
                  <br>
                  <input type="textarea" name="conteudo" id="conteudo" rows="20" cols="20" style="color: white;">
                  <br><br>
                  <label for="img"><i class="fa-solid fa-image"></i></label>
                  <br>
                  <input type="file" name="img" id="img">
                  <br><br>
                  <input type="submit" name="enviar" value="Postar">
              </form>
          </div>
          <?php
        if(isset($_POST['enviar'])) {
            $sql_user = "SELECT id_user FROM usuarios WHERE email='$email_log'";
            $con = mysqli_query($conexao, $sql_user);
    
            while ($dados_user = $con->fetch_array()) {
                extract($dados_user);
    
                $titulo = $_POST['titulo'];
                $descricao = $_POST['conteudo'];
    
                date_default_timezone_set('America/Sao_Paulo');
                $data = date("d/m/Y");
                $hora = date("H:i");
    
                if(empty($titulo)){
                    echo "É obrigatório ter um titulo.";
                }else {
                    $extensao = strtolower(substr($_FILES['img']['name'], -4));
                    $novo_nome= md5(time()) . $extensao;
                    $diretorio= "img/posts_imagens/";
                    move_uploaded_file($_FILES['img']['tmp_name'], $diretorio.$novo_nome);
    
                    $sql = "INSERT INTO posts (id_user_posts, titulo, descricao, imagem, data, hora) VALUES ('$id_user', '$titulo', '$descricao', '$novo_nome', '$data', '$hora')";
    
                    if(mysqli_query($conexao, $sql)) {
                        echo "Publicação inserida com sucesso!<br>";
                        header('Location: home.php');
                    }else {
                        echo "Erro ao inserir a publicação!";
                    }
                }
            }
        }
    ?>
  
  </dialog>



  


    
<div id="container">

    <div class="esq">

        <div class="menu">
            <div class="logo"><img src="img/logo.png" alt="logo"> <img src="img/nomesite.png" alt=""></div>
            <ul class="menu1">
                <a href="perfil.php"><li><i class="fa-regular fa-user"></i></i>Meu perfil</li></a>
                <a href="#"><li><i class="fa-regular fa-folder-open"></i>Meus posts</li></a>
                <a href="#"><li><i class="fa-regular fa-handshake"></i>Favoritar</li></a>
            </ul>

            <button id="open-modal">Postar</button>

            <?php 
                $sql_dados_user = "SELECT * FROM usuarios WHERE email='$email_log'";
                $con_dados_user = mysqli_query($conexao, $sql_dados_user);
                while ($dados_user = $con_dados_user->fetch_array()) { 
                    extract($dados_user);    
            ?>
            <div class="dp-menu">
                <ul class="menupf">
                    <a href="#"><li><div class="img">
                    <?php 
                        if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                            echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                        }else {
                            echo "<img src='img/fts_perfil/icon_user.png'><br>";
                        }
                    }
                    ?>
                    </div> <div><p><?php echo $nome;?></p></div></a>
                        <ul class="submenu">
                            <li><a href="index.php">Sair<i class="fa-solid fa-right-from-bracket"></i></a></li>
                            <li><a href="login.php">Entrar com outra Conta <i class="fa-solid fa-user-plus"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>


        
    </div>

    <div class="meio">
        <a href="home.php" id="back-to-top"><i class="fa-solid fa-angle-up"></i> <p>Voltar ao topo</p></a>
        <?php
            if(!empty($_GET['search'])){
                $data = $_GET['search'];
                $sql_posts = "SELECT * FROM posts WHERE titulo LIKE '%$data%' or descricao LIKE '%$data%'";
            }else {
                $sql_posts = "SELECT * FROM posts ORDER BY id_posts DESC";
            }
            $con_sql_posts = mysqli_query($conexao, $sql_posts);
    
            $conta = mysqli_num_rows($con_sql_posts);
            if($conta <= 0) {
                echo "<div class='nada'>Nenhuma postagem encontrada!</diV>";
            }else{
                while($row = mysqli_fetch_array($con_sql_posts)) {
                    extract($row);
                    
                    $sql_postador = "SELECT nome, id_user, foto_usuario FROM usuarios WHERE id_user = '$id_user_posts'";
                    $con1 = mysqli_query($conexao, $sql_postador);
                    while ($dados_postador = $con1->fetch_array()) {
                        extract($dados_postador);
        ?>
        <div class="postagem">
            <div class="postinfos">
                <div class="img">
                    <?php
                        if($email == $email_log) {
                            echo "<a href='perfil.php'>";
                        } else {
                            echo "<a href='perfil_publico.php?id=$id_user_posts'>";
                        }
                        if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                            echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                        }else {
                            echo "<img src='img/fts_perfil/icon_user.png'><br>";
                        }
                    ?>
                </div><p class="nome"><?php echo $nome;?></a></p>
            </div>

            <div class="postarea">
                <center><p class="conteudo" style="color: #8C52FE;">
                    <?php echo $titulo;?>
                    </p></center>
                    <p class="conteudo">
                    <?php
                        echo $descricao;
                    ?>
                </p>  
                <?php
                    if((!empty($imagem)) and (file_exists("img/posts_imagens/$imagem"))) {
                        echo "<div class='img-container'><button id='open-modalimg'><img src='img/posts_imagens/$imagem'></button></div>";
                        echo "<!-- modal img-->

                        <dialog id='modalimg'>
                      
                          <img src='img/posts_imagens/$imagem' alt=''>
                        
                          <button id='close-modalimg'><i class='fa-solid fa-x'></i></button>
                        </dialog>";
                    }
                ?> 
                <p>Postado em: <?php echo $data . " às " . $hora;?></p>   
            </div>
            <div class="postinteracoes"><a href="comentar.php?id=<?php echo $id_posts;?>"><i class="fa-regular fa-comment"></i></a><a href="favoritar.php?id=<?php echo $id_posts;}?>"><i class="fa-regular fa-handshake"></i></a></div>

            <div class="postcoments">
                <?php
                    $sql_coments = "SELECT * FROM comentarios WHERE id_post_coment='$id_posts'";
                    $con_coments = mysqli_query($conexao, $sql_coments);
                    while($coments = $con_coments->fetch_array()) {
                        extract($coments);
        
                        $qm_comentou = "SELECT nome, foto_usuario, email, id_user FROM usuarios WHERE id_user='$id_user_post_coment'";
                        $con_qm_comentou = mysqli_query($conexao, $qm_comentou);
                        while($dados_qm_comentou = $con_qm_comentou->fetch_array()) {
                            extract($dados_qm_comentou);
                ?>
                <div class="comentario">
                    <div class="comentinfo">
                    <?php
                            if($email == $email_log) {
                                echo "<a href='perfil.php'>";
                            } else {
                                echo "<a href='perfil_publico.php?id=$id_user_posts'>";
                            }
                    ?>
                    <div class="img">
                        <?php
                            if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                                echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                            }else {
                                echo "<img src='img/fts_perfil/icon_user.png'><br>";
                            }
                        ?>
                    </div><p class="nome"><?php echo $nome;?></p></a></div>
                    <div class="comentconteudo"><p>
                       <?php
                            echo $comentario;
                       ?>
                    
                    </p></div>
                </div>
                <?php }}?>
            </div>
        </div>

        
    

        <?php }}?>


        

    </div>

    <div class="dir">
        <div class="pesquisa">
            <h2 style="color: #8C52FE;">Buscar Postagens:</h2>
            <label for="pesq"><i class="fa-solid fa-magnifying-glass"></i></i></label>
            <input type="search" name="pesq" id="pesquisar">
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2 style="color: #8C52FE;">Buscar Pessoas:</h2>
        <div class="pesquisa">
            <label for="pesq"><i class="fa-solid fa-magnifying-glass"></i></i></label>
            <input type="search" name="pesq2" id="pesquisar2">
        </div>


    </div>

</div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        var search = document.getElementById('pesquisar');
        search.addEventListener("keydown", function(event){
            if (event.key == "Enter"){
                searchData();
            }
        });
        function searchData(){
            window.location = 'home.php?search='+search.value;
        }

        $(document).on('submit','#postar',function(){
        $("input").val("");
        $("text").val("");
        });
        
        var search2 = document.getElementById('pesquisar2');
        search2.addEventListener("keydown", function(event){
            if (event.key == "Enter"){
                searchData();
            }
        });
        function searchData(){
            window.location = 'pessoas.php?search='+search2.value;
        }

        $(document).on('submit','#postar',function(){
        $("input").val("");
        $("text").val("");
        });
    </script>
</body>
</html>