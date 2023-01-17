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
    <link rel="stylesheet" href="css/styleperfil.css">
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
                  <form action="" method="post" enctype="multipart/form-data">
                      <label for="titulo">Titulo:</label>
                      <br>
                      <input type="text" id="titulo" name="titulo">
                      <br><br>
                      <label for="conteudo">Conteudo:</label>
                      <br>
                      <input type="textarea" name="conteudo" id="conteudo" rows="20" cols="20">
                      <br><br>
                      <label for="img"><i class="fa-solid fa-image"></i></label>
                      <br>
                      <input type="file" name="img" id="img">
                      <br><br>
                      <input type="submit" name="enviar" value="Postar">
                  </form>
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
              </div> 
      
      </dialog>
    
        <!-- modal img-->
    
      <dialog id="modalimg">
    
        <img src="/img/mailon.jpg" alt="">
      
        <button id="close-modalimg"><i class="fa-solid fa-x"></i></button>
      </dialog>
    
      <!-- modal comentario-->
    
      <dialog id="modalcoment">
        <div class="modal-header">
          <h2> Faça seu post</h2>
          <button id="close-modalcoment">Fechar</button>
        </div>
    
        <div class="modal-body">
          <form action="">
            <label for="titulo">Titulo:</label>
            <br>
            <input type="text" id="titulo" name="titulo">
            <br><br>
            <label for="conteudo">Conteudo:</label>
            <br>
            <input type="textarea" name="conteudo" id="conteudo" rows="20" cols="20">
            <br><br>
            <input type="submit" value="Postar">
          </form>
        </div>
    
      </dialog>

      <dialog id="modaledit">

        <nav class="nav_tabs2">
            <ul>
                <li>
                    <input type="radio" id="tab3" class="rd_tab2" name="tabs2" checked>
                    <label for="tab3" class="tab_label2">Editar perfil</label>
                    <div class="tab-content">

                        <div id="logindiv">

                            <div class="login">
                                <form action="" method="post">
                                    <label for="nome"><i class="fa-solid fa-user"></i></label>
                                    <input type="text" placeholder="Nome" name="nome"  id="nome">
                                    <br>
                                    <label for="Telefone"><i class="fa-solid fa-phone"></i></label>
                                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone">
                                    <br>
                                    <label>Quem é você?</label>
                             
                                 
                                
                                    <br>
                            <input type="radio" id="Empresa" name="idnt" value="Empresa" required>
                            <label for="Empresa">Empresa</label><br>
                            <input type="radio" id="Cliente" name="idnt" value="Cliente" required>
                            <label for="Cliente">Cliente</label><br>
                            <input type="radio" id="Desenvolvedor" name="idnt" value="Desenvolvedor" required>
                            <label for="Desenvolvedor">Desenvolvedor</label><br><br>
                            <br>
                                  <br>
                
                           <center> <label for="biografia">Biografia</label></center>
                            <textarea name="descr" value="<?php echo $descr; ?>" required cols="150" rows="10" style="background: none;"></textarea><br><br><br><br>
                
                                    <div class="btn">
                                    <input type="submit" name="editar_dados" id="alterar" value="Alterar">
                                    </div>
                                </form>
                                <?php
                                if(isset($_POST['editar_dados'])) {
                                    $nome = $_POST['nome'];
                                    $telefone = $_POST['telefone'];
                                    $idnt = $_POST['idnt'];
                                    $descr = $_POST['descr'];
                            
                                    $sqlUp = "UPDATE usuarios SET nome = '$nome', telefone = '$telefone', data = NOW(), idnt = '$idnt', descr = '$descr' WHERE email = '$email_log'";
                                    $result = mysqli_query($conexao, $sqlUp);
                                        
                                    if ($result){
                                        echo "<p style='color: green;'>Dados Atualizados com Sucesso! Entre em seu <a href='perfil.php'>perfil.</a></p>";
                                        $nome = "";
                                        $username = "";
                                        $email = "";
                                        $telefone = "";
                                        $idnt = "";
                                        $$descr = "";
                                    } else {
                                        echo "<p style='color: red;'>Algo deu errado.</p>";
                                    }
                                }
                            
                            ?>
                            </div>
                
                        </div>
                        
                    </div>
                </li>
                <li>
                    <input type="radio" name="tabs2" class="rd_tab2" id="tab5">
                    <label for="tab5" class="tab_label2">Foto de perfil</label>
                    <div class="tab-content">
                      <center>   <form method="POST" action="" enctype="multipart/form-data">
                            <label for="Foto_usuario"><i class="fa-solid fa-camera"></i></label>
                            <input type="file" name="foto_usuario" id="foto_usuario" placeholder="Foto de perfil">
                            <br>
                            <div class="btn">
                            <input type="submit" name="editar_ft_perfil" value="Alterar">
                            </div>
                        </form>
                        <?php
                                if(isset($_POST['editar_ft_perfil'])) {
                                    $extensao = strtolower(substr($_FILES['foto_usuario']['name'], -4));
                                    $novo_nome= md5(time()) . $extensao;
                                    $diretorio= "img/fts_perfil/";
                                    move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $diretorio.$novo_nome);

                                    $sql = "SELECT * FROM usuarios WHERE email='$email_log'";
                                    $cone = mysqli_query($conexao, $sql);
                                    while($pegar_id = $cone->fetch_array()) {
                                        extract($pegar_id);
                                        $sqlUp = "UPDATE usuarios SET foto_usuario='$novo_nome' WHERE id_user='$id_user'";
                                        $result = mysqli_query($conexao, $sqlUp);
                                        echo "<p style='color: green;'>Foto Atualizada com Sucesso! Entre em seu <a href='perfil.php'>perfil.</a></p>";
                                        header('Location: perfil.php'); 
                                    }
                                }
                            ?>
                    </center>
                    </div>

                </li>

                <li>
                    <input type="radio" name="tabs2" class="rd_tab2" id="tab6">
                    <label for="tab6" class="tab_label2">Senha</label>
                    <div class="tab-content">
                       <center> <form action="" method="post">
                            <label for="senha"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="senha_nv" id="senha" placeholder="Senha">
                            <br>
                            <label for="Confirme a senha"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="asenha_nv" id="asenha" placeholder="Confirme a senha">
                            <br>
                            <div class="btn">
                                <input  id="alterar" type="submit" name="editar_senha" value="Alterar">
                            </div></form></center>
                            <?php
                                if(isset($_POST['editar_senha'])) {
                                    $senha_nv = md5($_POST['senha_nv']);
                                    $asenha_nv = md5($_POST['asenha_nv']);

                                    if ($senha_nv == $asenha_nv) {
                                        $sql = "SELECT * FROM usuarios WHERE email='$email_log'";
                                        $cone = mysqli_query($conexao, $sql);
                                        while($pegar_id = $cone->fetch_array()) {
                                            extract($pegar_id);
                                            $sqlUp = "UPDATE usuarios SET senha='$senha_nv' WHERE id_user='$id_user'";
                                            $result = mysqli_query($conexao, $sqlUp);
                                            if ($result){
                                                echo "<p style='color: green;'>Senha Atualizada com Sucesso! <a href='login.php'>Faça o login novamente.</a></p>";
                                            } else {
                                                echo "<p style='color: red;'>Algo deu errado.</p>";
                                            } 
                                        }
                                    } else {
                                        echo "<p style='color: red;'>Senhas Diferentes.</p>";
                                    }
                                }
                            ?>
                    </div>

                </li>
            </ul>
        </nav>

          <button id="close-modaledit"><i class="fa-solid fa-x"></i></button>
    
    
      </dialog>
    
    


<div id="container">


    <div class="esq">

        <div class="menu">
            <div class="logo"><img src="img/logo.png" alt="logo"> <img src="img/nomesite.png" alt=""></div>
            <ul class="menu1">
                <a href="home.php"><li><i class="fa-solid fa-house"></i>Pagina Incial</li></a>
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
                    <a href="#"><li>
                        <div class="img">
                            <?php
                                if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                                    echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                                }else {
                                    echo "<img src='img/fts_perfil/icon_user.png'><br>";
                                }
                            ?>
                        </div> 
                        <div>
                        <p><?php echo $nome;?></p></div> </a>
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
        <a href="perfil.php" id="back-to-top"><i class="fa-solid fa-angle-up"></i> <p>Voltar ao topo</p></a>

        <div class="perfil">
            <div class="info">
                
                <div class="img">
                <?php
                    if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                        echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                    }else {
                        echo "<img src='img/fts_perfil/icon_user.png'><br>";
                    }
                ?>
                
                </div> <p class="nome"> <?php echo $nome;?></p>  <a href="editar.php"><i class="fa-solid fa-user-pen"></i></a>

            </div>

            <div class="datas">
                <p><i class="fa-solid fa-cake-candles"></i>Nascido(a ou e) em <?php echo $data_nasc;?></p>
                <p><i class="fa-regular fa-calendar"></i>Entrou em <?php echo $data;?></p>
            </div>

            <div class="perfildesc">
                <p><?php echo $descr;?></p>
            </div>

        </div>

        <nav class="nav_tabs">
            <ul>
                <li>
                    <input type="radio" id="tab1" class="rd_tab" name="tabs" checked>
                    <label for="tab1" class="tab_label">Postagens</label>
                    <div class="tab-content">
                    <?php
            if(!empty($_GET['search'])){
                $data = $_GET['search'];
                $sql_posts = "SELECT * FROM posts WHERE titulo LIKE '%$data%' or descricao LIKE '%$data%'";
            }else {
                $sql_posts = "SELECT * FROM posts WHERE id_user_posts='$id_user' ORDER BY id_posts DESC";
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
                <div class="img"><a href="">
                    <?php
                        if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                            echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                        }else {
                            echo "<img src='img/fts_perfil/icon_user.png'><br>";
                        }
                    ?>
                </div><p class="nome"><?php echo $nome;?></a></p>
                <a href="del_post.php?id=<?php echo $id_posts;?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="position: absolute; left: 95%; margin-top: 1%;">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg></a>
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
                        echo "<img src='img/posts_imagens/$imagem'>";
                    }
                ?> 
                <p>Postado em: <?php echo $data . " às " . $hora;?></p>   
            </div>
            <div class="postinteracoes"><a href="comentar.php?id=<?php echo $id_posts;?>"><i class="fa-regular fa-comment"></i></a><a href="favoritar.php?id=<?php echo $id_posts;?>"><i class="fa-regular fa-handshake"></i></a></div>

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

        
    

        <?php }}}?>


                    </div>
                </li>
                <li>
                    <input type="radio" name="tabs" class="rd_tab" id="tab2">
                    <label for="tab2" class="tab_label">Favoritos</label>
                    <div class="tab-content">

                        <?php
                         
                         $sql_salvos = "SELECT id_post_fav FROM favoritos WHERE id_user_fav='$id_user' ORDER BY id_fav DESC";
                        $con1 = mysqli_query($conexao, $sql_salvos);
                        
                        while($salvos = mysqli_fetch_array($con1)) {
                            extract($salvos);
                        
                            $sql_post = "SELECT * FROM posts WHERE id_posts='$id_post_fav' ORDER BY id_posts DESC";
                            $con2 = mysqli_query($conexao, $sql_post);
                            $conta = mysqli_num_rows($con2);
                    

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
                <div class="img"><a href="">
                    <?php
                        if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                            echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                        }else {
                            echo "<img src='img/fts_perfil/icon_user.png'><br>";
                        }
                    ?>
                </div><p class="nome"><?php echo $nome;?></a></p>
            </div>

            <div class="postarea">
                <p class="conteudo">
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
                        echo "<img src='img/posts_imagens/$imagem'>";
                    }
                ?> 
                <p>Postado em: <?php echo $data . " às " . $hora;?></p>   
            </div>
            <div class="postinteracoes"><a href="comentar.php?id=<?php echo $id_posts;?>"><i class="fa-regular fa-comment"></i></a><a href="favoritar.php?id=<?php echo $id_posts;?>"><i class="fa-regular fa-handshake"></i></a></div>

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
                        <a href=""><div class="img">
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
                
            </div>
        </div>
        <?php }}}}}}}?>
        
                
                    </div>
                </li>
            </ul>
        </nav>

        

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