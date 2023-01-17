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
    <title>Login</title>

    <script>
        function onChangeEmail() {
    toggleButtonsDisable();
    toggleEmailErrors();
}

function onChangePassword() {
    toggleButtonsDisable();
    togglePasswordErrors();
} 

function toggleEmailErrors() {
    const email = document.getElementById("email").value;
    if (!email) {
        document.getElementById("email-required-error").style.display = "block";
    } else {
        document.getElementById("email-required-error").style.display = "none";
    }
    
    if (validateEmail(email)) {
        document.getElementById("email-invalid-error").style.display = "none";
    } else {
        document.getElementById("email-invalid-error").style.display = "block";
    }
}

function togglePasswordErrors() {
    const password = document.getElementById("password").value;
    if (!password) {
       document.getElementById("password-required-error").style.display = "block";
    } else {
       document.getElementById("password-required-error").style.display = "none";
    }
}

function toggleButtonsDisable() {
    const emailValid = isEmailValid();
    document.getElementById("recover-password-button").disabled = !emailValid;
}

function isEmailValid() {
    const email = document.getElementById("email").value;
    if (!email) {
        return false;
    }
    return validateEmail(email);
}

function isPasswordValid() {
    const password = document.getElementById("password").value;
    if (!password) {
        return false;
    }
    return true;
}

function validateEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}
    </script>
</head>
<body>

    <div id="container">

        
        <button id="x1">
            <a href="index.php">
               <i class="fa-solid fa-x fa-2x"></i>
           </a>
       </button>
       
        <div class="logo1"> 
            <img src="img/logo.png" alt="logo"> 
            <img src="img/nomesite.png" alt="nomesite">
        </div>
        
        <div id="logindiv1">

            <div class="login1">
                <form action="testLogin.php" method="POST">
                    <div>
                        <div><label>Email</label></div>
                        <input type="email" name="email" id="email" placeholder="seu@email.com" onchange="onChangeEmail()"/>
                        <div class="error" id="email-required-error">Email é obrigatório</div>
                        <div class="error" id="email-invalid-error">Email é inválido</div>
                    <div>
                        <div><label>Senha</label></div>
                        <input type="password" name="senha" id="password" placeholder="Senha" onchange="onChangePassword()"/>
                        <div class="error" id="password-required-error">Senha é obrigatória</div>
                    </div>
                    <div>
                        <button type="button" class="clear" id="recover-password-button" disabled="true"></button>
                    </div>
                    <div>
                        <input type="submit" class="solid" name="submit" id="login-button" value="Entrar">
                    </div>
                    <div>
                        <button type="button" class="outline"><a href="cadastro.php"> Registrar</a></button>
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