<section class="mt-3 card card-body">
    <h1>Novo Aluno</h1>

    <div class="row">
        <div class="col">
            <form action="" method="POST">
                <label for="nome">Nome</label>
                <input name="nome" type="text" id="nome" class="form-control mb-3">

                <label for="email">Email</label>
                <input name="email" type="text" id="email" class="form-control mb-3">

                <label for="senha">Senha</label>
                <input name="senha" type="text" id="senha" class="form-control mb-3">

                <label for="perfil">Perfil</label>
                <select name="perfil" id="perfil">
                    <option value="normal">Normal</option>
                    <option value="adimn">Adiministrador</option>
                </select>

                <button class="btn btn-primary">Cadastrar</button>

            </form>
        </div>
    </div>
</section>