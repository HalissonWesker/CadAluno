<div class="container">
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
                <!-- form new cliente -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Novo Cliente</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="index.php?cliente=store">
                            <div class="align-middle">
                                <div class="align-middle">
                                    <div class="form-group align-middle">
                                        <label class="control-label col-sm-2" for="name">Nome:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" placeholder="Nome" name="nome">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="description">Endereco:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="endereco" placeholder="Endereco" name="description">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-form">Salvar</button>
                                            <a href="index.php?cliente=index"><button type="button" class="btn btn-danger btn-form">Cancel</button></a>
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