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
        return new Carta($dados['id'], (int) $dados['custo'], $dados['srcImagem'], $dados['raridade']);
    }

    public function buscarPorId(string $id): ?Carta
    {
        $sql = "SELECT id, custo, srcImagem, raridade FROM carta WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $dados = $stmt->fetch();
        return $dados ? $this->formarObjeto($dados) : null;
    }

    public function autenticar(string $id, string $caminhoCarta): bool
    {
        $carta = $this->buscarPorId($id);
        return $carta ? password_verify($caminhoCarta, $carta->getCaminhoCarta()) : false;

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