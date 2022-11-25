<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DataBaseConnection;
use App\Model\Aluno;
use PDO;

class AlunoRepository implements RepositoryInterface
{
    public const TABLE = 'tb_alunos';

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = DataBaseConnection::abrirConexao();
    }

    public function buscarTodos(): iterable
    {
        $sql = 'SELECT * FROM ' . self::TABLE;

        // preparando para executar no banco de dados
        $query = $this->pdo->query($sql);

        $query->execute(); // executando o comando lá no banco de dados

        return $query->fetchAll(PDO::FETCH_CLASS, Aluno::class); // pegando os dados do banco e transformando em array
    }

    public function buscarUm(string $id): object
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchObject(Aluno::class);
    }

    public function inserir(object $dados): object
    {


        $matricula = date('YmDs') . substr($dados->cpf, -2);

        $sql = "INSERT INTO " . self::TABLE . "(nome, matricula, email, status, genero, dataNascimento, cpf) " .
            "VALUE ('{$dados->nome}', '{$matricula}', '{$dados->email}', '1', '{$dados->genero}', '{$dados->dataNascimento}', '{$dados->cpf}');";
        $this->pdo->query($sql);
        return $dados;
    }

    public function atualizar(object $novoDados, string $id): object
    {
        return $novoDados;
    }

    public function excluir(string $id): void
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
    }
}
