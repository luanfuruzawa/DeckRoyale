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

        public function buscarPorEmail(string $email): ?Usuario
        {
            $sql = "SELECT id, email, senha, nome, perfil FROM usuario WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();
            $dados = $stmt->fetch();
            return $dados ? $this->formarObjeto($dados): null ;
        }

        public function autenticar(string $email, string $senha):bool
        {   
        $usuario = $this->buscarPorEmail($email);
        return $usuario ? password_verify($senha, $usuario->getSenha()) : false;

        }

        public function salvar(Usuario $usuario): void
        {
            $sql = "INSERT INTO usuario (email, senha, nome, perfil) VALUES (?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $usuario->getEmail());
            $stmt->bindValue(2, password_hash($usuario->getSenha(),PASSWORD_DEFAULT));
            $stmt->bindValue(3, $usuario->getNome());
            $stmt->bindValue(4, $usuario->getPerfil());
            $stmt->execute();
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