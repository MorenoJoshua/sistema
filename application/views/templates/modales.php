<?php
date_default_timezone_set('America/Tijuana');
?>
<!-- Modal -->
<div class="modal fade" id="abonar" tabindex="-1" role="dialog">
    <form method="post" action="" id="forma_abonar_a_factura" class="preventDefault" onsubmit="actualizarProveedor()">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Abonar a Factura <span id="numero_de_factura_a_abonar"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group input-group-lg">
                                <label for="cantidad_a_abonar" class="input-group-addon">Cantidad a abonar:</label>
                                <input type="number" id="cantidad_a_abonar" name="importe" class="form-control" max="1"
                                       step="1" required>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="input-group input-group-lg">
                                <label for="fecha_movimiento" class="input-group-addon">Fecha de movimiento:</label>
                                <input type="date" id="fecha_movimiento" name="fecha_movimiento" class="form-control"
                                       value="<?= date("Y-m-d") ?>" required>
                            </div>
                        </div>
                        <input type="hidden" name="proveedor" class="proveedorId" id="proveedorId">
                        <input type="hidden" name="tipo" value="Abono">
                        <input type="hidden" name="moneda" id="moneda_a_abonar">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" id="boton_abonar_a_factura" value="Abonar">
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="pagar" tabindex="-1" role="dialog">
    <form action="" method="post" class="preventDefault" id="forma_pagar_factura">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Pagar Factura XXXXX</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group input-group-lg">
                                <label for="importe_pagar" class="input-group-addon">Cantidad restante:</label>
                                <input type="number" id="importe_pagar" name="importe" class="form-control"
                                       value="3500.00" required>
                            </div>
                        </div>
                        <input type="hidden" name="proveedor" class="proveedorId" id="proveedorId_pagar">
                        <input type="hidden" name="tipo" value="Pago">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="" id="boton_pagar_factura" class="btn btn-success" value="Pagar">
                </div>
            </div>
        </div>
    </form>
</div>


<!-- Modal -->
<div class="modal fade" id="cargo" tabindex="-1" role="dialog">
    <form action="<?= site_url('api/agregar_cargo_a_factura') ?>" onsubmit="" id="forma_agregar_cargo"
          class="preventDefault">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Cargo a factura XXXXX</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-12">
                            <div class="input-group input-group-lg">
                                <label for="cantidad" class="input-group-addon">Cantidad:</label>
                                <input type="number" id="cantidad" name="importe" class="form-control" required>
                                <input type="hidden" name="factura" id="input_cargo_a_factura_factura">
                                <input type="hidden" name="tipo" value="Cargo">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="input-group input-group-lg">
                                <label for="fecha_movimiento" class="input-group-addon">Fecha de movimiento:</label>
                                <input type="date" id="" name="fecha_movimiento" class="form-control"
                                       value="<?= date("Y-m-d") ?>" required>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-danger" value="Confirmar">
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="nuevafactura" tabindex="-1" role="dialog">
    <form method="post" action="<?= site_url('api/agregar_factura') ?>" id="forma_agregar_factura"
          class="preventDefault" onsubmit="">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Agregar Factura</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label for="factura" class="input-group-addon">No. Factura:</label>
                                    <input type="number" id="factura" name="factura" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label for="concepto" class="input-group-addon">Concepto:</label>
                                    <input type="text" id="concepto" name="concepto" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label for="fecha_movimiento" class="input-group-addon">Fecha:</label>
                                    <input type="date" id="fecha_movimiento" value="<?= date('Y-m-d') ?>"
                                           name="fecha_movimiento" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="input-group">
                                    <label for="fecha_vencimiento" class="input-group-addon">Vencimiento:</label>
                                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento"
                                           class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-xs-3 pull-xs-right">
                                <div class="input-group">
                                    <label for="moneda" class="input-group-addon">Moneda:</label>
                                    <select name="moneda" class="form-control" id="moneda" required>
                                        <option value="mxn">MXN</option>
                                        <option value="usd">USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4 pull-xs-right">
                                <div class="input-group">
                                    <label for="importe" class="input-group-addon">Importe:</label>
                                    <input type="number" id="importe" name="importe" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <input type="hidden" value="factura" name="tipo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-success" value="Agregar">
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="agregarproveedor" tabindex="-1" role="dialog">
    <form action="<?= site_url('api/proveedores/alta') ?>" method="post" id="proveedores_forma"
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="">Agregar Proveedor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_codigo" class="input-group-addon">Codigo:</label>
                            <input type="text" id="proveedores_crear_codigo" name="id" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_rfc" class="input-group-addon">RFC:</label>
                            <input type="text" id="proveedores_crear_rfc" name="rfc" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_tipo" class="input-group-addon">Tipo:</label>
                            <input type="text" id="proveedores_crear_tipo" name="tipo" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_nombre" class="input-group-addon">Nombre:</label>
                            <input type="text" id="proveedores_crear_nombre" name="nombre" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_telefono1" class="input-group-addon">Tel 1:</label>
                            <input type="tel" id="proveedores_crear_telefono1" name="telefono1"
                                   class="form-control" required>
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
                            <input type="text" id="proveedores_crear_contacto" name="contacto" class="form-control"
                            >
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_email" class="input-group-addon">Email:</label>
                            <input type="email" id="proveedores_crear_email" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_calle" class="input-group-addon">Calle:</label>
                            <input type="text" id="proveedores_crear_calle" name="direccion_calle"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_numero_exterior" class="input-group-addon">N.
                                Ext:</label>
                            <input type="number" min="0" id="proveedores_crear_numero_exterior" name="direccion_num_ext"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_numero_interior" class="input-group-addon">N.
                                Int:</label>
                            <input type="text" id="proveedores_crear_numero_interior" name="direccion_num_int"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_colonia" class="input-group-addon">Colonia:</label>
                            <input type="text" id="proveedores_crear_colonia" name="direccion_fracc"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_ciudad" class="input-group-addon">Ciudad:</label>
                            <input type="text" id="proveedores_crear_ciudad" name="direccion_ciudad"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_cp" class="input-group-addon">CP:</label>
                            <input type="number" id="proveedores_crear_cp" name="direccion_cp" class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_estado" class="input-group-addon">Estado:</label>
                            <input type="text" id="proveedores_crear_estado" name="direccion_estado"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_pais" class="input-group-addon">Pais:</label>
                            <input type="text" id="proveedores_crear_pais" name="direccion_pais"
                                   class="form-control" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_limite_de_credito" class="input-group-addon">Limite de
                                credito:</label>
                            <input type="number" id="proveedores_crear_limite_de_credito" name="limite"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_limite_de_credito_usd" class="input-group-addon">Limite de
                                credito USD:</label>
                            <input type="number" id="proveedores_crear_limite_de_credito_usd" name="limite_usd"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_dias_de_credito" class="input-group-addon">Dias de
                                credito:</label>
                            <input type="number" id="proveedores_crear_dias_de_credito" name="dias"
                                   class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-faded" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" value="Agregar">
            </div>
        </div>
    </div>
    </form>
</div>


<div class="modal fade" id="modal_editar_proveedor" tabindex="-1" role="dialog">
    <form action="<?= site_url('api/proveedores/edicion') ?>" method="post" id="proveedores_forma_edicion"
          class="preventDefault" onsubmit="actualizarProveedor()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="">Actualizar Proveedor</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_codigo" class="input-group-addon">Codigo:</label>
                                <input type="text" id="proveedores_editar_codigo" name="id" class="form-control"
                                       disabled>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_rfc" class="input-group-addon">RFC:</label>
                                <input type="text" id="proveedores_editar_rfc" name="rfc" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_tipo" class="input-group-addon">Tipo:</label>
                                <input type="text" id="proveedores_editar_tipo" name="tipo" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_nombre" class="input-group-addon">Nombre:</label>
                                <input type="text" id="proveedores_editar_nombre" name="nombre" class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_telefono1" class="input-group-addon">Tel 1:</label>
                                <input type="tel" id="proveedores_editar_telefono1" name="telefono1"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_telefono2" class="input-group-addon">Tel 2:</label>
                                <input type="tel" id="proveedores_editar_telefono2" name="telefono2"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_contacto" class="input-group-addon">Contacto:</label>
                                <input type="text" id="proveedores_editar_contacto" name="contacto" class="form-control"
                                       required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_email" class="input-group-addon">Email:</label>
                                <input type="email" id="proveedores_editar_email" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_calle" class="input-group-addon">Calle:</label>
                                <input type="text" id="proveedores_editar_calle" name="direccion_calle"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_numero_exterior" class="input-group-addon">N.
                                    Ext:</label>
                                <input type="number" min="0" id="proveedores_editar_numero_exterior"
                                       name="direccion_num_ext"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_numero_interior" class="input-group-addon">N.
                                    Int:</label>
                                <input type="text" id="proveedores_editar_numero_interior" name="direccion_num_int"
                                       class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_colonia" class="input-group-addon">Colonia:</label>
                                <input type="text" id="proveedores_editar_colonia" name="direccion_fracc"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_ciudad" class="input-group-addon">Ciudad:</label>
                                <input type="text" id="proveedores_editar_ciudad" name="direccion_ciudad"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="input-group">
                                <label for="proveedores_editar_cp" class="input-group-addon">CP:</label>
                                <input type="number" id="proveedores_editar_cp" name="direccion_cp" class="form-control"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_estado" class="input-group-addon">Estado:</label>
                                <input type="text" id="proveedores_editar_estado" name="direccion_estado"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_pais" class="input-group-addon">Pais:</label>
                                <input type="text" id="proveedores_editar_pais" name="direccion_pais"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_editar_limite_de_credito" class="input-group-addon">Limite de
                                    credito:</label>
                                <input type="number" id="proveedores_editar_limite_de_credito" name="limite"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_crear_limite_de_credito_usd" class="input-group-addon">Limite de
                                    credito USD:</label>
                                <input type="number" id="proveedores_crear_limite_de_credito_usd" name="limite_usd"
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <label for="proveedores_crear_dias_de_credito" class="input-group-addon">Dias de
                                    credito:</label>
                                <input type="number" id="proveedores_crear_dias_de_credito" name="dias"
                                <input type="number" id="proveedores_crear_dias_de_credito" name="dias"
                                       class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-faded" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-info" value="Actualizar">
                </div>
            </div>
        </div>
    </form>
</div>


<!------------->

<div class="modal fade" id="agregarproveedor" tabindex="-1" role="dialog">
    <form action="<?= site_url('api/proveedores/alta') ?>" method="post" id="proveedores_forma"
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="">Agregar Proveedor</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_codigo" class="input-group-addon">Codigo:</label>
                            <input type="text" id="proveedores_crear_codigo" name="id" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_rfc" class="input-group-addon">RFC:</label>
                            <input type="text" id="proveedores_crear_rfc" name="rfc" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_tipo" class="input-group-addon">Tipo:</label>
                            <input type="text" id="proveedores_crear_tipo" name="tipo" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_nombre" class="input-group-addon">Nombre:</label>
                            <input type="text" id="proveedores_crear_nombre" name="nombre" class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_telefono1" class="input-group-addon">Tel 1:</label>
                            <input type="tel" id="proveedores_crear_telefono1" name="telefono1"
                                   class="form-control" required>
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
                            <input type="text" id="proveedores_crear_contacto" name="contacto" class="form-control"
                                   required>
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
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_numero_exterior" class="input-group-addon">N.
                                Ext:</label>
                            <input type="number" min="0" id="proveedores_crear_numero_exterior" name="direccion_num_ext"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_numero_interior" class="input-group-addon">N.
                                Int:</label>
                            <input type="text" id="proveedores_crear_numero_interior" name="direccion_num_int"
                                   class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_colonia" class="input-group-addon">Colonia:</label>
                            <input type="text" id="proveedores_crear_colonia" name="direccion_fracc"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_ciudad" class="input-group-addon">Ciudad:</label>
                            <input type="text" id="proveedores_crear_ciudad" name="direccion_ciudad"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="input-group">
                            <label for="proveedores_crear_cp" class="input-group-addon">CP:</label>
                            <input type="number" id="proveedores_crear_cp" name="direccion_cp" class="form-control"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_estado" class="input-group-addon">Estado:</label>
                            <input type="text" id="proveedores_crear_estado" name="direccion_estado"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_pais" class="input-group-addon">Pais:</label>
                            <input type="text" id="proveedores_crear_pais" name="direccion_pais"
                                   class="form-control" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_limite_de_credito" class="input-group-addon">Limite de
                                credito MN:</label>
                            <input type="number" id="proveedores_crear_limite_de_credito" name="limite"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_limite_de_credito_usd" class="input-group-addon">Limite de
                                credito USD:</label>
                            <input type="number" id="proveedores_crear_limite_de_credito_usd" name="limite_usd"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="input-group">
                            <label for="proveedores_crear_dias_de_credito" class="input-group-addon">Dias de
                                credito:</label>
                            <input type="number" id="proveedores_crear_dias_de_credito" name="dias"
                                   class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-faded" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-success" value="Agregar">
            </div>
        </div>
    </div>
    </form>
</div>