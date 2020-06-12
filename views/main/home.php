<?php $v->layout("_main"); ?>
<div class="container">
    <header class="text-center" style="margin-top: 20px;">
        <h2>Localizar Endereço</h2>

    </header>

    <div class="container">
        <form method="post" action="<?= url("/") ?>">
            <input type="hidden" name="action" value="bycep" id="action">

            <div class="row">
                <div class="col-sm-6" style="margin: 15px auto;">

                    <div class="form-group">
                        <div class="ajax-response"></div>
                    </div>

                    <div class="form-group">
                        <label>Consultar por:</label>
                        <select class="form-control search-type">
                            <option value="cep">Cep</option>
                            <option value="address">Endereço</option>
                        </select>
                    </div>

                    <div id="cep">
                        <div class="form-group">
                            <label>Informe o CEP:</label>
                            <input type="text" name="cep" class="form-control mask-zipcode" required/>
                        </div>
                    </div>

                    <div id="address" style="display: none;">
                        <div class="form-group">
                            <label>Informe o Logradouro:</label>
                            <input type="text" name="address" class="form-control"/>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Informe a Cidade:</label>
                                    <input type="text" name="city" class="form-control"/>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Informe o Estado:</label>
                                    <select name="estate" class="form-control">
                                        <option value="">Selecione...</option>
                                        <?php foreach ($estates as $estate): ?> 
                                            <option value="<?= $estate->initials ?>"><?= $estate->initials ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-primary">Consultar</button>
                    </div>

                </div>
                

            </div>

        </form>


        <div class="row">

            <div class="col-sm-6" style="margin: 15px auto;">

                <div class="card card-body container-response" style="display: none;">

                    <ul class="list-unstyled">
                        <li>
                            <label>Logradouro:</label> <span>(Logradrouro)</span>
                        </li>

                        <li>
                            <label>Bairro:</label> <span>(Bairro)</span>
                        </li>

                        <li>
                            <label>Localidade:</label> <span>(Localidade)</span>
                        </li>

                        <li>
                            <label>CEP:</label> <span>(CEP)</span>
                        </li>

                        <li>
                            <label>UF:</label> <span>(UF)</span>
                        </li>                             

                    </ul>

                </div>

            </div>


        </div>
    </div>
</div>

