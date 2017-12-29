<div id="loginBox">
    <div class="card card-outline-warning">
        <div class="card-header card-warning">Iniciar Sesion</div>
        <div class="card-block">
            <div class="col-xs-12">
                <form action="<?= site_url('api/login') ?>" method="post" id="forma_login"
                      name="">
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <label for="usuario" class="input-group-addon">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <label for="password" class="input-group-addon">Password:</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <input type="submit" class="btn btn-success" value="Iniciar Sesion">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>