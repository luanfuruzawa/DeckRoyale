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
            return new Usuario((int)$dados['id'], $dados['email'], $dados['senha'], $dados['nome'], $dados['perfil']);
        }

        public function buscarPorId(string $id): ?Usuario
        {
            $sql = "SELECT id, email, senha, nome, perfil FROM usuario WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();
            $dados = $stmt->fetch();
            return $dados ? $this->formarObjeto($dados): null ;
        }

        public function autenticar(string $email, string $senha):bool
        {   
        $usuario = $this->buscarPorId($id);
        return $usuario ? password_verify($senha, $usuario->getSenha()) : false;

        }

        public function alterar(Usuario $usuario): void
        {
            $sql = "UPDATE usuario SET email = ?, senha = ?, nome = ?, perfil = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $usuario->getEmail());
            $stmt->bindValue(2, password_hash($usuario->getSenha(),PASSWORD_DEFAULT));
            $stmt->bindValue(3, $usuario->getNome());
            $stmt->bindValue(4, $usuario->getPerfil());
            $stmt->execute();
        }
    }

?>