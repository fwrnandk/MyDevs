<?php
    include 'config.php';

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
    <title>Apagar Posts</title>

    <style>
       

    </style>
</head>
<body>

    <div id="container">

        
        
       
        <div id="logo"> 
            <img src="img/logo.png" alt="logo"> 
            <img src="img/nomesite.png" alt="nomesite">
        </div>
        
        <div id="logindiv">

            <div class="login">
                
                    <label>Deseja apagar o post?</label>
                    <div class="btn">
                        <a href="excluir_post.php?id=<?php echo $idPost;?>"><input type="submit" value="SIM"></a>
                        <br>
                        <br>
                        <a href="perfil.php"><input type="submit" value="NÂO"></a>
                    </div>
                </form>
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