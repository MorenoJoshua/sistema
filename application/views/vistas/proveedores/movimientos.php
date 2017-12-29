<div class="col-xs-12 form-group p-x-0">
    <div class="col-xs-10">
        <div class="input-group">
            <label for="busqueda" class="input-group-addon ">Busqueda:</label>
            <input type="search" id="busqueda" name="busqueda" class="form-control focus-select"
                   placeholder="Codigo/Nombre de Proveedor" value="<?= @$_GET['proveedor'] ?>" autofocus>
            <span class="input-group-btn">
        <button class="btn btn-secondary" type="button" data-id="" id="boton_actualizar_info_proveedor"
                onclick="mostrarInfoProveedor()">Actualizar</button>
      </span>
        </div>
        <div class="dropdown" id="resultadosDropdown">
            <div class="dropdown-menu" id="resultados_busqueda_proveedores">
                <div class="dropdown-header">RFC</div>
                <div class="" id="resultados_busqueda_proveedores_rfc"></div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-header">Nombre</div>
                <div class="" id="resultados_busqueda_proveedores_nombre"></div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-header">No. de Factura</div>
                <div class="" id="resultados_busqueda_proveedor_por_factura"></div>
            </div>
        </div>
    </div>
    <div class="col-xs-2 btn btn-success" href="#agregarproveedor" data-toggle="modal">Nuevo Proveedor</div>
</div>
<div class="col-xs-12" id="info_proveedor">
    <div id="infoDeProveedor" class="col-xs-12"></div>
    <div class="clearfix"></div>

    <div class="">
        <div class="h4 p-x-1">Facturas en Moneda Nacional:</div>
        <div class="p-a-1">
            <div class="col-xs-2 text-sm-left" title="Factura">Factura</div>
            <div class="col-xs-4 text-sm-left" title="Concepto de factura">Concepto</div>
            <div class="col-xs-3 text-sm-right" title="Pendiente / Importe Total">Importe Total / Pendiente</div>
            <div class="col-xs-3 text-sm-right" title="Fecha de factura / Fecha de vencimiento">Creacion - Vencimiento
            </div>
        </div>
        <div class="card-subtitle p-a-1" id="facturasDesplegablesmxn">
        </div>

    </div>
</div>
<div class="">
    <div class="h4 p-x-1">Facturas en Dolares:</div>
    <div class="p-a-1">
        <div class="col-xs-2 text-sm-left" title="Factura">Factura</div>
        <div class="col-xs-4 text-sm-left" title="Concepto de factura">Concepto</div>
        <div class="col-xs-3 text-sm-right" title="Pendiente / Importe Total">Importe Total / Pendiente</div>
        <div class="col-xs-3 text-sm-right" title="Fecha de factura / Fecha de vencimiento">Creacion - Vencimiento</div>
    </div>
    <div class="card-subtitle p-a-1" id="facturasDesplegablesusd"></div>
</div>
</div>

<script>

    Number.prototype.formatMoney = function (c, d, t) {
        var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

    var busquedainput = document.getElementById('busqueda');
    var proveedorActivo;
    var pendiente;
    var creditoDisponible;
    var limiteDeCredito;
    tempResultado = {};
    tempBusqueda = {};


    function parseMoneda(moneda) {
        // para imprimir lindo la moneda
        if (moneda === 'mxn') {
            return 'MN';
        } else if (moneda === 'usd') {
            return 'USD';
        } else {
            return '';
        }
    }

    busquedainput.addEventListener('keyup', function (e) {
//        Acciones en barra de busqueda
        if (busquedainput.value.length == 0) {
            document.getElementById('resultadosDropdown').classList.remove('open');
            return false
        }
        $.post('<?=site_url('api/busqueda_json/proveedores')?>', 'busqueda=' + busquedainput.value, function (data) {
            if (data != tempBusqueda) {
                document.getElementById('resultados_busqueda_proveedores_nombre').innerHTML = '';
                document.getElementById('resultados_busqueda_proveedores_rfc').innerHTML = '';
                document.getElementById('resultados_busqueda_proveedor_por_factura').innerHTML = '';
                data = parseResponse(data);
                tempBusqueda = data;
                document.getElementById('resultadosDropdown').classList.add('open');
                data.rfc.forEach(function (i, k) {
                    document.getElementById('resultados_busqueda_proveedores_rfc').insertAdjacentHTML('afterBegin',
                        `<a class="dropdown-item" href="#" onclick="mostrarInfoProveedor(${i.id})">${i.nombre} - ${i.rfc}</a>`);
                });
                data.nombre.forEach(function (i, k) {
                    document.getElementById('resultados_busqueda_proveedores_nombre').insertAdjacentHTML('afterBegin',
                        `<a class="dropdown-item" href="#" onclick="mostrarInfoProveedor(${i.id})">${i.nombre} - ${i.rfc}</a>`);
                });
            }
        })
    });

    function mostrarInfoProveedor(id) {
//        Al dar click en resultado de barra de busqueda
        proveedorActivo = id;
        document.getElementById('busqueda').value = id;

//        Pasar proveedor a url
        window.history.pushState('', '', '/index.php?/proveedores?proveedor=' + id);

        document.getElementById('boton_actualizar_info_proveedor').setAttribute('data-id', id);
        document.getElementById('boton_actualizar_info_proveedor').setAttribute('onclick', 'mostrarInfoProveedor(' + id + ')');

        $.post('<?=site_url('api/contacto_proveedor/')?>/' + id, '', function (data) {
//            Popular pantalla con info
            if (data = parseResponse(data)) {
                document.getElementById('busqueda').value = data.nombre;
                document.getElementById('infoDeProveedor').innerHTML = proveedor_info_template(data);
                var xx = document.getElementById('proveedores_forma_edicion');
                for (var param in data) {
                    xx[param].value = data[param];
                }
            }
        });

        $.post('<?=site_url('api/info_proveedor/')?>/' + id, '', function (data) {
            if (data != tempResultado) {
                tempResultado = data;
                document.getElementById('resultadosDropdown').classList.remove('open');

                data = parseResponse(data);

                limiteDeCredito = data.info.limite;
                creditoDisponible = limiteDeCredito;
                document.getElementById('facturasDesplegablesmxn').innerHTML = '';
                document.getElementById('facturasDesplegablesusd').innerHTML = '';

                let facturas = data.facturas;
                let facturasMN = facturas.mxn;
                let facturasUSD = facturas.usd;

                Object.keys(facturas).forEach(function (moneda) {
                    Object.keys(facturas[moneda]).forEach(function (key) {

                        let total = facturas[moneda][key][0].importe;
                        pendiente = total;
                        let rows = '';
                        facturas[moneda][key].forEach(function (i) {
                            if (i.tipo === 'Abono') {
                                pendiente = pendiente - Number(i.importe);
                            } else if (i.tipo === 'Cargo') {
                                pendiente = pendiente + Number(i.importe);
                            } else if (i.tipo === 'Pago') {
                                pendiente = pendiente - Number(i.importe);
                            } else {
                            }


                            rows += facturaRow(i, pendiente)
                        });
                        let factTemplate = factura_template(facturas[moneda], key, pendiente, proveedorActivo, rows, total);

                        document.getElementById('facturasDesplegables' + moneda).insertAdjacentHTML('afterBegin', factTemplate);
                        creditoDisponible = creditoDisponible - pendiente;

                    })


                });
            }

        });

    }

    function factura_template(data, key, pendiente, proveedorActivo, rows, total) {
        return `<div class="card-header" data-toggle="collapse" data-target="#factura${key}">
    <div class="col-xs-2 text-sm-left" title="Factura">Factura ${key}</div>
    <div class="col-xs-4 text-sm-left" title="Concepto de factura">${data[key][0].concepto}</div>
    <div class="col-xs-3 text-sm-right" title="Pendiente / Importe Total">${Number(total).formatMoney(2)} ${parseMoneda(data[key][0].moneda)} / ${Number(pendiente).formatMoney(2)} ${parseMoneda(data[key][0].moneda)}</div>
    <div class="col-xs-3 text-sm-right" title="Fecha de factura / Fecha de vencimiento">
${fechaLinda(data[key][0].fecha_movimiento)} - ${fechaLinda(data[key][0].fecha_vencimiento)}</div>
</div>
<div class="collapse" id="factura${key}">
    <div class="card card-block p-a-0">
        <table class="table table-hover m-a-0 b-r-0">
            <tr>
                <th>Tipo de mov</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Total (Pendiente)</th>
            </tr>
            ${rows}
            <tr id="rowsDeFactura${key}">
                <td colspan="5" class="text-xs-right">
                    <div class="btn btn-primary" onclick="modalAbonarAFactura(${key}, ${pendiente}, ${proveedorActivo}, '${data[key][0].moneda}')">Abonar</div>
                    <div class="btn btn-success" data-toggle="modal" href="#pagar" onclick="modalPagarFactura(${key}, ${pendiente}, ${proveedorActivo})">Pagar</div>
                    <div class="btn btn-danger" data-toggle="modal" href="#cargo" onclick="modalAgregarCargoAFactura(${key})">Cargo</div>
                </td>
            </tr>
        </table>
    </div>
</div>`;
    }
    function modalAbonarAFactura(factura, pendiente, proveedor, moneda) {
        document.getElementById('proveedorId').value = proveedor;
        document.getElementById('moneda_a_abonar').value = moneda;
        document.getElementById('cantidad_a_abonar').setAttribute('max', pendiente);
        document.getElementById('forma_abonar_a_factura').setAttribute('onsubmit', 'abonarAFactura(' + factura + ',' + pendiente + ')');
        $('#abonar').modal('show');
    }

    function abonarAFactura(factura, pendiente) {
        document.getElementById('boton_abonar_a_factura').setAttribute('disabled', true);
        $.post('<?=site_url('api/abonar_a_factura')?>/' + factura, $('#forma_abonar_a_factura').serialize(), function (data) {
            data = parseResponse(data);

            pendiente = pendiente - data.importe;
            document.getElementById('rowsDeFactura' + factura).insertAdjacentHTML('beforeBegin', facturaRow(data, pendiente));
            $('#abonar').modal('hide');

            $('#abonar').on('hidden.bs.modal', function () {
                document.getElementById('boton_abonar_a_factura').removeAttribute('disabled');
                document.getElementById('forma_abonar_a_factura').reset()
            });


        });

    }

    function agregarFactura() {
        $.post('<?=site_url('api/agregar_factura')?>/' + proveedorActivo, $('#forma_agregar_factura').serialize(), function (data) {
            if (data = parseResponse(data)) {
                document.getElementById('facturasDesplegables' + data.moneda).insertAdjacentHTML('afterBegin', factura_desplegable(data));
                $('#abonar').modal('hide');
            }
        });
    }

    function factura_desplegable(data) {

        let key = data.id;
//        let pendiente = 0;
        let rows = facturaRow(data, data.importe);
        return `<div class="card-header" data-toggle="collapse" data-target="#factura${data.id}">
    <div class="col-xs-2 text-sm-left" title="Factura">Factura ${data.factura}</div>
    <div class="col-xs-4 text-sm-left" title="Concepto de factura">${data.concepto}</div>
    <div class="col-xs-3 text-sm-right" title="Pendiente / Importe Total">${Number(data.importe).formatMoney(2)} ${parseMoneda(data.moneda)}/ ${Number(data.importe).formatMoney(2)} ${parseMoneda(data.moneda)}</div>
    <div class="col-xs-3 text-sm-right" title="Fecha de factura / Fecha de vencimiento">${data.fecha_movimiento} / ${data.fecha_vencimiento}</div>
</div>
<div class="collapse" id="factura${key}">
    <div class="card card-block p-a-0">
        <table class="table table-hover m-a-0 b-r-0">
            <tr>
                <th>Tipo de mov</th>
                <th>Fecha</th>
                <th>Importe</th>
                <th>Total (Pendiente)</th>
            </tr>
            ${rows}
            <tr id="rowsDeFactura${key}">
                <td colspan="5" class="text-xs-right">
                    <div class="btn btn-primary" data-toggle="modal" href="#abonar" onclick="modalAbonarAFactura(${data.id}, ${data.importe}, ${proveedorActivo}, ${data.moneda})">Abonar</div>
                    <div class="btn btn-success" data-toggle="modal" href="#pagar" onclick="modalPagarFactura(${data.id}, ${data.importe}, ${proveedorActivo})">Pagar</div>
                    <div class="btn btn-danger" data-toggle="modal" href="#cargo" onclick="modalAgregarCargoAFactura(${data.id})">Cargo</div>
                </td>
            </tr>
        </table>
    </div>
</div>`
    }

    function padleft(num) {
        return ("0" + (num + 1)).slice(-2);
    }

    function modalAgregarFactura(id, dias) {
        xxx = new Date();
        xxx.setDate(xxx.getDate() + dias);
        xxx.setTime(xxx.getTime() + (9 * 60 * 60 * 1000));
        var vencimiento = `${xxx.getUTCFullYear()}-${padleft(xxx.getUTCMonth())}-${padleft(xxx.getUTCDay())}`;
        document.getElementById('fecha_vencimiento').value = vencimiento;

        document.getElementById('forma_agregar_factura').setAttribute('onsubmit', 'agregarFactura(' + proveedorActivo + ')');

    }

    function modalPagarFactura(factura, pendiente, proveedor) {
        document.getElementById('proveedorId_pagar').value = proveedor;
        document.getElementById('forma_pagar_factura').setAttribute('onsubmit', 'pagarFactura(' + factura + ',' + pendiente + ')');
        document.getElementById('importe_pagar').value = pendiente;

    }

    function pagarFactura(factura, pendiente) {
        $.post('<?=site_url('api/pagar_factura')?>/' + factura, $('#forma_pagar_factura').serialize(), function (data) {
            data = parseResponse(data);

            $('#pagar').modal('hide');
        });

    }

    function facturaRow(json, pendiente, tipo) {
        return `<tr>
    <td>${json.tipo}</td>
    <td>${fechaLinda(json.fecha_movimiento)}</td>
    <td>${Number(json.importe).formatMoney(2)}</td>
    <td class="text-xs-right">${Number(pendiente).formatMoney(2)}</td>
</tr>`
    }
    function parseResponse(data) {
        let response = JSON.parse(data);
        if (response.status == 'error') {
            alert(response.msg);
            return false
        } else {
            return response;
        }
    }

    function proveedor_info_template(info) {
        return `<div class="col-xs-12">
    <div class="col-xs-12" id="nombre_proveedor">Nombre: ${info.nombre}
        <div class="btn btn-sm btn-info" href="#modal_editar_proveedor" data-toggle="modal">Editar</div>
        <div class="btn btn-sm btn-success" href="#nuevafactura" data-toggle="modal" onclick="modalAgregarFactura('', ${info.dias})">Agregar Factura</div>
    </div>
    <div class="col-xs-6">Limite MN: ${Number(info.limite).formatMoney(2)}</div>
    <div class="col-xs-6">Disponible MN: <span id="disponible_mxn"
                                               data-disponible="${info.maximo_mxn}">${Number(info.maximo_mxn).formatMoney(2)}</span></div>
    <div class="col-xs-6">Limite USD: ${Number(info.limite_usd).formatMoney(2)}</div>
    <div class="col-xs-6">Disponible USD: <span id="disponible_usd" data-disponible="${info.maximo_mxn}">${Number(info.maximo_usd).formatMoney(2)}</span>
    </div>
    <div class="col-xs-6">RFC: ${info.rfc}</div>
    <div class="col-xs-6">Tel: ${info.telefono1}</div>
    <div class="col-xs-6">Contacto: ${info.contacto}</div>
    <div class="col-xs-6">Direccion: ${info.direccion_calle} ${info.direccion_num_ext}, ${info.direccion_fracc}</div>
</div>
<div class="clearfix"></div>
            `
    }


    function modalAgregarCargoAFactura(factura) {
        document.getElementById('input_cargo_a_factura_factura').value = factura;
        document.getElementById('forma_agregar_cargo').setAttribute('onsubmit', 'agregarCargoAFactura(' + factura + ')');
    }

    function agregarCargoAFactura(factura) {
        $.post('<?=site_url('api/agregar_cargo_a_factura')?>/' + factura + '/' + proveedorActivo,
            $('#forma_agregar_cargo').serialize(), function (data) {
                data = parseResponse(data);

                if (data.tipo == 'Cargo') {
                    pendiente = pendiente + Number(data.importe)
                } else {
                    pendiente = pendiente - Number(data.importe);
                }

                document.getElementById('rowsDeFactura' + factura).insertAdjacentHTML('beforeBegin', facturaRow(data, pendiente));
                $('#abonar').modal('hide');
            });
    }

    function modalEditarProveedor() {
        $('#actualizar_proveedor').modal('show');
    }

    function actualizarProveedor() {
        $.post('<?=site_url('api/actualizar_proveedor')?>', $('#proveedores_forma_edicion').serialize(), function (data) {
            if (data = parseResponse(data)) {
                location.reload();
            }


        })
    }

    function toTitleCase(str) {
        return str.replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    function fechaLinda(fecha) {
        options = {
            year: "numeric", month: "numeric", day: "numeric"
        };
        var d = new Date(fecha);
        return toTitleCase(d.toLocaleString('es-mx', options))
    }
    function horaLinda() {
    }


</script>