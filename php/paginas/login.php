<!DOCTYPE html>
<?php
    require_once "../classes/Usuario.class.php";

    $operation = isset($_GET['operation']) ? $_GET['operation'] : "";
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    <script src='../js/main.js'></script>
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico">
    <link href="../../css/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <?php
    if($operation == "login") {
        try{
            $usua = new Usuario('', '', '', '');
            $usua->efetuarLogin("$login", "$senha");
            header("location:login.php?try=true");
        } catch(Exception $e) {
            echo "<h1>Erro ao logar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($operation == "logout") {
        $_SESSION["nome"] = null;
        $_SESSION['login'] = null;
        header("location:login.php");
    }
    ?>
    <content>
        <div class="login-page">
            <div class="form">
                <form action="login.php?operation=login" method="post" id="form" class="login-form">
                    <h1>Login</h1>
                    <input required type="text" name="login" id="login" placeholder="Digite o login" value="<?php if (isset($_POST['login'])){echo $_POST['login'];}?>">
                    <input required type="password" name="senha" id="senha" placeholder="Digite a senha" value="<?php if (isset($_POST['senha'])){echo $_POST['senha'];}?>">
                    <button>login</button>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>
        <hr>
        <h1>
        <?php
            if(isset($_SESSION['nome'])) {
                echo "<div class='alert alert-success' role='alert'>Você logou no sistema!</div>";
            } else if(isset($_GET['try']) && !isset($_SESSION['nome'])) {
                $error = '"Informações incorretas"';
                echo "<img src onerror='alert($error)'>";
            }
        ?>
        </h1>
    </content>
</body>
</html>