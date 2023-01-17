<?php
    include 'config.php';
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $email_log = $_SESSION['email'];
    $id_postador = $_GET['id'];
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
                  <form action="">
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
                      <input type="submit" value="Postar">
                  </form>
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
                        <p><?php echo $nome;}?></p></div> </a>
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
        <a href="perfil.html" id="back-to-top"><i class="fa-solid fa-angle-up"></i> <p>Voltar ao topo</p></a>

        <div class="perfil">
            <div class="info">
                
                <div class="img">
                <?php
                $sql_postador = "SELECT * FROM usuarios WHERE id_user='$id_postador'";
                $con_sql_postador = mysqli_query($conexao, $sql_postador);
                while($dados_postador = $con_sql_postador->fetch_array()){
                    extract($dados_postador);
                    if((!empty($foto_usuario)) and (file_exists("img/fts_perfil/$foto_usuario"))) {
                        echo "<img src='img/fts_perfil/$foto_usuario'><br>";
                    }else {
                        echo "<img src='img/fts_perfil/icon_user.png'><br>";
                    }
                ?>
                
                </div> <p class="nome"> <?php echo $nome;?></p> 

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
                
            </div>

            <div class="postarea">
    
                <p class="conteudo">
                    <?php echo $titulo;?><br>
                    
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
            <div class="postinteracoes"><a href="post.php?id=<?php echo $id_posts;}?>"><button id="open-modalcoment"><i class="fa-regular fa-comment"></i></button><i class="fa-regular fa-handshake"></i></a></div>

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
                    <a href="post.php?id=<?php echo $id_posts;?>"><?php echo $titulo;?></a><br>
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
            <div class="postinteracoes"><a href="post.php?id=<?php echo $id_posts;}?>"><button id="open-modalcoment"><i class="fa-regular fa-comment"></i></button><i class="fa-regular fa-handshake"></i></a></div>

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
            </ul>
        </nav>

        

    </div>

    <div class="dir">
        <div class="pesquisa">
            <label for="pesq"><i class="fa-solid fa-magnifying-glass"></i></label>
            <input type="search" name="pesq" id="pesquisar">
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
    </script>
    
</body>
</html>