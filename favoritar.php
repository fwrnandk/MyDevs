<?php
include 'config.php';
    session_start();
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

    $logado = $_SESSION['email'];


    $idPost = $_GET['id'];

    $sql_id_user = "SELECT id_user FROM usuarios WHERE email='$logado'";
    $con = mysqli_query($conexao, $sql_id_user);

    while ($dado_id_user = $con->fetch_array()) {
        extract($dado_id_user);

        $sql_verificar = "SELECT * FROM favoritos WHERE id_user_fav='$id_user' AND id_post_fav='$idPost'";
        $verificar = mysqli_query($conexao, $sql_verificar);
    }
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
                <?php
                     if(mysqli_num_rows($verificar) == 0) { ?>
                            <center><form action="" method="post">
                                <label for="conteudo">Deseja salvar esse post?</label>
                                <br><br>
                                <input type="submit" name="salvar" value="Sim">
                                <a href="home.php"><input type="button" name="voltar" value="Não"></a>
                            </form></center>
                        <?php
                            if(isset($_POST['salvar'])) {
                                $favoritar = "INSERT INTO favoritos (id_post_fav, id_user_fav) VALUES ('$idPost', '$id_user')";
                                $result = mysqli_query($conexao, $favoritar);
                                header('Location:home.php');
                            }
                    }else{ ?>
                        <center><form action="" method="post">
                            <label for="conteudo">Deseja retirar esse post de suas publicações salvas?</label>
                            <br><br>
                            <input type="submit" name="n_salvar" value="Sim">
                            <a href="home.php"><input type="button" name="voltar" value="Não"></a>
                        </form></center>
                        <?php
                            if(isset($_POST['n_salvar'])) {
                                $sqlDel = "DELETE FROM favoritos WHERE id_user_fav='$id_user' AND id_post_fav='$idPost'";
                                $resultDel = mysqli_query($conexao, $sqlDel);
                                header('Location:home.php');
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