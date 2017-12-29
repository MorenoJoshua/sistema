<?php
$rows = '';
foreach ($submodulos as $submodulo) {
    $editarUrl = site_url('api/admin_editar_modulo/' . $submodulo['modulo']);
    $rows .= <<<HTML
    <tr>
<form action="$editarUrl" method="post" ">
<input type="hidden" name="id" value="{$submodulo['id']}">
    <td>
    <input type="text" value="{$submodulo['nombre']}" name="nombre" class="form-control">
</td>
    <td>
    <input type="text" value="{$submodulo['submodulo']}" name="submodulo" class="form-control">
</td>
    <td>
    <input type="text" value="{$submodulo['permiso']}" name="permiso" class="form-control">
</td>
<td><input type="submit" value="Guardar" name="guardar" class="btn btn-sm btn-success"></td>
<td><input type="submit" name="eliminar" value="Eliminar" class="btn btn-sm btn-danger"></td>
</form>
    </tr>




HTML;


}


?>

<table class="table table-responsive">
    <thead>
    <th>Nombre</th>
    <th>Modulo</th>
    <th>Pertenece a</th>
    <th></th>
    <th></th>
    </thead>
    <tbody>

    <?= $rows ?>
    </tbody>
</table>