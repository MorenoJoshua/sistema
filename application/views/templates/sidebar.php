<?php
$modulos = isset($modulos) ? $modulos : [];

$botones = '';

$k = 0;

foreach ($modulos as $modulo) {
    $bg = $k % 1 == 0 ? 'bg-warning' : '';
    $k++;
    $url = site_url($modulo['modulo']);
    $submenu = '';
    $drop = '';

    foreach ($modulo['submodulos'] as $submodulo) {
        $menuUrl = site_url($modulo['modulo'] . (strlen($submodulo['submodulo']) > 0 ? '_' : '') . $submodulo['submodulo']);
        $submenu .= <<<HTML
<li class="list-group-item bg-warning p-a-0 b-a-0 ">
    <a href="$menuUrl" class="text-white ">{$submodulo['nombre']}</a>
</li>
HTML;
    }
    $flechita = count($modulo['submodulos']) > 0 ? '&blacktriangledown;' : '';

    $moduloUrl = site_url($modulo['modulo']);

    $mostrar = strtok(substr(array_keys($_REQUEST)[0], 1), '_') == $modulo['modulo'] ? 'in' : '';

    $botones .= <<<HTML
<li class="jumbotron-fluid bg-warning text-xs-left list-group-item p-r-0">
    <div class=""><a href="$moduloUrl" class="text-white">{$modulo['nombre']}</a> <span class="pull-xs-right p-r-1 " data-toggle="collapse"
                                          data-target="#submenu{$modulo['modulo']}">$flechita</span></div>
    <ul class="list-group list-group-flush p-l-1 collapse $mostrar" id="submenu{$modulo['modulo']}">
        $submenu
    </ul>
</li>

HTML;


}
?>
<div id="sidebar" class="col-xs-12 col-md-2 bg-faded p-x-0">
    <ul class="list-group-flush list-unstyled m-a-0 p-a-0">
        <li class="jumbotron-fluid bg-warning text-sm-lef list-group-item-warning p-r-0">
            <div class="w-100 p-a-0 m-a-0"><img src="<?= base_url('/assets/imagenes/rmclogo1.png') ?>" alt=""
                                                class="w-100 p-a-0 m-a-0"></div>

        </li>
        <?= $botones ?>
        <!--        <li class="list-group-item sidebar-link bg-inverse" onclick="sistema.doDebug()"> DEBUG</li>-->
    </ul>
</div>

