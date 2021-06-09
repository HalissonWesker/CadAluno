<?php $cliente = $data['clientes'][0];?>
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8 offset-md-2">
                <?php if (isset($data['errors'])) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '<ul>';
                    foreach ($data['errors'] as $error) {
                        echo '<li>' . $error . '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                ?>
                <!-- form edit clientes -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Editar <?= $cliente->getNome(); ?></h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="index.php?clientes=update">
                            <input type="hidden" name="id" value="<?= $cliente->getId() ?>">
                            <div class="align-middle">
                                <div class="align-middle">
                                    <div class="form-group align-middle">
                                        <label class="control-label col-sm-2" for="name">Nome:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nome" placeholder="Nome do cliente" name="nome" value="<?= $cliente->getNome(); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="description">Endereço:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="endereco" placeholder="Endereço" name="endereco" value="<?= $cliente->getEndereco(); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-form">Salvar</button>
                                            <a href="index.php?clientes=index"><button type="button" class="btn btn-danger btn-form">Cancelar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>