<?php
    class Deck
    {
        private ?int $id;
        private string $nome;
        private ?int $usuarioId;

        public function __construct(?int $id, string $nome, ?int $usuarioId = null)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->usuarioId = $usuarioId;
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function setId(int $id): void
        {
            $this->id = $id;
        }

        public function getNome(): string
        {
            return $this->nome;
        }

        public function getUsuarioId(): ?int
        {
            return $this->usuarioId;
        }

        public function setUsuarioId(int $id): void
        {
            $this->usuarioId = $id;
        }
    }
?>