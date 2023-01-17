<?php
    include 'config.php';
    if(!empty($_GET['id'])) {
        $idPost = $_GET['id'];
        $sqlDel = "DELETE FROM posts WHERE id_posts='$idPost'";
        $resultDel = mysqli_query($conexao, $sqlDel);;
    }
    header('Location: perfil.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apagar Post</title>
</head>
<body>
</body>
</html>