<?php
    include_once ("../utils/autoload.php");

    class Icosaedro extends Forma{
        private $lado;

        public function __construct($id, $cor, $tabuleiro_id, $lado) {
            parent::__construct($id, $cor, $tabuleiro_id);
            $this->setLado($lado);
        }

        //Métodos Get e Set
        public function getLado(){ 
            return $this->lado; 
        }

        public function setLado($lado){ 
            $this->lado = $lado;
        }      
        
        //Método toString
        public function __toString() {
            $str = parent::__toString();
            $str .=  "<br>[Icosaedro]".
                    "<br>Lado: ".$this->getLado().
                    "<br>Área: ".$this->area().
                    "<br>Perímetro: ".$this->perimetro();
            return $str;
        }

        public function create(){
            $sql = 'INSERT INTO icosaedro (lado, cor, tabuleiro_id) 
                    VALUES(:lado, :cor, :tabuleiro_id)';
            $parametros = array(":lado"=>$this->getLado(),
                                ":cor"=>$this->getCor(), 
                                ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$parametros);
        }
        
        public function update(){
            $sql = 'UPDATE icosaedro 
                    SET lado = :lado, cor = :cor, tabuleiro_id = :tabuleiro_id
                    WHERE id = :id';
            $parametros = array(":lado"=>$this->getLado(),
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_id"=>$this->getIdTabuleiro(),
                                ":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }
        
        public function delete(){
            $sql = 'DELETE FROM icosaedro 
                    WHERE id = :id';
            $parametros = array(":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }
        
        //Métodos diversos
        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM icosaedro";
            if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                case(2): $sql .= " WHERE lado like :procurar"; $procurar .="%"; break;
                case(3): $sql .= " WHERE cor like :procurar"; $procurar = "%".$procurar."%"; break;
                case(4): $sql .= " WHERE tabuleiro_id like :procurar"; $procurar = "%".$procurar."%"; break;
            }
            if ($buscar > 0)
            $parametros = array(':procurar'=>$procurar);
            else 
            $parametros = array();
            return parent::consulta($sql, $parametros);
        }

        public function area() {
            $area = 5*sqrt(3)*pow($this->getLado(), 2);
            return $area;
        }
        
        public function perimetro() {
            $perimetro = 30*$this->getLado();
            return $perimetro;
        }

        public function desenha(){
            $str = "<style>
                        .filterPixel {
                            width: ".$this->getLado()."vh;
                        }
                    </style>
                    <input hidden class='target' type='text' placeholder='target hex' value='".$this->getCor()."'/>";
            $str .= "<img class='filterPixel' src='../../img/disdyakistriacontahedron.gif' style=''>";
            return $str;
        }
        
        public static function consultarData($id) {
            $sql= "SELECT * FROM icosaedro WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>



