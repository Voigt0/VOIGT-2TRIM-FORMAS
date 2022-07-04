<!DOCTYPE html>
<?php
    //Inclusão de arquivos
    include_once "../controle/controleGeral.php";

    //Salvar contexto
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = Usuario::consultarData($id);
    }
   
    //Declarar variáveis
    $operation = isset($_GET['operation']) ? $_GET['operation'] : "";
    $table = "usuario";
    $busca = isset($_POST["busca"]) ? $_POST["busca"] : "1";
    $pesquisa = isset($_POST["pesquisa"]) ? $_POST["pesquisa"] : "";
    $operation = isset($_GET['operation']) ? $_GET['operation'] : "";

    $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
    $login = isset($_POST['login']) ? $_POST['login'] : 0;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Tabela Usuário</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../../bootstrap/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
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
                <h1>Tabela Usuário</h1>
                <br>
                <form action="" method="post" style="padding-left: 5vw; padding-right: 5vw;">
                    <input class="form-check-input" type="radio" id="id" name="busca" value="1" <?php if($busca == "1"){echo "checked";}?>>
                    <label for="huey"><h3>#ID</h3></label>
                    <br>
                    <input class="form-check-input" type="radio" id="nome" name="busca" value="2" <?php if($busca == "2"){echo "checked";}?>>
                    <label for="huey"><h3>Nome</h3></label>
                    <br>
                    <input class="form-check-input" type="radio" id="login" name="busca" value="3" <?php if($busca == "3"){echo "checked";}?>>
                    <label for="huey"><h3>Login</h3></label>
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
                                <th scope="col">Nome</th>
                                <th scope="col">Login</th>
                                <th scope="col">Senha</th>
                                <th scope="col">Alterar</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">Listar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            //Filtro da tabela exibida
                            $tabela = Usuario::listar($busca, $pesquisa);
                            foreach($tabela as $key => $value) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $value['id'];?></th>
                                <td scope="row"><?php echo $value['nome'];?></td>
                                <td scope="row"><?php echo $value['login'];?></td>
                                <td scope="row"><?php echo $value['senha'];?></td>
                                <td scope="row"><a href="usuario.php?id=<?php echo $value['id'];?>"><img src="../../img/edit.svg" style="width: 3vw;"></a></td>
                                <td><a onclick="return confirm('Deseja mesmo excluir?')" href="../controle/controleGeral.php?id=<?php echo $value['id'];?>&operation=delete&table=usuario"><img src="../../img/delete.svg" style="width: 3vw;"></a></td>
                                <td><a href="../show/showUsuario.php?id=<?php echo $value['id']; ?>&nome=<?php echo $value['nome'];?>&login=<?php echo  $value['login'];?>&senha=<?php echo $value['senha']?>"><img src='../../img/list.svg' style="width: 3vw;"></a></td>
                            </tr>
                        <?php
                            } 
                        ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade  <?php if(isset($id)){echo 'show active';} ?>" id="nav-form" role="tabpanel" aria-labelledby="nav-form-tab" tabindex="0">
                <form action="<?php if(isset($_GET['id'])) { echo "../controle/controleGeral.php?id=$id&operation=update&table=usuario";} else {echo "../controle/controleGeral.php?operation=create&table=usuario";}?>" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
                    <br>
                    <h1>Cadastro Usuario</h1>
                    <br>
                    <div class="form-group">
                        <label for="">Informe o nome:</label>
                        <input required type="tet" class="form-control" name="nome" id="nome" placeholder="Digite o nome" value="<?php if (isset($data[0]['nome'])){echo $data[0]['nome'];}?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Informe o login:</label>
                        <input required type="text" class="form-control" name="login" id="login" placeholder="Digite o login" value="<?php if (isset($data[0]['login'])){echo $data[0]['login'];}?>">
                    </div>
                    <br>
                    <div class="row form-group">
                        <label for="">Informe a senha:</label><br>
                        <div class="col-4">
                            <input required type="<?php if(isset($_GET['id'])) { echo 'text';} else { echo'password';}?>" class="form-control" name="senha" id="senha" id="senha" placeholder="Digite a senha" value="<?php if (isset($data[0]['senha'])){echo $data[0]['senha'];}?>">
                        </div>
                    </div>
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