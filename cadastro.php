<?php

error_reporting(0);
include_once 'config.php';

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['idade'];
    $senha = md5($_POST['senha']);
    $asenha = md5($_POST['asenha']);
    $idnt = $_POST['idnt'];
    $descr = $_POST['descr'];

    if ($senha == $asenha) {
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = mysqli_query($conexao, $sql);

        if (!$result->num_rows > 0) {

            $extensao = strtolower(substr($_FILES['foto_usuario']['name'], -4));
            $novo_nome= md5(time()) . $extensao;
            $diretorio= "img/fts_perfil/";
            move_uploaded_file($_FILES['foto_usuario']['tmp_name'], $diretorio.$novo_nome);

            $sql = "INSERT INTO usuarios (nome, email, telefone, data_nasc, senha, foto_usuario, data, idnt, descr)
                    VALUES ('$nome', '$email','$telefone', '$data_nasc', '$senha', '$novo_nome', NOW(), '$idnt', '$descr')";
            $result = mysqli_query($conexao, $sql);
            
            if ($result){
                header('Location: login.php');
                $nome = "";
                $email = "";
                $telefone = "";
                $idnt = "";
                $$descr = "";
                $_POST['senha'] = "";
                $_POST['asenha'] = "";
        
            } else {
                echo "<script>alert('Algo deu errado.')</script>";
            }
        } else {
            echo "<script>alert('Oops! Esse email já está cadastrado.')</script>";
        }
    } else {
        echo "<script>alert('Senhas Diferentes.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/stylecadastropc.css">
    <link rel="stylesheet" href="css/stylecadastrocel.css">
    <link rel="stylesheet" href="css/stylecadastrotablet.css">
  <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Cadastre-se</title>

    <style>
       

    </style>
</head>
<body>

    <div id="container">
        
        <button id="x">
             <a href="index.php">
                <i class="fa-solid fa-x fa-2x"></i>
            </a>
        </button>

        <div class="logo">
            
            <img src="img/logo.png" alt="logo"> 
            <img src="img/nomesite.png" alt="nomesite">
        </div>
        
        <div id="logindiv">

            <div class="login">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nome"><i class="fa-solid fa-user"></i></label>
                    <input type="text" placeholder="Nome" name="nome" id="nome">
                    <br>
                     <label for="email"><i class="fa-solid fa-envelope fa-1x"></i></label>
                    <input type="email" name="email" id="email" placeholder="E-mail" >
                    <br>
                    <label for="Telefone"><i class="fa-solid fa-phone"></i></label>
                    <input type="tel" name="telefone" id="telefone" placeholder="Telefone">
                    <br>
                    <label for="idade" class="idade"><i class="fa-solid fa-calendar-day fa-1x"></i></label>
                    <input type="date" name="idade" id="idade">
                    <br>
                    <label for="senha"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <br>
                    <label for="Confirme a senha"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="asenha" id="asenha" placeholder="Confirme a senha">
                    <br>
                    <label for="Foto de perfil"><i class="fa-solid fa-camera"></i></label>
                    <input type="file" name="foto_usuario" id="foto_usuario" placeholder="Foto de perfil">
                    <br>
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

            <center><label for="bibliografia">Biografia</label></center>
            <textarea id="biografia" name="descr" required style="background: none; color: white;"></textarea><br><br><br><br>

                    <div class="btn">
                    <input type="submit" name="submit" id="logar" value="Cadastrar">
                        <br></br>
                        <p>Já possui uma conta? 
                            <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>

        </div>
    </div>

     <div class="area">
       <ul class="circles">
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
         <li></li>
       </ul>
     </div>


</body>
</html>