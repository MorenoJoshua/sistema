<div class="col-xs-12">
    <h1>Seccion de Proveedores
        <small class="text-muted">Formas</small>
    </h1>
</div>
<div class="col-xs-12">
    <div class="breadcrumb">
        <div class="breadcrumb-item">Proveedores</div>
        <div class="breadcrumb-item">Proveedores</div>
    </div>
    <form action="<?= site_url('api/provedores') ?>" method="post" target="_blank" id="proveedores_forma"
          name="proveedores_crear">
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_codigo" class="input-group-addon">Codigo:</label>
                    <input type="text" id="proveedores_crear_codigo" name="id" class="form-control">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_rfc" class="input-group-addon">RFC:</label>
                    <input type="text" id="proveedores_crear_rfc" name="rfc" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_nombre" class="input-group-addon">Nombre:</label>
                    <input type="text" id="proveedores_crear_nombre" name="nombre" class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_telefono1" class="input-group-addon">Tel 1:</label>
                    <input type="tel" id="proveedores_crear_telefono1" name="telefono1"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_telefono2" class="input-group-addon">Tel 2:</label>
                    <input type="tel" id="proveedores_crear_telefono2" name="telefono2"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_contacto" class="input-group-addon">Contacto:</label>
                    <input type="text" id="proveedores_crear_contacto" name="contacto" class="form-control">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_email" class="input-group-addon">Email:</label>
                    <input type="email" id="proveedores_crear_email" name="email" class="form-control">
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_calle" class="input-group-addon">Calle:</label>
                    <input type="text" id="proveedores_crear_calle" name="direccion_calle"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_numero_exterior" class="input-group-addon">Numero
                        Exterior:</label>
                    <input type="number" id="proveedores_crear_numero_exterior" name="direccion_num_ext"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_numero_interior" class="input-group-addon">Numero
                        Interior:</label>
                    <input type="number" id="proveedores_crear_numero_interior" name="direccion_num_int"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_colonia" class="input-group-addon">Colonia:</label>
                    <input type="text" id="proveedores_crear_colonia" name="direccion_fracc"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_ciudad" class="input-group-addon">Ciudad:</label>
                    <input type="text" id="proveedores_crear_ciudad" name="direccion_ciudad"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-3">
                <div class="input-group">
                    <label for="proveedores_crear_cp" class="input-group-addon">Codigo Postal:</label>
                    <input type="number" id="proveedores_crear_cp" name="direccion_cp" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_estado" class="input-group-addon">Estado:</label>
                    <input type="text" id="proveedores_crear_estado" name="direccion_estado"
                           class="form-control">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="proveedores_crear_pais" class="input-group-addon">Pais:</label>
                    <input type="text" id="proveedores_crear_pais" name="direccion_pais"
                           class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 text-xs-right p-r-0">
            <input type="submit" class="btn btn-primary" name="funcion" value="Busqueda" disabled>
            <input type="submit" class="btn btn-success" name="funcion" value="Crear" disabled>
        </div>
    </form>
</div>
<script>
    var proveedores_forma = document.getElementById('proveedores_forma');

</script>