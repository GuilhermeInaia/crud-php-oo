<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Professor;
use App\Repository\ProfessorRepository;
use Exception;

class ProfessorController extends AbstractController
{
    public function listar(): void 
    {
        $repository = new ProfessorRepository();

        $professores = $repository->buscarTodos();

        $this->render('professor/listar', [
            'professores' => $professores,
        ]);
    }

    public function cadastrar(): void
    {
        if (true === empty($_POST)) {
            $this->render('professor/cadastrar');
            return;
        }

        $professor = new Professor();
        $professor->nome = $_POST['nome'];
        $professor->endereco = $_POST['endereco'];
        $professor->formacao = $_POST['formacao'];
        $professor->cpf = $_POST['cpf'];

        $repository = new ProfessorRepository();

        try{
            $repository->inserir($professor);
        }catch(Exception $exception){
            if(true === str_contains($exception->getMessage(), 'cpf')){
                die('CPF já existe!');
            }
        }

        $this->redirect('/professores/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $repository = new ProfessorRepository();
        $professor = $repository->buscarUm($id);
        $this->render('professor/editar', [$professor]);

        if (false === empty($_POST)) {
            $professor->nome = $_POST['nome'];
            $professor->endereco = $_POST['endereco'];
            $professor->formacao = $_POST['formacao'];
            $professor->cpf = $_POST['cpf'];

            try{
                $repository->atualizar($professor, $id);
            } catch(Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    die('CPF já existe!');
                }

                // die('Vish, aconteceu um erro');
            }
            $this->redirect('/professores/listar');
        }
    } 

    public function excluir(): void
    {
        $id = $_GET['id'];
        $repository = new ProfessorRepository();
        $repository->excluir($id);
        $this->redirect("\professores\listar");
    }
}
