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
        return new Usuario((int) $dados['id'], $dados['email'], $dados['senha'], $dados['nome'], $dados['perfil']);
    }

    public function buscarPorId(string $id): ?Usuario
    {
        $sql = "SELECT id, email, senha, nome, perfil FROM usuario WHERE id = ?";
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

    public function alterar(Usuario $usuario): void
    {
        $sql = "UPDATE usuario SET email = ?, nome = ?, perfil = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $usuario->getEmail());
        $stmt->bindValue(2, $usuario->getNome());
        $stmt->bindValue(3, $usuario->getPerfil());
        $stmt->bindValue(4, $usuario->getId(), PDO::PARAM_INT);
        $stmt->execute();
    }
    public function deletar(string $id): bool
    {
        $st = $this->pdo->prepare("DELETE FROM usuario WHERE id=?");
        return $st->execute([$id]);
    }
}

?>