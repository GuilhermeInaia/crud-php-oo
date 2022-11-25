<?php

declare(strict_types=1);

namespace App\Controller;

class InicioController extends AbstractController
{
    public function inicio(): void // void não dará o retorno apenas redirecionamento das views
    {
        $this->render('inicio/listar');
    }
}
