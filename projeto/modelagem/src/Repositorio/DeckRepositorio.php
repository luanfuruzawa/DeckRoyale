<?php

class DeckRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto(array $dados): Deck
    {
        return new Deck((int) $dados['id'], $dados['nome'], isset($dados['id_usuario']) ? (int)$dados['id_usuario'] : null);
    }

    public function salvar(Deck $deck): void
    {

        $sql = "INSERT INTO deck (nome, id_usuario) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $deck->getNome());
        $stmt->bindValue(2, $deck->getUsuarioId(), PDO::PARAM_INT);
        $stmt->execute();

        $deck->setId((int) $this->pdo->lastInsertId());
    }

    public function alterar(Deck $deck): void
    {
        $sql = "UPDATE deck SET nome = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $deck->getNome());
        $stmt->bindValue(2, $deck->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deletar(int $id): bool
    { 
        $sql1 = "DELETE FROM deckCarta WHERE id_deck = ?";
        $stmt1 = $this->pdo->prepare($sql1);
        $stmt1->execute([$id]);
 
        $sql2 = "DELETE FROM deck WHERE id = ?";
        $stmt2 = $this->pdo->prepare($sql2);
        return $stmt2->execute([$id]);
    }

    public function buscarTodos(): array
    {
        $sql = "SELECT id, nome, id_usuario FROM deck ORDER BY nome";
        $rs = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($dados) => $this->formarObjeto($dados), $rs);
    }

    public function buscarPorNome(string $nome): array
    {
        $sql = "SELECT id, nome, id_usuario FROM deck WHERE nome LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, '%' . $nome . '%');
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($dados) => $this->formarObjeto($dados), $resultados);
    }

    public function adicionarCarta(int $deckId, string $cartaId): void
    {
        $sql = "INSERT INTO deckCarta (id_deck, id_carta) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deckId, $cartaId]);
    }

    public function buscarCartasDoDeck(int $deckId): array
    {
        $sql = "SELECT c.id, c.nome, c.tipo, c.custo, c.imagem FROM deckCarta dc JOIN carta c ON dc.id_carta = c.id WHERE dc.id_deck = ? ORDER BY c.nome";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deckId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Novo: buscar por id
    public function buscarPorId(int $id): ?Deck
    {
        $sql = "SELECT id, nome, id_usuario FROM deck WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados === false) {
            return null;
        }

        return $this->formarObjeto($dados);
    }
}