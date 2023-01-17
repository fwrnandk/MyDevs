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
    <title>Editar Dados</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleperfil.css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <script src="js/script.js" defer></script>

</head>
<a href="perfil.php"><input type="button" name="voltar" value="Voltar"></a>
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
                                        $descr = "";
                                        header('Location: perfil.php');
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
                                                header('Location: perfil.php');
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