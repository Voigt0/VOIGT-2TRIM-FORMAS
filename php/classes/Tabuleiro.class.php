<?php
    include_once ("../utils/autoload.php");

    class Tabuleiro extends Database{
        private $id;
        private $lado;

        public function __construct($id, $lado) {
            $this->setId($id);
            $this->setlado($lado);
        }

        //Métodos get e set
        public function getId() {
            return $this->id;
        }

        public function getLado() {
            return $this->lado;
        }
        
        public function setId($id) {
            if ($id >=  0)
                $this->id = $id;
        }     
        
        public function setlado($lado) {
            if ($lado >  0)
                $this->lado = $lado;
        }

        public function __toString() {
            return  "<br>[Tabuleiro]".
                    "<br>ID do Tabuleiro: ".$this->getId().
                    "<br>Lado: ".$this->getLado().
                    "<br>Área: ".round($this->area(),2).
                    "<br>Perimetro: ".round($this->perimetro(),2).
                    "<br>Diagonal: ".round($this->diagonal(),2);
        }

        public function area() {
            $area = $this->lado * $this->lado;
            return $area;
        }

        public function perimetro() {
            $perimetro = $this->lado * 4;
            return $perimetro;
        }

        public function diagonal() {
            $diagonal = $this->lado * sqrt(2);
            return $diagonal;
        }

        //CRUD
        public function create(){
            $sql = 'INSERT INTO tabuleiro (lado) 
            VALUES(:lado)';
            $parametros = array(":lado"=>$this->getLado());
            return parent::comando($sql,$parametros);
        }

        
        public function update(){
            $sql = 'UPDATE tabuleiro 
            SET lado = :lado
            WHERE id = :id';
            $parametros = array(":lado"=>$this->getLado(),
            ":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }
        
        public function delete(){
            $sql = 'DELETE FROM tabuleiro WHERE id = :id';
            $parametros = array(":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }

        //Métodos diversos
        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM tabuleiro";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE lado like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::consulta($sql, $parametros);
        }

        public function desenha(){
        $str = "<img src='../../img/tabuleiroDesenho.svg' style='width: ".$this->getLado()."vh;height: ".$this->getLado()."vh;border: 1vh black solid;'></div><br><br>";
            return $str;
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM tabuleiro WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>