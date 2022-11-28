<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Aluno;
use App\Repository\AlunoRepository;
use Dompdf\Dompdf;
use Exception;

class AlunoController extends AbstractController
{
    public function listar(): void // void não dará o retorno apenas redirecionamento das views
    {
        $repository = new AlunoRepository();

        $alunos = $repository->buscarTodos();

        $this->render('aluno/listar', [
            'alunos' => $alunos,
        ]);
    }

    public function cadastrar(): void
    {
        if (true === empty($_POST)) {
            $this->render('aluno/cadastrar');
            return;
        }

        $aluno = new Aluno();
        $aluno->nome = $_POST['nome'];
        $aluno->dataNascimento = $_POST['nascimento'];
        $aluno->cpf = $_POST['cpf'];
        $aluno->email = $_POST['email'];
        $aluno->genero = $_POST['genero'];

        $repository = new AlunoRepository();

        try {
            $repository->inserir($aluno);
        } catch (Exception $exception) {
            if (true === str_contains($exception->getMessage(), 'cpf')) {
                die('CPf já existe!');
            }

            if (true === str_contains($exception->getMessage(), 'email')) {
                die('Email já existe!');
            }

            // die('Aconteceu um erro que não sei');
        }

        $this->redirect('/alunos/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $repository = new AlunoRepository();
        $aluno = $repository->buscarUm($id);
        $this->render('aluno/editar', [$aluno]);

        if (false === empty($_POST)) {
            $aluno->nome = $_POST['nome'];
            $aluno->dataNascimento = $_POST['nascimento'];
            $aluno->cpf = $_POST['cpf'];
            $aluno->email = $_POST['email'];
            $aluno->genero = $_POST['genero'];
            
            try{
                $repository->atualizar($aluno, $id);
            } catch(Exception $exception) {
                if (true === str_contains($exception->getMessage(), 'cpf')) {
                    die('CPF já existe!');
                }

                if (true === str_contains($exception->getMessage(), 'email')) {
                    die('Email já existe!');
                }

                // die('Vish, aconteceu um erro');
            }
            $this->redirect('/alunos/listar');
        }
    }

    public function excluir(): void
    {
        //$this->render('aluno/excluir');
        $id = $_GET['id'];
        $repository = new AlunoRepository();
        $repository->excluir($id);
        $this->redirect("\alunos\listar");
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');
        $desing = "
        <h1>Relatorio de Alunos</h1>
        <hr>
        <em>Gerando em {$hoje}</em>
        <hr>"; 

        $dompdf = new Dompdf();
        $dompdf->loadHtml($desing); // carrega o conteudo do PDF
        $dompdf->setPaper('A4', 'portrait'); // tamanho da pagina
        $dompdf->render(); // aqui renderiza
        $dompdf->stream(); // é aqui que a magica acontece
    }
    
}