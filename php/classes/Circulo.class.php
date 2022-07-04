<?php
    include_once ("../utils/autoload.php");

    class Circulo extends Forma{
        private $raio;

        public function __construct($id, $cor, $tabuleiro_id, $raio) {
            parent::__construct($id, $cor, $tabuleiro_id);
            $this->setRaio($raio);
        }

        //Métodos Get e Set
        public function getRaio() {
            return $this->raio;
        }

        public function setRaio($raio) {
            if ($raio >  0)
                $this->raio = $raio;
        }

        //Método toString
        public function __toString() {
            $str = parent::__toString(); //Pega o toString da classe pai
            $str .=  "<br>[Círculo]".
                    "<br>Raio: ".$this->getRaio().
                    "<br>Cor: ".$this->getCor().
                    "<br>Área: ".round($this->area(),2).
                    "<br>Circunferência: ".round($this->perimetro(),2).
                    "<br>Diâmetro: ".round($this->diametro(),2);
            return $str;
        }

        
        //CRUD
        public function create(){
            $sql = 'INSERT INTO circulo (raio, cor, tabuleiro_id) 
            VALUES(:raio, :cor, :tabuleiro_id)';
            $param = array(":raio"=>$this->getraio(), 
            ":cor"=>$this->getCor(), 
            ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$param);
        }
        
        public function update(){
            $sql = 'UPDATE circulo 
            SET raio = :raio, cor = :cor, tabuleiro_id = :tabuleiro_id
            WHERE id = :id';
            $param = array(":raio"=>$this->getraio(),
            ":cor"=>$this->getCor(),
            ":tabuleiro_id"=>$this->getIdTabuleiro(),
            ":id"=>$this->getId());
            return parent::comando($sql,$param);
        }
        
        public function delete(){
            $sql = 'DELETE FROM circulo WHERE id = :id';
            $param = array(":id"=>$this->getId());
            return parent::comando($sql,$param);
        }
        
        
        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM circulo";
            if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                case(2): $sql .= " WHERE raio like :procurar"; $procurar = "%".$procurar."%";; break;
                case(3): $sql .= " WHERE cor like :procurar"; $procurar = "%".$procurar."%"; break;
                case(4): $sql .= " WHERE tabuleiro_id like :procurar"; $procurar = "%".$procurar."%"; break;
            }
            if ($buscar > 0)
            $param = array(':procurar'=>$procurar);
            else 
            $param = array();
            return parent::consulta($sql, $param);
        }
        
        public function area() {
            $area = pi() * pow($this->getRaio(), 2);
            return $area;
        }

        public function perimetro() {
            $perimetro = 2 * pi() * $this->getRaio();
            return $perimetro;
        }

        public function diametro() {
            $diametro = 2 * $this->getRaio();
            return $diametro;
        }

        public function desenha(){
            $str = "<div style='border-radius: 50%; display: inline-block; width: ".$this->diametro()."px; height: ".$this->diametro()."px; background: ".$this->getcor()."; border: 1vh solid black;'></div><br>";
            return $str;
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM circulo WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>