<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Curso;
use App\Repository\CursoRepository;
use Exception;
use Dompdf\Dompdf;


class CursoController extends AbstractController
{
    public function listar(): void // void não dará o retorno apenas redirecionamento das views
    {
        $repository = new CursoRepository();

        $cursos = $repository->buscarTodos();

        $this->render('curso/listar', [
            'cursos' => $cursos,
        ]);
    }

    public function cadastrar(): void
    {
        if(true === empty($_POST)){
            $this->render('curso/cadastrar');
            return;
        }

        $curso = new Curso();
        $curso->nome = $_POST['nome'];
        $curso->cargaHoraria = $_POST['horario'];
        $curso->descricao = $_POST['descricao'];

        $repository = new CursoRepository();

        try {
            $repository->inserir($curso);
        } catch (Exception) {
           
        }

        $this->redirect('/cursos/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $repository = new CursoRepository();
        $curso = $repository->buscarUm($id);
        $this->render('curso/editar', [$curso]);

        if (false === empty($_POST)) {
            $curso->nome = $_POST['nome'];
            $curso->cargaHoraria = $_POST['horario'];
            $curso->descricao = $_POST['descricao'];
        }
        $this->redirect('/cursos/listar');
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $repository = new CursoRepository();
        $repository->excluir($id);
        $this->redirect("\cursos\listar");
    }

    public function relatorio(): void
    {

        $hoje = date('d/m/Y');

        $design = "
        <h1>Relatorio de Cursos</h1>
        <hr>
        <em>Gerando em {$hoje}</em>
        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait'); 

        $dompdf->loadHtml(($design)); 

        $dompdf->render();
        $dompdf->stream(); 
    }
}
