<?php
    include_once ("../utils/autoload.php");

    class Triangulo extends Forma{
        private $lado1;
        private $lado2;
        private $lado3;

        public function __construct($id, $cor, $tabuleiro_id, $lado1, $lado2, $lado3) {
            parent::__construct($id, $cor, $tabuleiro_id);
            $this->setLado1($lado1);
            $this->setLado2($lado2);
            $this->setLado3($lado3);
        }

        //Métodos Get e Set
        public function getLado1(){ 
            return $this->lado1; 
        }

        public function getLado2(){ 
            return $this->lado2; 
        }
        
        public function getLado3() {
            return $this->lado3;
        }

        public function setLado1($lado1){ 
            $this->lado1 = $lado1;
        }      
        
        public function setLado2($lado2){ 
            $this->lado2 = $lado2;
        }

        public function setLado3($lado3) {
            $this->lado3 = $lado3;
        }

        //Método toString
        public function __toString() {
            $str = parent::__toString();
            $str .=  "<br>[Triângulo]".
                    "<br>Lado 1: ".$this->getLado1().
                    "<br>Lado 2: ".$this->getLado2().
                    "<br>Lado 3: ".$this->getLado3().
                    "<br>Cor: ".$this->getcor().
                    "<br>Área: ".$this->Area().
                    "<br>Perímetro: ".$this->Perimetro().
                    "<br>Ângulo Alpha: ".round(rad2deg($this->Alpha()),2)."°".
                    "<br>Ângulo Beta: ".round(rad2deg($this->Beta()),2)."°".
                    "<br>Ângulo Gamma: ".round(rad2deg($this->Gamma()),2)."°".
                    "<br>Tipo: ".$this->tipo();
            return $str;
        }

        public function create(){
            $sql = 'INSERT INTO triangulo (lado1, lado2, lado3, cor, tabuleiro_id) 
                    VALUES(:lado1, :lado2, :lado3, :cor, :tabuleiro_id)';
            $parametros = array(":lado1"=>$this->getLado1(),
                                ":lado2"=>$this->getLado2(),
                                ":lado3"=>$this->getLado3(), 
                                ":cor"=>$this->getCor(), 
                                ":tabuleiro_id"=>$this->getIdTabuleiro());
            return parent::comando($sql,$parametros);
        }
        
        public function update(){
            $sql = 'UPDATE triangulo 
                    SET lado1 = :lado1, lado2 = :lado2, lado3 = :lado3, cor = :cor, tabuleiro_id = :tabuleiro_id
                    WHERE id = :id';
            $parametros = array(":lado1"=>$this->getLado1(),
                                ":lado2"=>$this->getLado2(),
                                ":lado3"=>$this->getLado3(),
                                ":cor"=>$this->getCor(),
                                ":tabuleiro_id"=>$this->getIdTabuleiro(),
                                ":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }
        
        public function delete(){
            $sql = 'DELETE FROM triangulo 
                    WHERE id = :id';
            $parametros = array(":id"=>$this->getId());
            return parent::comando($sql,$parametros);
        }
        
        //Métodos diversos
        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM triangulo";
            if ($buscar > 0)
            switch($buscar){
                case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                case(2): $sql .= " WHERE lado1 like :procurar"; $procurar .="%"; break;
                case(3): $sql .= " WHERE cor like :procurar"; $procurar = "%".$procurar."%"; break;
                case(4): $sql .= " WHERE tabuleiro_id like :procurar"; $procurar = "%".$procurar."%"; break;
            }
            if ($buscar > 0)
            $parametros = array(':procurar'=>$procurar);
            else 
            $parametros = array();
            return parent::consulta($sql, $parametros);
        }
        
        public function tipo(){
            if($this->getLado1() == $this->getLado2() && $this->getLado2() == $this->getLado3()){
                return "equilátero";
            }elseif($this->getLado1() == $this->getLado2() || $this->getLado1() == $this->getLado3() || $this->getLado2() == $this->getLado3()){
                return "isóceles";
            }else{
                return "escaleno";
            }
        }

        public function area() {
            $area = sqrt(($this->lado1+$this->lado2+$this->lado3)*(-$this->lado1+$this->lado2+$this->lado3)*($this->lado1-$this->lado2+$this->lado3)*($this->lado1+$this->lado2-$this->lado3))/4;
            return $area;
        }
        
        public function perimetro() {
            $perimetro = $this->lado1 + $this->lado2 + $this->lado3;
            return $perimetro;
        }

        public function alpha() {
            $alpha = acos((pow($this->lado2, 2)+pow($this->lado3, 2)-pow($this->lado1, 2))/(2*$this->lado2*$this->lado3));
            return $alpha;
        }

        public function beta() {
            $beta = acos((pow($this->lado1, 2)+pow($this->lado3, 2)-pow($this->lado2, 2))/(2*$this->lado1*$this->lado3));
            return $beta;
        }

        public function gamma() {
            $gamma = acos((pow($this->lado1, 2)+pow($this->lado2, 2)-pow($this->lado3, 2))/(2*$this->lado1*$this->lado2));
            return $gamma;
        }

        public function desenha(){
            $str = "<div style='width: 0vh; height: 0vh; border-left: ".$this->lado1."vh solid transparent; border-right: ".$this->lado2."vh solid transparent;border-bottom: ".$this->lado3."vh solid ".parent::getCor().";'></div><br>";
            return $str;
        }
        
        public static function consultarData($id) {
            $sql= "SELECT * FROM triangulo WHERE id = :id;";
            $params = array(":id"=>$id);
            return parent::consulta($sql, $params);
        }
    }
?>



