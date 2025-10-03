<?php
    class Usuario
    {
        private string $id;
        private int $custoCarta;
        private string $img; 
        private string $raridadeCarta;

        //Método construtor
        public function __construct(string $id, int $custoCarta, string $img, string $raridadeCarta){
            $this->id = $id;
            $this->tipoCarta = $tipoCarta;
            $this->raridadeCarta = $raridadeCarta;
        }

        public function getId(): string
        {
            return $this->id;
        }

        public function getCustoCarta(): int
        {
            return $this->custoCarta;
        }

        public function getImg(): string
        {
            return $this->img;
        }

        public function getRaridadeCarta(): string
        {
            return $this->raridadeCarta;
        }
    }
?>