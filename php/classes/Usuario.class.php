<?php
    include_once ("../utils/autoload.php");

    class Usuario extends Database{
        private $id;
        private $nome;
        private $login;
        private $senha;

        public function __construct($id, $nome, $login, $senha) {
            $this->setId($id);
            $this->setNome($nome);
            $this->setLogin($login);
            $this->setSenha($senha);
        }  
        

        //Métodos Get e Set
        public function getId() {
            return $this->id;
        }
        public function getNome() {
            return $this->nome;
        }
        
        public function getLogin() {
            return $this->login;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setId($id) {
            if (strlen($id) > 0)
                $this->id = $id;
        }

        public function setLogin($login) {
            if (strlen($login) > 0)    
                $this->login = $login;
        }

        public function setNome($nome) {
            if (strlen($nome) > 0)
            $this->nome = $nome;
        }

        public function setSenha($senha) {
            if (strlen($senha) > 0)
                $this->senha = $senha;
        }


        public function __toString() {
            $str = "<br>[Usuário]<br>".
                    "<br>ID do Usuário: ".$this->getId().
                    "<br>Nome: ".$this->getNome().
                    "<br>Login: ".$this->getLogin().
                    "<br>Senha: ".$this->getSenha().
                    "<br>Situação: ";
                    session_start();
                    $situacao = "Não logado";
                    if (isset($_SESSION["login"])) {
                        if($_SESSION['login'] == $this->getLogin())

                            $situacao = "Logado";
                    }
                    $str .= $situacao;
            return $str;
        }

        
        //CRUD
        public function create(){
            $sql = 'INSERT INTO usuario (nome, login, senha) 
                    VALUES(:nome, :login, :senha)';
            $param = array(":nome"=>$this->getNome(), 
                                ":login"=>$this->getLogin(), 
                                ":senha"=>$this->getSenha());
            return parent::comando($sql,$param);
        }

        public function update(){
            $sql = 'UPDATE usuario
                    SET nome = :nome, login = :login, senha = :senha
                    WHERE id = :id';
            $param = array(":nome"=>$this->getNome(), 
                                ":login"=>$this->getLogin(), 
                                ":senha"=>$this->getSenha(),
                                ":id"=>$this->getId());
            return parent::comando($sql,$param);
        }

        public function delete(){
            $sql = 'DELETE FROM usuario WHERE id = :id';
            $param = array(":id"=>$this->getId());
            return parent::comando($sql,$param);
        }


        //Métodos diversos
        public static function listar($busca = 0, $pesquisa = ""){
            $sql = "SELECT * FROM usuario";
            if ($busca > 0)
                switch($busca){
                    case(1): $sql .= " WHERE id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(2): $sql .= " WHERE nome like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(3): $sql .= " WHERE login like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                }
            if ($busca > 0)
                $params = array(':pesquisa'=>$pesquisa);
            else 
                $params = array();
            return parent::consulta($sql, $params);
            
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM usuario WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }

        public function efetuarLogin($login, $senha){
            $pdo = Database::conectar();
            $sql = "SELECT nome FROM usuario WHERE login = '$login' AND senha = '$senha';";
            $verificacao = $pdo->query($sql)->fetchAll();
            if($verificacao != ""){
                $_SESSION['nome'] = $verificacao[0]['nome'];
                $_SESSION['login'] = $login;
                return true;
            } else {
                $_SESSION['login'] = null;
                $_SESSION['nome'] = null;
                return false;
            }
        }
    }
?>