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
            return new Carta($dados['id'], (int)$dados['custoCarta'], $dados['img'], $dados['raridadeCarta']);
        }

        public function buscarPorId(string $id): ?Carta
        {
            $sql = "SELECT id, custo_carta, img, raridade_carta FROM tb_carta WHERE id =?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $dados = $stmt->fetch();
            return $dados ? $this->formarObjeto($dados): null ;
        }

        public function salvar(Carta $carta): void
        {
            $sql = "INSERT INTO tb_carta (id, custo_carta, img, raridade_carta) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $carta->getId());
            $stmt->bindValue(2, $carta->getCustoCarta());
            $stmt->bindValue(3, $carta->getImg());
            $stmt->bindValue(4, $carta->getRaridadeCarta());
            $stmt->execute();
        }
    }

?>