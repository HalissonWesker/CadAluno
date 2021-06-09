<script>
    $(document).ready(function () {
        $(".delete").click(function () {
            if (window.confirm("Confirm?")) {
                window.location = "index.php?clientes=destroy&id=" + this.dataset.value;
            }
        });
    });
</script>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Gerenciar Clientes</h2>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?clientes=create" class="btn btn-success"><i class="material-icons">&#xE147;</i>
                        <span>Adicionar novo cliente</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Açoes</th>
            </tr>
            </thead>
            <tbody>
            <?php $clientes = $data['clientes']; ?>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente->getId(); ?></td>
                    <td>
                        <a href="index.php?clientes=show&id=<?php echo $cliente->getId(); ?>"><?= $cliente->getNome() ?></a>
                    </td>
                    <td>
                        <a href="index.php?clientes=show&id=<?php echo $cliente->getId(); ?>"><?= $cliente->getEndereco() ?></a>
                    </td>
                    <td>
                        <a href="index.php?clientes=edit&id=<?= $cliente->getId(); ?>" class="edit"><i
                                    class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <a href="#" class="delete" data-value="<?= $cliente->getId() ?>"><i class="material-icons"
                                                                                             data-toggle="tooltip"
                                                                                             title="Delete">&#xE872;</i></a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>