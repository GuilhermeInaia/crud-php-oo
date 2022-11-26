<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DataBaseConnection;
use App\Model\Professor;
use PDO;

class ProfessorRepository implements RepositoryInterface
{
    public const TABLE = 'tb_professores';

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = DataBaseConnection::abrirConexao();
    }

    public function buscarTodos(): iterable
    {
        $sql = 'SELECT *FROM ' .  self::TABLE;

        $query = $this->pdo->query($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Professor::class);
    }

    public function buscarUm(string $id): object
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchObject(Professor::class);
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE . "(nome, endereco, formacao, status, cpf) " .
            "VALUE ('{$dados->nome}', '{$dados->endereco}','{$dados->formacao}', '1', '{$dados->cpf}');";

        $this->pdo->query($sql);
        return $dados;
    }

    public function atualizar(object $novoDados, string $id): object
    {
        $sql = "UPDATE " . self::TABLE .
        "SET
            nome='{$novoDados->nome}',
            endereco='{$novoDados->endereco}',
            formacao='{$novoDados->formacao}',
            cpf='{$novoDados->cpf}' WHERE id = '{$id}'; ";

        $this->pdo->query($sql);

        return $novoDados;
    }

    public function excluir(string $id): void
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
    }
}
