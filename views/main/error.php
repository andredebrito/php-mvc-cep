<?php $v->layout("_main"); ?>
<div class="container d-flex flex-wrap align-content-center justify-content-center" style="height: 100vh;">
    <div>
        <div class="container">
            <header class="text-center">
                <h3>Erro <?= $error->number ?></h3>
                <h5 class="error-titlle"><?= $error->message ?></h5>
            </header>
        </div>

        <div class="text-center" style="margin-top: 20px;">
            <a href="<?= url() ?>" class="btn btn-info btn-lg bg-blue-gradient">Voltar</a>
        </div>

    </div>
</div>


