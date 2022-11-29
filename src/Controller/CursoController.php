<?php

declare(strict_types=1);
namespace App\Controller;
use App\Model\Curso;
use App\Repository\CursoRepository;
use Dompdf\Dompdf;
use Exception;


class CursoController extends AbstractController
{
    private CursoRepository $repository;

    public function __construct()
    {
        $this->repository = new CursoRepository();
    }

    public function listar(): void 
    {
        //$repository = new CursoRepository();
        $cursos = $this->repository->buscarTodos();
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

        //$repository = new CursoRepository();
        try {
            $this->repository->inserir($curso);
        } catch (Exception) {
           
        }
        $this->redirect('/cursos/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        //$repository = new CursoRepository();
        $curso = $this->repository->buscarUm($id);
        $this->render('curso/editar', [$curso]);

        if (false === empty($_POST)) {
            $curso->nome = $_POST['nome'];
            $curso->cargaHoraria = $_POST['horario'];
            $curso->descricao = $_POST['descricao'];
            
            try{
                $this->repository->atualizar($curso, $id);
            } catch(Exception $exception) {

            }
            $this->redirect('/cursos/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        //$repository = new CursoRepository();
        $this->repository->excluir($id);
        $this->redirect("\cursos\listar");
    }

    private function redirecionar(iterable $cursos){
        $resultado = '';
        foreach ($cursos as $curso) {
        $resultado .= "
            <tr>
                <td>{$curso->id}</td>
                <td>{$curso->nome}</td>
                <td>{$curso->cargaHoraria}</td>
                <td>{$curso->descricao}</td>
                <td>{$curso->status}</td>
            </tr>";
            }
            return $resultado;
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');
        $curso = $this->repository->buscarTodos();
        $design = "
        <h1>Relatorio de Cursos</h1>
        <hr>
        <em>Gerando em {$hoje}</em>
        <hr>
        <table border='1' width='100%' style='margin-top: 30px;'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Carga Horaria</th>
                    <th>Descrição</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            ".$this->redirecionar($curso)."
            </tbody>
        </table>
        ";

        $dompdf = new Dompdf();
        $dompdf->loadHtml(($design)); 
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->render();
        $dompdf->stream('Relatorio-Cursos.pdf', ['Attachment' => 0]); 
    }
}
