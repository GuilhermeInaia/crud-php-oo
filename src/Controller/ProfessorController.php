<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProfessorRepository;

class ProfessorController extends AbstractController
{
    public function listar(): void // void não dará o retorno apenas redirecionamento das views
    {
        $repository = new ProfessorRepository();

        $professores = $repository->buscarTodos();

        $this->render('professor/listar', [
            'professores' => $professores,
        ]);
    }

    public function cadastrar(): void
    {
        $this->render('professor/cadastrar');
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $repository = new ProfessorRepository();
        $repository->excluir($id);
        $this->redirect("professor/listar");
    }
    public function editar(): void
    {
        $this->render('professor/editar');
    }
}
