<?php
class Paginacao
{
    //-video e documentos que ensinam a fazer paginação
    //https://www.youtube.com/watch?v=l-088_BJbcc - video
    //https://www.php.net/manual/pt_BR/control-structures.foreach.php?utm_source=chatgpt.com -foreach
    //https://gist.github.com/Stichoza/4046200?utm_source=chatgpt.com -exemplo paginação github
    //https://gist.github.com/whalesalad/302325?utm_source=chatgpt.com -classe de paginação exemplo
    private int $totalItens;
    private int $itensPorPagina;
    private int $paginaAtual;

    public function __construct(int $totalItens, int $itensPorPagina, int $paginaAtual)
    {
        $this->totalItens = $totalItens;
        $this->itensPorPagina = $itensPorPagina;
        $this->paginaAtual = max(1, $paginaAtual); 
    }

    public function getOffset(): int
    {
        return ($this->paginaAtual - 1) * $this->itensPorPagina;
    }

    public function getLimite(): int
    {
        return $this->itensPorPagina;
    }

    public function getTotalPaginas(): int
    {
        return (int) ceil($this->totalItens / $this->itensPorPagina);
    }

    public function getPaginaAtual(): int
    {
        return $this->paginaAtual;
    }
}
?>