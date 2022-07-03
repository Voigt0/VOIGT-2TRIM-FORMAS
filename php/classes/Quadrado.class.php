<?php
    include_once ("../utils/autoload.php");

    class Quadrado extends Forma{
        private $lado;

        //Criação do construct
        public function __construct($id, $cor, $tabuleiro_id, $lado) {
            parent::__construct($id, $cor, $tabuleiro_id);
            $this->setLado($lado);
        }
        
        //Métodos get e set
        public function getLado() {
            return $this->lado;
        }
        
        public function setLado($lado) {
            $this->lado = $lado;
        }
        
        //Método toString
        public function __toString(){
            $str = parent::__toString();
            $str .= "<br>[Quadrado]".
                    "<br>Lado: ".$this->getLado().
                    "<br>Área: ".$this->area().
                    "<br>Perímetro: ".$this->perimetro().
                    "<br>Diagonal: ".round($this->diagonal(),2);
            return $str;
        }

        //CRUD
        public function create(){ 
            $sql = "INSERT INTO quadrado (lado, cor, tabuleiro_id) VALUES(:lado, :cor, :tabuleiro_id)";
            $param = array(":lado"=> $this->getLado(), 
                                ":cor"=> $this->getCor(), 
                                ":tabuleiro_id"=> $this->getIdTabuleiro());
            return parent::comando($sql, $param);
        }

        public function update() {
            $sql = "UPDATE quadrado SET lado = :lado, cor = :cor, tabuleiro_id = :tabuleiro_id WHERE (id = :id);";
            $param = array(":lado"=> $this->getLado(), 
                                ":cor"=> $this->getCor(), 
                                ":tabuleiro_id"=> $this->getIdTabuleiro(),
                                ":id"=> $this->getId());
            return parent::comando($sql, $param);
        }

        public function delete(){
            $sql = "DELETE FROM quadrado WHERE id = :id";
            $param = array(":id" => $this->getId());
            return parent::comando($sql, $param);
        }

        //Métodos diversos
        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM quadrado";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id LIKE :procurar ORDER BY id"; $procurar = $procurar."%";  break;
                    case(2): $sql .= " WHERE lado LIKE :procurar ORDER BY lado"; $procurar = $procurar."%"; break;
                    case(3): $sql .= " WHERE cor LIKE :procurar ORDER BY cor"; $procurar = "%".$procurar."%";  break;
                }
            if ($buscar > 0)
                $param = array(':procurar' => $procurar);
            else
                $param = array();
            return parent::consulta($sql, $param);
        }

        public function area() {
            return $this->getLado() * $this->getLado();
        }

        public function perimetro() {
            return $this->getLado()*4;
        }

        public function diagonal() {
            return $this->getLado()*sqrt(2);
        }

        public function desenha(){
            $desenho = "<div style='height: ".$this->getLado()."vh; width: ".$this->getLado()."vh; background-color:".$this->getCor()."; border: 1vh solid black;'></div>";
            return $desenho;
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM quadrado WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>