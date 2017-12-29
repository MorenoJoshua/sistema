<?php
$modulos = isset($modulos) ? $modulos : [];

$modulos_tabla = '';
foreach ($modulos as $modulo) {
    $eliminar_modulo_url = site_url('api/admin/eliminar_modulo/' . $modulo['id']);
    $editarUrl = site_url('admin_editar_modulo/' . $modulo['id']);

    $modulos_tabla .= <<<HTML
    
<tr>
    <td>{$modulo['nombre']}</td>
    <td>{$modulo['modulo']}</td>
    <td><p>{$modulo['alt']}</p></td>
    <td>{$modulo['color']}</td>
    <td>{$modulo['orden']}</td>
    <td>
        <a href="$editarUrl" class="btn btn-sm btn-primary">Editar</a>
        <a href="$eliminar_modulo_url" class="btn btn-sm btn-danger">Eliminar</a>
        <!--<a data-toggle="modal" href="$eliminar_modulo_url" class="btn btn-sm btn-danger">Eliminar</a>-->
    </td>
</tr>


HTML;

}
?>
<div class="col-xs-12">
    <h1>Modulos Activos</h1>
    <hr>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Modulo</th>
            <th>Alt</th>
            <th>Color</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?= $modulos_tabla ?>
        </tbody>
    </table>
</div>