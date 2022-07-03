<?php
    include_once ("../utils/autoload.php");

    abstract class Forma extends Database{
        private $id;
        private $cor;
        private $tabuleiro_idtabuleiro;

        public function __construct($id, $cor, $tabuleiro_idtabuleiro) {
            $this->setId($id);
            $this->setCor($cor);
            $this->setIdTabuleiro($tabuleiro_idtabuleiro);
        }
        
        //Métodos get e set
        public function getId() {
            return $this->id;
        }
        public function getCor() {
            return $this->cor;
        }
        public function getIdTabuleiro() {
            return $this->tabuleiro_idtabuleiro;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setCor($cor) {
            $this->cor = $cor;
        }
        public function setIdTabuleiro($tabuleiro_idtabuleiro) {
            $this->tabuleiro_idtabuleiro = $tabuleiro_idtabuleiro;
        }

        //Método toString
        public function __toString() {
            return  "<br>[Forma]".
                    "<br>Id: ".$this->getId().
                    "<br>Cor: <div style='width:10vw; background-color: ".$this->getCor().";'>".$this->getCor()."</div>".
                    "Id Tabuleiro: ".$this->getIdTabuleiro()."<br>";
        }

        public abstract function desenha();
        public abstract function area();
        public abstract function create();
        public abstract function update();
        public abstract function delete();
        public abstract static function listar($buscar = 0, $procurar = "");

    }
?>