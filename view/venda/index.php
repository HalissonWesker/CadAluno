<script>
    $(document).ready(function() {
        $(".delete").click(function() {
            if (window.confirm("Confirm?")) {
                window.location = "index.php?venda=destroy&id=" + this.dataset.value;
            }
        });
    });
</script>

<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Gerenciar Vendas</h2>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?venda=create" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Criar Nova venda</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Valor</th>
                    <th>Açoes</th>

                </tr>
            </thead>
            <tbody>
                <?php $vendas = $data['vendas']; ?>
                <?php foreach ($vendas as $venda) : ?>
                    <tr>
                        <td><?php echo $venda->getId(); ?></td>
                        <td><a href="index.php?venda=show&id=<?php echo $venda->getId(); ?>"><?= $venda->getClienteId(); ?></a></td>
                        <td><?php echo '$'.$venda->getValor(); ?></td>
                        <td>
                            <a href="index.php?venda=edit&id=<?= $venda->getId(); ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="#" class="delete" data-value="<?= $venda->getId() ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>