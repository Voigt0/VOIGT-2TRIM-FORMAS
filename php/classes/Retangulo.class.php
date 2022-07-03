<?php
    include_once ("../utils/autoload.php");

    class Retangulo extends Forma{
        private $altura;
        private $base;

        public function __construct($id, $cor, $tabuleiro_id, $altura, $base) {
            parent::__construct($id, $cor, $tabuleiro_id);
            $this->setAltura($altura);
            $this->setBase($base);
        }

        //Métodos get e set
        public function getAltura(){ 
            return $this->altura; 
        }

        public function getBase() {
            return $this->base;
        }

        public function setAltura($altura){ 
            $this->altura = $altura;
        }      
        
        public function setBase($base) {
            $this->base = $base;
        }
        
        //Método toString
        public function __toString() {
            $str = parent::__toString();
            $str .= "<br>[Retângulo]".
                    "<br>Altura: ".$this->getAltura().
                    "<br>Base: ".$this->getBase().
                    "<br>Cor: ".$this->getCor().
                    "<br>Área: ".round($this->area(),2).
                    "<br>Perímetro: ".round($this->perimetro(),2).
                    "<br>Diagonal: ".round($this->diagonal(),2);
            return $str;
        }

        //CRUD
        public function create(){
            $sql = 'INSERT INTO retangulo (altura, base, cor, tabuleiro_id) 
                    VALUES(:altura, :base, :cor, :tabuleiro_id)';
            $param = array(":altura"=>$this->getaltura(), 
                                ":base"=>$this->getbase(), 
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$param);
        }

        public function update(){
            $sql = 'UPDATE retangulo 
                    SET altura = :altura, base = :base, cor = :cor, tabuleiro_id = :tabuleiro_id
                    WHERE id = :id';
            $param = array(":altura"=>$this->getaltura(),
                                ":base"=>$this->getbase(),
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_id"=>$this->getIdTabuleiro(),
                                ":id"=>$this->getId());
            return parent::comando($sql,$param);
        }

        public function delete(){
            $sql = 'DELETE FROM retangulo 
                    WHERE id = :id';
            $param = array(":id"=>$this->getId());
            return parent::comando($sql,$param);
        }

        //Métodos diversos
        public static function listar($busca = 0, $pesquisa = ""){
            $sql = "SELECT * FROM retangulo";
            if ($busca > 0)
                switch($busca){
                    case(1): $sql .= " WHERE id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(2): $sql .= " WHERE altura like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(3): $sql .= " WHERE cor like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(4): $sql .= " WHERE base like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                    case(5): $sql .= " WHERE tabuleiro_id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                }
            if ($busca > 0)
                $param = array(':pesquisa'=>$pesquisa);
            else 
                $param = array();
            return parent::consulta($sql, $param);
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM retangulo WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }

        public function area() {
            $area = $this->base * $this->altura;
            return $area;
        }

        public function perimetro() {
            $perimetro = ($this->base * 2) + ($this->altura * 2);
            return $perimetro;
        }

        public function diagonal() {
            $diagonal = sqrt(pow($this->base, 2) + pow($this->altura, 2));
            return $diagonal;
        }

        public function desenha(){
            $str = "<div style='width: ".$this->getaltura()."vh; height: ".$this->getbase()."vh; background: ".$this->getcor()."; border: 1vh solid black;'></div><br>";
            return $str;
        }
    }
?>