<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DataBaseConnection;

class CursoRepository implements RepositoryInterface
{
    public function buscarTodos(): iterable
    {
        $conexao = DataBaseConnection::abrirConexao();

        $sql = 'SELECT * FROM tb_alunos';

        // preparando para executar no banco de dados
        $query = $conexao->query($sql);

        $query->execute(); // executando o comando lá no banco de dados

        return $query->fetchAll(); // pegando os dados do banco e transformando em array
    }

    public function buscarUm(string $id): ?object
    {
        return new \stdClass;
    }

    public function inserir(object $dados): object
    {
        return $dados;
    }

    public function atualizar(object $novoDados, string $id): object
    {
        return $novoDados;
    }

    public function excluir(string $id): void
    {
    }
}
