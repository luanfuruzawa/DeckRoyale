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
        public function alterar(Carta $carta): void
        {
            $sql = "UPDATE carta SET custo = ?, srcImagem = ?, raridade = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $carta->getCustoCarta());
            $stmt->bindValue(2, $carta->getCaminhoCarta());
            $stmt->bindValue(3, $carta->getRaridadeCarta());
            $stmt->bindValue(4, $carta->getId());
            $stmt->execute();
        }   
        public function deletar(string $id): bool
    {
        $st = $this->pdo->prepare("DELETE FROM carta WHERE id=?");
        return $st->execute([$id]);
    }

    }

?>