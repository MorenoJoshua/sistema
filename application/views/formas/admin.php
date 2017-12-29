<div class="col-xs-12">
    <h1>Agregar modulo</h1>
    <hr>
    <form action="<?= site_url('api/admin') ?>" method="post" target="" id=""
          name="">
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="admin_modulo" class="input-group-addon">Modulo:</label>
                    <input type="text" id="admin_modulo" name="modulo" class="form-control">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="admin_modulo_nombre" class="input-group-addon">Nombre:</label>
                    <input type="text" id="admin_modulo_nombre" name="nombre" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="admin_alt" class="input-group-addon">Alt:</label>
                    <input type="text" id="admin_alt" name="alt" class="form-control">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                    <label for="color" class="input-group-addon">Color:</label>
                    <input type="text" id="color" name="color" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xs-12 p-r-0 text-xs-right">
            <input type="submit" value="Agregar" name="funcion" class="btn btn-success">
        </div>
    </form>
</div>