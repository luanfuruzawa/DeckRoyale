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

        public function buscarTodos(): array
        {
            $sql = "SELECT id,custo,srcImagem,raridade FROM carta ORDER BY id";
            $rs = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            return array_map(fn($r) => $this->formarObjeto($r), $rs);
        }
        public function contarTodos()
        {
            $sql = "SELECT COUNT(*) FROM carta"; 
            $stmt = $this->pdo->query($sql);
            return (int) $stmt->fetchColumn();
        }

        public function buscarPaginado(int $limite, int $offset): array
        {
            $sql = "SELECT id, custo, srcImagem, raridade FROM carta LIMIT :limite OFFSET :offset";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(fn($dados) => $this->formarObjeto($dados), $resultados);
        }
    }

?>