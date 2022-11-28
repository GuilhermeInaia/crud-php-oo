<section class="mt-3 card card-body">
    <h1 class="">Gerenciar Usuarios</h1>

    <div class="mt-2">
        <a href="/alunos/novo" class="btn btn-outline-dark">Novo Usuario</a>
        <!-- <a href="/alunos/relatorio" target="_blank" class="btn btn-outline-dark">Gerar PDF</a> -->
    </div>

    <table class="table table-striped table-hover mt-4 text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($users ?? [] as $user) {
                echo "
                    <tr>
                        <td>{$user->id}</td>
                        <td>{$user->nome}</td>
                        <td>{$user->email}</td>
                        <td>{$user->senha}</td>
                        <td>{$user->perfil}</td>
                        <td> 
                            <a href='/alunos/editar?id={$user->id}' class='btn btn-warning'>Editar</a>
                            <a href='/alunos/excluir?id={$user->id}' class='btn btn-danger'>Excluir</a>
                        </td>
                        
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</section>