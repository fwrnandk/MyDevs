<?php
    include 'config.php';
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $email_log = $_SESSION['email'];
    $idPost = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/styleloginpc.css">
    <link rel="stylesheet" href="css/stylelogincel.css">
    <link rel="stylesheet" href="css/stylelogintablet.css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Comentar</title>

    <style>
       input[type="text"]{
    background-color: rgba(0, 0, 0, 0);
    border: 1px solid rgb(45, 45, 45);
    border-top: 0;
    border-left: 0;
    border-right: 0;
    outline: none;
    color: rgb(45, 45, 45);
    width: 75%;
    font-size: 1.5vh;
}

 input[type="textarea"]{

    background-color: rgba(0, 0, 0, 0);
    border: 1px solid rgb(45, 45, 45);
    border-top: 0;
    border-left: 0;
    border-right: 0;
    height: 5vh;
    outline: none;
    color: rgb(45, 45, 45);
    width: 75%;
    font-size: 1.5vh;
    text-align: initial;
}

    </style>
</head>
<body>

    <div id="container">

        
        
       
        <div id="logo"> 
            <img src="img/logo.png" alt="logo"> 
            <img src="img/nomesite.png" alt="nomesite">
        </div>
        
        <div id="logindiv">

            <div class="login" style="position: absolute; top: 25%;">
                <center>
                <form action="" method="post">
                    <label for="conteudo">Comentário:</label>
                    <br>
                    <input type="textarea" name="comentario" id="conteudo" rows="20" cols="20" style="color: white;">
                    <br><br>
                    <input type="submit" name="comentar" value="Postar">
                    <a href="home.php"><input type="button" name="voltar" value="Voltar"></a>
                </form>
                </center>
                <?php
                    if(isset($_POST['comentar'])) {

                        $sql_user = "SELECT id_user FROM usuarios WHERE email='$email_log'";
                        $con = mysqli_query($conexao, $sql_user);
                
                        while ($dados_user = $con->fetch_array()) {
                            extract($dados_user);
                
                            $comentario = $_POST['comentario'];
                            $idPost = $_GET['id'];
                            date_default_timezone_set('America/Sao_Paulo');
                            $data = date("d/m/Y");
                            $hora = date("H:i");
                
                            if(empty($comentario)){
                                echo "É obrigatório ter um comentário.";
                            }else {
                                $sql = "INSERT INTO comentarios (id_post_coment, id_user_post_coment, comentario, data_coment, hora_coment) VALUES ('$idPost', '$id_user', '$comentario', '$data', '$hora')";
                
                                if(mysqli_query($conexao, $sql)) {
                                    echo "Comentário feito com sucesso!<br>";
                                    header('Location: home.php');
                                }else {
                                    echo "Erro ao fazer comentário!";
                                }
                            }
                        }
                    }
                ?>
            </div>

        </div>
    </div>

     <div class="area" >
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

<script>
  
</script>

</body>
</html>