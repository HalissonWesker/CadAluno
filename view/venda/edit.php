<script>
    $(document).ready(function() {
        $('.money').mask("###0.00", {
            reverse: true
        });
    });
    const toBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => resolve(reader.result);
            reader.onerror = error => reject(error);
        });
    };

    const uploadFile = async (files) => {
        document.getElementById('image').value = await toBase64(files[0]);
        document.getElementById('img-image').src = await toBase64(files[0]);
    }
</script>
<div class="container py-5">
    <?php $clientes = $data['clientes']; ?>
    <?php $vendas = $data['vendas'][0]; ?>
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
                <!-- form new category -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Edit <?= $vendas->getId(); ?></h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="index.php?venda=update">
                            <div class="align-middle">
                                <div class="align-middle">
                                    <div class="form-group align-middle">
                                        <label class="control-label col-sm-2" for="name">Valor:</label>
                                        <div class="col-sm-12">
                                            <input type="hidden" name="id" value="<?= $vendas->getId(); ?>">
                                            <input type="text" class="form-control" id="name" placeholder="Valor" name="valor" value="<?= $vendas->getValor(); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="category">Cliente:</label>
                                        <div class="col-sm-4">
                                            <select name="cliente" id="cliente" class="form-control">
                                                <?php foreach ($clientes as $cliente) : ?>
                                                    <option value="<?php echo $cliente->getId(); ?>" <?php if ($vendas->getClienteId() == $cliente->getId()) echo 'selected' ?>><?php echo $cliente->getNome(); ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-form">Save</button>
                                            <a href="index.php?venda=index"><button type="button" class="btn btn-danger btn-form">Cancel</button></a>
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