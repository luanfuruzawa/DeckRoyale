<?php
    class CartaRepositorio
    {
        private PDO $pdo;

        public function __construct(PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        private function formarObjeto(array $dados): Carta
        {
            return new Carta($dados['id'], (int)$dados['custo'], $dados['srcImagem'], $dados['raridade']);
        }

        public function buscarPorId(string $id): ?Carta
        {
            $sql = "SELECT id, custo, srcImagem, raridade FROM carta WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $dados = $stmt->fetch();
            return $dados ? $this->formarObjeto($dados): null ;
        }

        public function autenticar(string $id, string $caminhoCarta):bool
        {   
        $carta = $this->buscarPorId($id);
        return $carta ? password_verify($caminhoCarta, $carta->getCaminhoCarta()) : false;

        }

        public function salvar(Carta $carta): void
        {
            $sql = "INSERT INTO carta (id, custo, srcImagem, raridade) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $carta->getId());
            $stmt->bindValue(2, $carta->getCustoCarta());
            $stmt->bindValue(3, $carta->getCaminhoCarta());
            $stmt->bindValue(4, $carta->getRaridadeCarta());
            $stmt->execute();
        }
    }

?>