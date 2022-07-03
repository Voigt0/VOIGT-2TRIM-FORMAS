<?php
    $operation = "";
    if(isset($_POST['operation'])){$operation = $_POST['operation'];}else if(isset($_GET['operation'])){$operation = $_GET['operation'];}
    $table = "";
    if(isset($_POST['table'])){$table = $_POST['table'];}else if(isset($_GET['table'])){$table = $_GET['table'];}

    action($operation, $table);

    function action($operation, $table){
        include_once ("../utils/autoload.php");
        if($operation == "create"){
            try {
                if($table == "quadrado"){ //Create da tabela QUADRADO
                    $quad = new Quadrado("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado'],);
                    $quad->create();
                    header("location:../paginas/quadrado.php");
                } else if($table == "tabuleiro")  { //Create da tabela TABULEIRO
                    $tabu = new Tabuleiro("", $_POST['lado']);
                    $tabu->create();
                    header("location:../paginas/tabuleiro.php");
                } else if($table == "usuario")  { //Create da tabela USUARIO
                    $usua = new Usuario("", $_POST['nome'], $_POST['login'], $_POST['senha']);
                    $usua->create();
                    header("location:../paginas/usuario.php");
                }  else if($table == "triangulo")  { //Create da tabela TRIANGULO
                    $tria = new Triangulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado1'], $_POST['lado2'], $_POST['lado3']);
                    $tria->create();
                    header("location:../paginas/triangulo.php");
                } else if($table == "circulo")  { //Create da tabela CIRCULO
                    $circ = new Circulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['raio']);
                    $circ->create();
                    header("location:../paginas/circulo.php");
                }else if($table == "retangulo")  { //Create da tabela RETANGULO
                    $reta = new Retangulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['altura'], $_POST['base']);
                    $reta->create();
                    header("location:../paginas/retangulo.php");
                }else if($table == "cubo")  { //Create da tabela CUBO
                    $cubo = new Cubo("", $_POST['quadrado_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $cubo->create();
                    header("location:../paginas/cubo.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao criar as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($operation == "update"){
            try {
                if($table == "quadrado"){
                    $quad = new Quadrado($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado'],);
                    $quad->update();
                    header("location:../paginas/quadrado.php");
                } else if ($table == "tabuleiro"){
                    $tabu = new Tabuleiro($_GET['id'], $_POST['lado']);
                    $tabu->update();
                    header("location:../paginas/tabuleiro.php");
                }else if ($table == "usuario"){
                    $usua = new Usuario($_GET['id'], $_POST['nome'], $_POST['login'], $_POST['senha']);
                    $usua->update();
                    header("location:../paginas/usuario.php");
                }else if ($table == "triangulo"){
                    $tria = new Triangulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado1'], $_POST['lado2'], $_POST['lado3']);
                    $tria->update();
                    header("location:../paginas/triangulo.php");
                }else if ($table == "circulo"){
                    $circ = new Circulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['raio']);
                    $circ->update();
                    header("location:../paginas/circulo.php");
                }else if ($table == "retangulo"){
                    $reta = new Retangulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['altura'], $_POST['base']);
                    $reta->update();
                    header("location:../paginas/retangulo.php");
                }else if($table == "cubo")  {
                    $cubo = new Cubo($_GET['id'], $_POST['quadrado_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $cubo->update();
                    header("location:../paginas/cubo.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao update as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($operation == "delete"){
            try {
                if($table == "quadrado"){
                    $quad = new Quadrado($_GET['id'], "", "", "");
                    $quad->delete();                
                    header("location:../paginas/quadrado.php");
                } else if($table == "tabuleiro"){
                    $tabu = new Tabuleiro($_GET['id'], "");
                    $tabu->delete();                
                    header("location:../paginas/tabuleiro.php");
                } else if($table == "usuario"){
                    $usua = new Usuario($_GET['id'], "", "", "");
                    $usua->delete();                
                    header("location:../paginas/usuario.php");
                } else if($table == "triangulo"){
                    $tria = new Triangulo($_GET['id'], "", "", "", "", "");
                    $tria->delete();                
                    header("location:../paginas/triangulo.php");
                } else if($table == "circulo"){
                    $circ = new Circulo($_GET['id'], "", "", "");
                    $circ->delete();                
                    header("location:../paginas/circulo.php");
                } else if($table == "retangulo"){
                    echo 1;
                    $reta = new Retangulo($_GET['id'], "","","", "");
                    $reta->delete();
                    header("location:../paginas/retangulo.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao update as informações.</h1><br> Erro:".$e->getMessage();
            }
        }
    }
?>