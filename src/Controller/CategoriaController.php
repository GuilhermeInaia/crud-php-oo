<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Categoria;
use App\Repository\CategoriaRepository;
use Exception;
use Dompdf\Dompdf;

class CategoriaController extends AbstractController
{
    public function listar(): void
    {
        $repository = new CategoriaRepository();
        $categorias = $repository->buscarTodos();
        $this->render('categoria/listar', [
            'categorias' => $categorias,
        ]);
    }

    public function cadastrar(): void
    {
        if(true === empty($_POST)){
            $this->render('categoria/cadastrar');
            return;
        }

        $categoria = new Categoria();
        $categoria->nome = $_POST['nome'];
        $categoria->vagas = $_POST['vagas'];
        $categoria->localidade = $_POST['localidade'];

        $repository = new CategoriaRepository();
        try {
            $repository->inserir($categoria);
        } catch (Exception) {
           
        }
        $this->redirect('/categorias/listar');
    }

    public function editar(): void
    {
        $id = $_GET['id'];
        $repository = new CategoriaRepository();
        $categoria = $repository->buscarUm($id);
        $this->render('categoria/editar', [$categoria]);

        if (false === empty($_POST)) {
            $categoria->nome = $_POST['nome'];
            $categoria->vagas = $_POST['vagas'];
            $categoria->localidade = $_POST['localidade'];

            try{
                $repository->atualizar($categoria, $id);
            } catch(Exception $exception) {
    
            }
            $this->redirect('/categorias/listar');
        }
    }

    public function excluir(): void
    {
        $id = $_GET['id'];
        $repository = new CategoriaRepository();
        $repository->excluir($id);
        $this->redirect("\categorias\listar");
    }

    public function relatorio(): void
    {
        $hoje = date('d/m/Y');

        $design = "
        <h1>Relatorio de Categoria</h1>
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