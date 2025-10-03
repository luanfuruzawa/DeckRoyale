<?php
    class Carta
    {
        private string $id;
        private int $custoCarta;
        private string $caminhoCarta; 
        private string $raridadeCarta;

        private int $custo;
        public function __construct(string $id, int $custoCarta, string $caminhoCarta, string $raridadeCarta){
            $this->id = $id;
            $this->custoCarta = $custoCarta;
            $this->raridadeCarta = $raridadeCarta;
            $this->caminhoCarta = $caminhoCarta;
        }

        public function getId(): string
        {
            return $this->id;
        }

        public function getCustoCarta(): int
        {
            return $this->custoCarta;
        }
        public function getRaridadeCarta(): string
        {
            return $this->raridadeCarta;
        }
        public function getCaminhoCarta(): string
        {
            return $this->caminhoCarta;
        }
    
    }
?>