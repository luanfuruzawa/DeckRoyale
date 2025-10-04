<?php
class Usuario
{
    private int $id;
    private string $email;
    private string $nome;
    private string $senha;

    private string $perfil;

    public function __construct(int $id, string $email, string $senha, string $nome, string $perfil)
    {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->perfil = $perfil;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }
    public function getNome(): string
    {
        return $this->nome;
    }
    public function getPerfil(): string
    {
        return $this->perfil;
    }
}
?>