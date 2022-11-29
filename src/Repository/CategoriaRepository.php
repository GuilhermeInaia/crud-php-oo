<?php

declare(strict_types=1);

namespace App\Repository;

use App\Connection\DataBaseConnection;
use App\Model\Categoria;
use PDO;

class CategoriaRepository implements RepositoryInterface
{
    public const TABLE = 'tb_categorias';
    public PDO $pdo;
    public function __construct()
    {
        $this->pdo = DataBaseConnection::abrirConexao();
    }
    public function buscarTodos(): iterable
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, Categoria::class);
    }

    public function buscarUm(string $id): object
    {
        $sql = "SELECT * FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
        return $query->fetchObject(Categoria::class);
    }

    public function inserir(object $dados): object
    {
        $sql = "INSERT INTO " . self::TABLE . "(nome, vagas, localidade)" .
            "VALUE ('{$dados->nome}', '{$dados->vagas}', '{$dados->localidade}')";
        $this->pdo->query($sql);
        return $dados;
    }

    public function atualizar(object $novoDados, string $id): object
    {
        $sql = "UPDATE " . self::TABLE .
            " SET 
            nome = '{$novoDados->nome}',
            vagas = '{$novoDados->vagas}',
            localidade = '{$novoDados->localidade}'

        WHERE id = '{$id}';";

        return $novoDados;
    }

    public function excluir(string $id): void
    {
        $sql = "DELETE FROM " . self::TABLE . " WHERE id = '{$id}' ";
        $query = $this->pdo->query($sql);
        $query->execute();
    }
}
