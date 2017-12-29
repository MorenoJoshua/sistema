<div class="col-xs-12">
    <div class="breadcrumb">
        <div class="breadcrumb-item">Proveedores</div>
        <div class="breadcrumb-item">Sucursales</div>
    </div>
    <form action="<?= site_url('api/proveedores_sucursales') ?>" method="post" target="_blank" id="proveedores_sucursales"
          name=proveedores_sucursales"">
        <div class="form-group row">
            <div class="col-xs-2">
                <div class="input-group">
                    <label for="id" class="input-group-addon">Codigo:</label>
                    <input type="number" id="id" name="id" class="form-control">
                </div>
            </div>
            <div class="col-xs-10">
                <div class="input-group">
                    <label for="proveedores_tipo_nombre" class="input-group-addon">Nombre:</label>
                    <input type="text" id="proveedores_tipo_nombre" name="nombre" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12">
                <div class="input-group">
                    <label for="proveedores_tipo_descripcion" class="input-group-addon">Descripcion:</label>
                    <input type="text" id="proveedores_tipo_descripcion" name="descripcion" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 p-r-0 text-xs-right">
            <input type="submit" value="Enviar" class="btn btn-success" disabled>
        </div>
    </form>
</div>