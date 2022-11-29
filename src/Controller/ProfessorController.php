<?php

declare(strict_types=1);
namespace App\Controller;
use App\Model\Professor;
use App\Repository\ProfessorRepository;
use Dompdf\Dompdf;
use Exception;

class ProfessorController extends AbstractController
{
    private ProfessorRepository $repository;

    public function __construct()
    {
        $this->repository = new ProfessorRepository();
    }

    public function listar(): void 
    {
        // $repository = new ProfessorRepository();
        $professores = $this->repository->buscarTodos();

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

        //$repository = new ProfessorRepository();

        try{
            $this->repository->inserir($professor);
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
        //$repository = new ProfessorRepository();
        $professor = $this->repository->buscarUm($id);
        $this->render('professor/editar', [$professor]);

        if (false === empty($_POST)) {
            $professor->nome = $_POST['nome'];
            $professor->endereco = $_POST['endereco'];
            $professor->formacao = $_POST['formacao'];
            $professor->cpf = $_POST['cpf'];

            try{
                $this->repository->atualizar($professor, $id);
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
        //$repository = new ProfessorRepository();
        $this->repository->excluir($id);
        $this->redirect("\professores\listar");
    }

    private function redirecionar(iterable $professores){
        $resultado = '';
        foreach ($professores as $professor) {
        $resultado .= "
            <tr>
                <td>{$professor->id}</td>
                <td>{$professor->nome}</td>
                <td>{$professor->endereco}</td>
                <td>{$professor->formacao}</td>
                <td>{$professor->status}</td>
                <td>{$professor->cpf}</td>
            </tr>";
            }
            return $resultado;
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');
        $professor = $this->repository->buscarTodos();
        $design = "
        <h1>Relatorio de Professores</h1>
        <hr>
        <em>Gerando em {$hoje}</em>
        <hr>
        <table border='1' width='100%' style='margin-top: 30px;'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Formação</th>
                    <th>Status</th>
                    <th>CPF</th>
                </tr>
            </thead>
            <tbody>
            ".$this->redirecionar($professor)."
            </tbody>
        </table>
        ";

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait'); 
        $dompdf->loadHtml(($design)); 
        $dompdf->render();
        $dompdf->stream('Relatorio-Professores.pdf', ['Attachment' => 0]); 
    }
}
