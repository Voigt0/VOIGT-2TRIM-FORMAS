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
                if($table == "quadrado"){
                    //Create da tabela QUADRADO
                    $quad = new Quadrado("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado'],);
                    $quad->create();
                    header("location:../paginas/quadrado.php");
                } else if($table == "tabuleiro")  {
                    //Create da tabela TABULEIRO
                    $tabu = new Tabuleiro("", $_POST['lado']);
                    $tabu->create();
                    header("location:../paginas/tabuleiro.php");
                } else if($table == "usuario")  {
                    //Create da tabela USUARIO
                    $usua = new Usuario("", $_POST['nome'], $_POST['login'], $_POST['senha']);
                    $usua->create();
                    header("location:../paginas/usuario.php");
                }  else if($table == "triangulo")  {
                    //Create da tabela TRIANGULO
                    $tria = new Triangulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado1'], $_POST['lado2'], $_POST['lado3']);
                    $tria->create();
                    header("location:../paginas/triangulo.php");
                } else if($table == "circulo")  {
                    //Create da tabela CIRCULO
                    $circ = new Circulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['raio']);
                    $circ->create();
                    header("location:../paginas/circulo.php");
                } else if($table == "retangulo")  {
                    //Create da tabela RETANGULO
                    $reta = new Retangulo("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['altura'], $_POST['base']);
                    $reta->create();
                    header("location:../paginas/retangulo.php");
                } else if($table == "cubo")  {
                    //Create da tabela CUBO
                    $cubo = new Cubo("", $_POST['quadrado_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $cubo->create();
                    header("location:../paginas/cubo.php");
                } else if($table == "esfera")  {
                    //Create da tabela ESFERA
                    $esfe = new Esfera("", $_POST['circulo_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $esfe->create();
                    header("location:../paginas/esfera.php");
                } else if($table == "icosaedro")  {
                    //Create da tabela ICOSAEDRO
                    $icos = new Icosaedro("", $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado']);
                    $icos->create();
                    header("location:../paginas/icosaedro.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao criar as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($operation == "update"){
            try {
                if($table == "quadrado"){
                    //Update da tabela QUADRADO
                    $quad = new Quadrado($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado'],);
                    $quad->update();
                    header("location:../paginas/quadrado.php");
                } else if ($table == "tabuleiro"){
                    //Update da tabela TABULEIRO
                    $tabu = new Tabuleiro($_GET['id'], $_POST['lado']);
                    $tabu->update();
                    header("location:../paginas/tabuleiro.php");
                } else if ($table == "usuario"){
                    //Update da tabela USUARIO
                    $usua = new Usuario($_GET['id'], $_POST['nome'], $_POST['login'], $_POST['senha']);
                    $usua->update();
                    header("location:../paginas/usuario.php");
                } else if ($table == "triangulo"){
                    //Update da tabela TRIANGULO
                    $tria = new Triangulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado1'], $_POST['lado2'], $_POST['lado3']);
                    $tria->update();
                    header("location:../paginas/triangulo.php");
                } else if ($table == "circulo"){
                    //Update da tabela CIRCULO
                    $circ = new Circulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['raio']);
                    $circ->update();
                    header("location:../paginas/circulo.php");
                } else if ($table == "retangulo"){
                    //Update da tabela RETANGULO
                    $reta = new Retangulo($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['altura'], $_POST['base']);
                    $reta->update();
                    header("location:../paginas/retangulo.php");
                } else if($table == "cubo"){
                    //Update da tabela CUBO
                    $cubo = new Cubo($_GET['id'], $_POST['quadrado_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $cubo->update();
                    header("location:../paginas/cubo.php");
                } else if($table == "esfera"){
                    //Update da tabela ESFERA
                    $esfe = new Esfera($_GET['id'], $_POST['circulo_id'], $_POST['tabuleiro_id'], '', $_POST['cor']);
                    $esfe->update();
                    header("location:../paginas/esfera.php");
                } else if($table == "icosaedro"){
                    //Update da tabela ICOSAEDRO
                    $icos = new Icosaedro($_GET['id'], $_POST['cor'], $_POST['tabuleiro_id'], $_POST['lado']);
                    $icos->update();
                    header("location:../paginas/icosaedro.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao update as informações.</h1><br> Erro:".$e->getMessage();
            }
        } else if($operation == "delete"){
            try {
                if($table == "quadrado"){
                    //Delete da tabela QUADRADO
                    $quad = new Quadrado($_GET['id'], "", "", "");
                    $quad->delete();                
                    header("location:../paginas/quadrado.php");
                } else if($table == "tabuleiro"){
                    //Delete da tabela TABULEIRO
                    $tabu = new Tabuleiro($_GET['id'], "");
                    $tabu->delete();                
                    header("location:../paginas/tabuleiro.php");
                } else if($table == "usuario"){
                    //Delete da tabela USUARIO
                    $usua = new Usuario($_GET['id'], "", "", "");
                    $usua->delete();                
                    header("location:../paginas/usuario.php");
                } else if($table == "triangulo"){
                    //Delete da tabela TRIANGULO
                    $tria = new Triangulo($_GET['id'], "", "", "", "", "");
                    $tria->delete();                
                    header("location:../paginas/triangulo.php");
                } else if($table == "circulo"){
                    //Delete da tabela CIRCULO
                    $circ = new Circulo($_GET['id'], "", "", "");
                    $circ->delete();                
                    header("location:../paginas/circulo.php");
                } else if($table == "retangulo"){
                    //Delete da tabela RETANGULO
                    $reta = new Retangulo($_GET['id'], "","","", "");
                    $reta->delete();
                    header("location:../paginas/retangulo.php");
                } else if($table == "cubo"){
                    //Delete da tabela CUBO
                    $cubo = new Cubo($_GET['id'], "","","", "");
                    $cubo->delete();
                    header("location:../paginas/cubo.php");
                } else if($table == "esfera"){
                    //Delete da tabela ESFERA
                    $esfe = new Esfera($_GET['id'], "","","", "");
                    $esfe->delete();
                    header("location:../paginas/esfera.php");
                } else if($table == "icosaedro"){
                    //Delete da tabela ICOSAEDRO
                    $icos = new Icosaedro($_GET['id'], "","","");
                    $icos->delete();
                    header("location:../paginas/icosaedro.php");
                }
            } catch(Exception $e) {
                echo "<h1>Erro ao update as informações.</h1><br> Erro:".$e->getMessage();
            }
        }
    }
?>