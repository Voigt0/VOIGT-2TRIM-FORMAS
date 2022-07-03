<!DOCTYPE html>
<?php
    //Inclusão de arquivos
    include_once "../controle/controleGeral.php";

    //Salvar contexto
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = Cubo::consultarData($id);
    }
   
    //Declarar variáveis
    $operation = isset($_GET['operation']) ? $_GET['operation'] : "";
    $table = "cubo";
    $busca = isset($_POST["busca"]) ? $_POST["busca"] : "1";
    $pesquisa = isset($_POST["pesquisa"]) ? $_POST["pesquisa"] : "";
    $operation = isset($_GET['operation']) ? $_GET['operation'] : "";

    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $quadrado_id = isset($_POST['quadrado_id']) ? $_POST['quadrado_id'] : 0;
    $tabuleiro_id = isset($_POST['tabuleiro_id']) ? $_POST['tabuleiro_id'] : "";
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Tabela Cubo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    <script src='../js/main.js'></script>    
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico">
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link <?php if(!isset($id)){echo 'active';} ?>" id="nav-table-tab" data-bs-toggle="tab" data-bs-target="#nav-table" type="button" role="tab" aria-controls="nav-table">Tabela</button>
                <button class="nav-link <?php if(isset($id)){echo 'active';} ?>" id="nav-form-tab" data-bs-toggle="tab" data-bs-target="#nav-form" type="button" role="tab" aria-controls="nav-form">Formulário</button>
                <button class="nav-link" id="nav-class-tab" data-bs-toggle="tab" data-bs-target="#nav-class" type="button" role="tab" aria-controls="nav-class">Classe</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?php if(!isset($id)){echo 'show active';} ?>" id="nav-table" role="tabpanel" aria-labelledby="nav-table-tab" tabindex="0">
                <br>    
                <h1>Tabela Cubo</h1>
                <br>
                <form action="" method="post" style="padding-left: 5vw; padding-right: 5vw;">
                    <input type="radio" id="id" name="busca" value="1" <?php if($busca == "1"){echo "checked";}?>>
                    <label for="huey"><h3>#ID</h3></label>
                    <br>
                    <input type="radio" id="cor" name="busca" value="2" <?php if($busca == "2"){echo "checked";}?>>
                    <label for="huey"><h3>Cor</h3></label>
                    <br><br>
                    <div class="" style="padding-left: 5vw;">
                        <legend>Procurar: </legend>
                        <input type="text" style="width: 30vw;" name="pesquisa" id="pesquisa" value="<?php echo $pesquisa;?>">
                        <button type="submit" class="btn btn-dark" name="acao" id="acao">
                        <img src="../../img/search.svg" style="width: 3vh;">
                        </button>
                        <br><br>
                    </div>
                </form>
                <div class="">
                    <table id="example" class="table table-striped" style="background-color: #FFF;">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">#ID</th>
                                <th scope="col">Cor</th>
                                <th scope="col">Quadrado</th>
                                <th scope="col">Tabuleiro</th>
                                <th scope="col">Lado</th>
                                <th scope="col">Alterar</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">Listar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            //Filtro da tabela exibida
                            $tabela = Cubo::listar($busca, $pesquisa);
                            foreach($tabela as $key => $value) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $value['id'];?></th>
                                <td scope="row" style="background-color: <?php echo $value['cor'];?>"><?php echo $value['cor'];?></td>
                                <td scope="row"><?php echo $value['quadrado_id'];?></td>
                                <td scope="row"><?php echo $value['tabuleiro_id'];?></td>
                                <td scope="row"><?php echo $value['lado'];?></td>
                                <td scope="row"><a href="cubo.php?id=<?php echo $value['id'];?>"><img src="../../img/edit.svg" style="width: 3vw;"></a></td>
                                <td><a onclick="return confirm('Deseja mesmo excluir?')" href="../controle/controleGeral.php?id=<?php echo $value['id'];?>&operation=delete&table=cubo"><img src="../../img/delete.svg" style="width: 3vw;"></a></td>
                                <td><a href="../show/showCubo.php?id=<?php echo $value['id']; ?>&quadrado_id=<?php echo $value['quadrado_id'];?>&cor=<?php echo str_replace('#', '%23', $value['cor']);?>&tabuleiro_id=<?php echo $value['tabuleiro_id']?>&lado=<?php echo $value['lado']?>"><img src='../../img/list.svg' style="width: 3vw;"></a></td>
                            </tr>
                        <?php
                            } 
                        ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade  <?php if(isset($id)){echo 'show active';} ?>" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab" tabindex="0">
                <form action="<?php if(isset($_GET['id'])) { echo "../controle/controleGeral.php?id=$id&operation=update&table=cubo";} else {echo "../controle/controleGeral.php?operation=create&table=cubo";} ?>" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
                    <br>
                    <h1>Cadastro Círculo</h1>
                    <br>
                    <div class="row form-group">
                        <label for="">Valor cor:</label><br>
                        <div class="col-4">
                            <input required type="color" class="form-control" name="cor" id="cor" placeholder="Digite a cor" value="<?php if (isset($data[0]['cor'])){echo $data[0]['cor'];}?>">
                        </div>
                    </div>
                    <br>
                    <select name="quadrado_id"  id="quadrado_id" class="form-select">
                        <?php
                            //Select Box
                            require_once "../utils/utility.php";
                            echo selectBox('quadrado', array('quadrado_id', 'quadrado_id'), $data[0]['quadrado_id']);
                        ?>
                    </select>
                    <br>
                    <select name="tabuleiro_id"  id="tabuleiro_id" class="form-select">
                        <?php
                            //Select Box
                            require_once "../utils/utility.php";
                            echo selectBox('tabuleiro', array('tabuleiro_id', 'tabuleiro_id'), $data[0]['tabuleiro_id']);
                        ?>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-dark" name="submit" id="submit" value="true">Enviar</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-class" role="tabpanel" aria-labelledby="nav-class-tab" tabindex="0">

            </div>
        </div>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>