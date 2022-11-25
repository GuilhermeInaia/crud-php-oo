<?php

declare(strict_types=1);

namespace App\Model;

use DateTime; // importando a clase interna do PHP DateTime, mas posso usar a contra barra /

// aqui vai ficar a definição do caminho até essa classe

class Aluno extends Pessoa
{
    public string $matricula;
    public string $dataNascimento;
    public bool $status;
    public string $genero;
}
