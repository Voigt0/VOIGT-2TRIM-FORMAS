<!DOCTYPE html>
<?php
    include_once ("../utils/autoload.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $lado1 = isset($_GET['lado1']) ? $_GET['lado1'] : 0;
    $lado2 = isset($_GET['lado2']) ? $_GET['lado2'] : 0;
    $lado3 = isset($_GET['lado3']) ? $_GET['lado3'] : 0;
    $cor = isset($_GET['cor']) ? $_GET['cor'] : "";
    $tabuleiro_id = isset($_GET['tabuleiro_id']) ? $_GET['tabuleiro_id'] : 0;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico">
</head>
<body>
    <header>
        <a href="../paginas/triangulo.php"><img src="../../img/back.svg" alt="" class="" style="width: 5vw;"></a>
    </header>
    
    <div class="card text-bg-dark mb-3">
        <center>
        <?php 
            $tria = new Triangulo($id, $cor, $tabuleiro_id, $lado1, $lado2, $lado3);
            echo $tria->__toString();
            echo "<br><br>";
            echo $tria->desenha();
        ?>
        <br>
        </center>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>