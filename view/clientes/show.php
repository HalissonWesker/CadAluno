<?php $cliente = $data['clientes'][0]; ?>
<div class="container">
    <h2 class="text-center">Category Details</h2><br><br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereco</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $cliente->getId(); ?></td>
                <td><?= $cliente->getNome(); ?></td>
                <td><?= $cliente->getEndereco(); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="row" style="float:right">
        <button type="button" class="btn btn-danger btn-form" onclick="history.back()">Back</button>
    </div>
</div>