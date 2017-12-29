<nav class="navbar navbar-fixed-top navbar-dark bg-inverse sharp-corners">
    <a href="" class="navbar-brand">
        <!--Sist--><span class="small text-warning"><?= @SIST_NOMBRE ?>
            <span class="tag tag-primary"><?= SIST_VERSION ?></span>
        </span>
    </a>
    <div class="pull-md-right">
        <ul class="nav navbar-nav">
            <li class="nav-item nav-link">Notificaciones:
                <span class="tag tag-default" id="notificaciones_notificacion_def" title="General">0</span>
                <span class="tag tag-primary" id="notificaciones_notificacion_mensajes" title="Mensajes">0</span>
                <span class="tag tag-danger" id="notificaciones_notificacion_pendientes" title="Pendientes">0</span>
            </li>
            <li class="nav-item nav-link">Proveedores
                <span class="tag tag-success" id="proveedores_notificacion">0</span>
            </li>
            <li class="nav-item nav-link">
                <a href="<?= site_url('api/kill') ?>">Cerrar Sesion</a>
            </li>
        </ul>
    </div>
</nav>
