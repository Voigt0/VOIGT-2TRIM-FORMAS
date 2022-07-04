<?php
    include_once ("../utils/autoload.php");

    class Cubo extends Quadrado{
        private $id;
        private $cor;

        public function __construct($id, $quadrado_id, $tabuleiro_id, $lado, $cor) {
            parent::__construct($quadrado_id, '', $tabuleiro_id, $lado);
            $this->setCuboId($id);
            $this->setCor($cor);
        }

        //Métodos Get e Set
        public function getCuboId() { 
            return $this->id; 
        }
        
        public function getCor() {
            return $this->cor;
        }
        
        public function setCuboId($id) { 
            $this->id = $id;
        }

        public function setCor($cor) {
            if (strlen($cor) > 0)    
                $this->cor = $cor;
        }

        //Método toString
        public function __toString() {
            $str = parent::__toString();
            $str .= "<br><br>[Cubo]".
                    "<br>ID do Quadrado: ".$this->getCuboId().
                    "<br>ID do Cubo: ".$this->getId().
                    "<br>Cor: ".$this->getCor().
                    "<br>Área do cubo: ".round($this->cuboArea(),2)." metros²".
                    "<br>Perimetro do cubo: ".round($this->cuboPerimetro(),2).
                    "<br>Diagonal do cubo: ".round($this->cuboDiagonal(),2).
                    "<br>Volume do cubo: ".round($this->cuboVolume(),2);
            return $str;
        }

        
        //CRUD
        public function create(){
            $sql = 'INSERT INTO cubo (cor, quadrado_id, tabuleiro_id) 
                    VALUES(:cor, :quadrado_id, :tabuleiro_id)';
            $params = array(":cor"=>$this->getCor(), 
                            ":quadrado_id"=>$this->getId(),
                            ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$params);
        }
        
        public function update(){
            $sql = 'UPDATE cubo 
                    SET cor = :cor, quadrado_id = :quadrado_id, tabuleiro_id = :tabuleiro_id
                    WHERE id = :id';
            $params = array(":cor"=>$this->getCor(),
                            ":quadrado_id"=>$this->getId(),
                            ":tabuleiro_id"=>$this->getIdTabuleiro(),
                            ":id"=>$this->getCuboId());
            return parent::comando($sql,$params);
        }
        
        public function delete(){
            $sql = 'DELETE FROM cubo 
                    WHERE id = :id';
            $params = array(":id"=>$this->getCuboId());
            return parent::comando($sql,$params);
        }
        
        //Métodos diversos
        public static function listar($busca = 0, $pesquisa = ""){
            $sql = "SELECT cubo.id, cubo.quadrado_id, cubo.tabuleiro_id, cubo.cor, quadrado.lado FROM quadrado, cubo
                    WHERE cubo.quadrado_id = quadrado.id";
            if ($busca > 0)
            switch($busca){
                case(1): $sql .= " AND cubo.id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                case(2): $sql .= " AND cubo.cor like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
                case(3): $sql .= " AND quadrado_id like :pesquisa"; $pesquisa = "%".$pesquisa."%"; break;
            }
            if ($busca > 0)
            $params = array(':pesquisa'=>$pesquisa);
            else 
            $params = array();
            return parent::consulta($sql, $params);
        }
        
        public function cuboArea() {
            $area = 6 * pow($this->getLado(),2);
            return $area;
        }

        public function cuboPerimetro() {
            $perimetro = $this->getLado() * 12;
            return $perimetro;
        }

        public function cuboDiagonal() {
            $diagonal = $this->getLado() * sqrt(3);
            return $diagonal;
        }

        public function cuboVolume() {
            $volume = pow($this->getLado(),3);
            return $volume;
        }

        public function divisao(){
            return $this->getLado() / 2;
        }
        
        public function magica(){
            return $this->getLado() / 3;
        }

        public function desenha(){
            $str = "<br>
                    <br>
                    <style>                        
                        .face--front {transform: translateZ(".$this->divisao()."vh);}
                        .face--right {transform: rotateY(90deg) translateZ(".$this->divisao()."vh);}
                        .face--back {transform: rotateY(180deg) translateZ(".$this->divisao()."vh);}
                        .face--left {transform: rotateY(-90deg) translateZ(".$this->divisao()."vh);}
                        .face--top {transform: rotateX(90deg) translateZ(".$this->divisao()."vh);}
                        .face--bottom {transform: rotateX(-90deg) translateZ(".$this->divisao()."vh);}
                        @keyframes rotate {
                            from {transform: rotateX(-20deg) rotateY(-10deg);}
                            50% {transform: rotateX(20deg) rotateY(320deg);}
                            to {transform: rotateX(-20deg) rotateY(-20deg);}
                        }
                    </style>
                    <div style='width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; animation: rotate 5s infinite alternate; transform-style: preserve-3d;' class='cube'>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--front'></div>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--right'></div>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--back'></div>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--left'></div>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--top'></div>
                        <div style='background-color: ".$this->getCor()."; border: 1vh black solid; width: ".$this->getLado()."vh; height: ".$this->getLado()."vh; position: absolute;' class='face--bottom'></div>
                    </div>";
            return $str;
        }

        public static function consultarData($id) {
            $sql= "SELECT * FROM cubo WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>