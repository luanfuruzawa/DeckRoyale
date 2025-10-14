<?php
class UsuarioRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto(array $dados): Usuario
    {
        return new Usuario((int) $dados['id'],  $dados['email'], $dados['perfil'], $dados['nome'], $dados['senha'] );
    }

    public function buscarPorId(string $id): ?Usuario
    {
        $sql = "SELECT id, email, perfil, nome, senha FROM usuario WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $dados = $stmt->fetch();
        return $dados ? $this->formarObjeto($dados) : null;
    }

    public function autenticar(string $id, string $senha): bool
    {
        $usuario = $this->buscarPorId($id);
        return $usuario ? password_verify($senha, $usuario->getSenha()) : false;

    }
    public function buscarTodos(): array
    {
        $sql = "SELECT id,email,perfil,nome,senha FROM usuario ORDER BY id";
        $rs = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($r) => $this->formarObjeto($r), $rs);
    }
    public function contarTodos()
    {
        $sql = "SELECT COUNT(*) FROM usuario"; 
        $stmt = $this->pdo->query($sql);
        return (int) $stmt->fetchColumn();
    }

  public function buscarPaginado(int $limite, int $offset): array
{
    $sql = "SELECT id, email, perfil, nome, senha FROM usuario LIMIT :limite OFFSET :offset";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return array_map(fn($dados) => $this->formarObjeto($dados), $resultados);
}

}

?>