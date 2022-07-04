<?php
    include_once ("../utils/autoload.php");

    class Esfera extends Circulo{
        private $id;
        private $cor;

        public function __construct($id, $circulo_id, $tabuleiro_id, $raio, $cor) {
            parent::__construct($circulo_id, '', $tabuleiro_id, $raio);
            $this->setEsferaId($id);
            $this->setCor($cor);
        }

        //Métodos Get e Set
        public function getEsferaId() { 
            return $this->id; 
        }
        
        public function getCor() {
            return $this->cor;
        }
        
        public function setEsferaId($id) { 
            $this->id = $id;
        }

        public function setCor($cor) {
            if (strlen($cor) > 0)    
                $this->cor = $cor;
        }

        //Método toString
        public function __toString() {
            $str = parent::__toString();
            $str .= "<br><br>[Esfera]".
                    "<br>ID do círculo: ".$this->getEsferaId().
                    "<br>ID da esfera: ".$this->getId().
                    "<br>Cor: ".$this->getCor().
                    "<br>Área da esfera: ".round($this->esferaArea(),2)." metros²".
                    "<br>Perimetro da esfera: ".round($this->esferaPerimetro(),2).
                    "<br>Volume da esfera: ".round($this->esferaVolume(),2);
            return $str;
        }

        
        //CRUD
        public function create(){
            $sql = 'INSERT INTO esfera (cor, circulo_id, tabuleiro_id) 
                    VALUES(:cor, :circulo_id, :tabuleiro_id)';
            $params = array(":cor"=>$this->getCor(), 
                            ":circulo_id"=>$this->getId(),
                            ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$params);
        }
        
        public function update(){
            $sql = 'UPDATE esfera 
                    SET cor = :cor, circulo_id = :circulo_id, tabuleiro_id = :tabuleiro_id
                    WHERE id = :id';
            $params = array(":cor"=>$this->getCor(),
                            ":circulo_id"=>$this->getId(),
                            ":tabuleiro_id"=>$this->getIdTabuleiro(),
                            ":id"=>$this->getEsferaId());
            return parent::comando($sql,$params);
        }
        
        public function delete(){
            $sql = 'DELETE FROM esfera 
                    WHERE id = :id';
            $params = array(":id"=>$this->getEsferaId());
            return parent::comando($sql, $params);
        }
        
        //Métodos diversos
        public static function listar($busca = 0, $pesquisa = ""){
            $sql = "SELECT esfera.id, esfera.circulo_id, esfera.tabuleiro_id, esfera.cor, circulo.raio FROM circulo, esfera
                    WHERE esfera.circulo_id = circulo.id";
            if ($busca > 0)
            switch($busca){
                case(1): $sql .= " AND esfera.id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                case(2): $sql .= " AND esfera.cor like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                case(3): $sql .= " AND circulo_id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
            }
            if ($busca > 0)
            $params = array(':pesquisa'=>$pesquisa);
            else 
            $params = array();
            return parent::consulta($sql, $params);
        }
        
        public function esferaArea() {
            $area = 4*pi()*pow($this->getRaio(), 2);
            return $area;
        }

        public function esferaPerimetro() {
            $perimetro = 2 * pi() * $this->getRaio();
            return $perimetro;
        }

        public function esferaDiametro() {
            $diametro = 2 * $this->getRaio();
            return $diametro;
        }

        public function esferaVolume() {
            $volume = 4 * pi() * pow($this->getRaio(), 3);
            return $volume;
        }

        public function desenha(){
            $str = "<br>
                    <br>
                    <style>                        
                      @keyframes turn {
                        0%, 100% {background-position: 20% 70%;}
                        50% {background-position: 80% 70%;}
                      }
                      @keyframes move-shadow {
                        0%, 
                        100% {margin-left: 5px;}
                        50% {margin-left: 15px;}
                      }
                    </style>
                    <div style='width: ".$this->esferaDiametro()."px;
                                height: ".$this->esferaDiametro()."px;
                                border-radius: 50%;
                                background: radial-gradient(#e0e0e0, ".$this->getCor().", #000000);
                                background-size: 250% 250%;
                                animation: turn 3s ease-out 0s infinite;
                                z-index: 10;
                                position: relative;'></div>
                    <div style='z-index: 1;
                                position: relative;
                                margin-top: -35px;
                                width: ".$this->esferaDiametro()."px;
                                height: 50px;
                                background: radial-gradient(#000f, #fff0 75%);
                                border-radius: 50%;
                                animation: move-shadow 3s ease-out 0s infinite;'></div>";
            return $str;
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM esfera WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>