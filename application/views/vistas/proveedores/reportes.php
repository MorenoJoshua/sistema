<div class="col-xs-12">
    <form action="<?= site_url('api/reporte_saldos') ?>" method="post" id="forma_reporte_saldos" class="preventDefault"
          name="" onsubmit="generarReporte()">
        <input type="hidden" name="proveedor" id="proveedor">
        <div class=""><h1>
                Reporte
            </h1></div>
        <div class="form-group row">
            <div class="col-xs-12">
                <div class="col-xs-5 p-x-0">
                    <div class="input-group">
                        <label for="busqueda" class="input-group-addon">Proveedor:</label>
                        <input type="search" id="busqueda" class="form-control"
                               value="<?= @$_GET['proveedor'] ?>" placeholder="Busqueda por Nombre o RFC">
                    </div>
                </div>
                <div class="col-xs-3 p-x-0">
                    <div class="input-group">
                        <label for="fechas" class="input-group-addon">Fechas:</label>
                        <input type="text" name="fechas" id="fechas" class="form-control"
                               placeholder="mm/dd/aaaa - /mm/dd/aaaa">
                    </div>
                </div>
                <div class="col-xs-2 p-x-0">
                    <div class="input-group">
                        <label for="moneda" class="input-group-addon">Moneda:</label>
                        <select name="moneda" id="moneda" class="form-control p-a-0">
                            <option value="mxn">MN</option>
                            <option value="usd">USD</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs">
                    <input type="reset" class="btn btn-warning" value="Limpiar">
                    <input type="submit" class="btn btn-success" value="Generar">

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
        </div>
        <!--        <div class="form-group row">-->
        <!--            <div class="col-xs-6">-->
        <!--                <div class="input-group">-->
        <!--                    <label for="fecha_inicial" class="input-group-addon">Fecha Inicial:</label>-->
        <!--                    <input type="date" id="fecha_inicial" name="fecha_inicial" class="form-control">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-xs-6">-->
        <!--                <div class="input-group">-->
        <!--                    <label for="fecha_vencimiento" class="input-group-addon">Fecha de Vencimiento:</label>-->
        <!--                    <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <input type="reset" value="Limpiar forma" onclick="limpiarForma()">-->
        <!--        </div>-->
    </form>

    <div class="hidden-xs-up" id="showaftergenerar">
        <div class="col-xs-12">
            <h5>
                Exportar como:
                <form action="<?= site_url('api/renderPDF') ?>" method="post" class="d-inline">
                    <input type="hidden" name="url" id="urlToRenderPDF">
                    <input type="submit" name="simple" value="PDF Simple" id="isSimplePDF" class="btn btn-sm btn-warning">
                    <input type="submit" value="PDF" name="simple" class="btn btn-sm btn-warning">
                </form>
                <form action="<?= site_url('api/xslx') ?>" method="post" class="d-inline">
                    <input type="hidden" name="url" id="urlToRenderXSLX">
                    <input type="submit" value="XSLX" class="btn btn-sm btn-warning">
                </form>
            </h5>
            <span class="span">

            </span>
        </div>
    </div>

    <div class="" id="reportesAqui"></div>

    <script>
        var busquedainput = document.getElementById('busqueda');
        tempBusqueda = {};
        proveedorActivo = '';

        function generarReporte() {
            document.getElementById('showaftergenerar').classList.remove('hidden-xs-up')
            console.log($('#forma_reporte_saldos').serialize());
            $.post('<?=site_url('api/reporte_saldos')?>', $('#forma_reporte_saldos').serialize(), function (data) {
                data = parseResponse(data);
//                console.log(data);

                document.getElementById('reportesAqui').innerHTML = '';

                Object.keys(data).forEach(function (i) {
                    var toInsert = '';
                    var proveedor = data[i].facturas;
                    Object.keys(proveedor).forEach(function (x) {
                        var porMoneda = proveedor[x];
                        Object.keys(porMoneda).forEach(function (y) {
                            var cadaFactura = porMoneda[y];
                            toInsert += reporteRow(cadaFactura);
                        })
                    });

                    document.getElementById('reportesAqui').insertAdjacentHTML('afterBegin', tablaTemplate(data[i].info.nombre, toInsert, data[i].info.pendiente));

                });
            });

            var moneda = $('#moneda').val() || 'mxn';
            var proveedor = $('#proveedor').val() || '-';
            var fechas = $('#fechas').val() || '-';
            fechas = fechas.replace(/\//g, "-");
            var baseurl = '<?=site_url('api')?>';
            $('#urlToRenderPDF').val(`${baseurl}/pdf/${moneda}/${proveedor}/${fechas}`);
            $('#urlToRenderXSLX').val(`${baseurl}/xslx/${moneda}/${proveedor}/${fechas}`)

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

        function limpiarForma() {
            document.getElementById('proveedor').value = '';
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
                            `<a class="dropdown-item" href="#" onclick="seleccionarProveedor(${i.id})">${i.nombre} - ${i.rfc}</a>`);
                    });
                    data.nombre.forEach(function (i, k) {
                        document.getElementById('resultados_busqueda_proveedores_nombre').insertAdjacentHTML('afterBegin',
                            `<a class="dropdown-item" href="#" onclick="seleccionarProveedor(${i.id})">${i.nombre} - ${i.rfc}</a>`);
                    });
                }
            })
        });

        function seleccionarProveedor(xxx) {
            console.log(xxx);
            $.post('<?=site_url('api/info_proveedor/')?>/' + xxx, '', function (data) {
                data = parseResponse(data);
                document.getElementById('busqueda').value = data.info.nombre;
                document.getElementById('proveedor').value = data.info.id;
                document.getElementById('resultadosDropdown').classList.remove('open');

            });
        }

        function tablaTemplate(nombre, rows, pendiente) {
            return `
<h3>${nombre}</h3>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Factura</th>
        <th>Concepto</th>
        <th>Importe</th>
        <th>Pendiente</th>
        <th>Fecha de Creacion</th>
        <th>Fecha de Vencimiento</th>
    </tr>
    </thead>
    <tbody>
    ${rows}
    <tr>
    <td colspan="2"></td>
    <td>${pendiente}</td>
    <td colspan="2"></td>
</tr>
    </tbody>
</table>`
        }

        function reporteRow(info) {
            return `
<tr>
<td>${info.factura}</td>
<td>${info.concepto}</td>
<td>${info.importe} ${info.moneda}</td>
<td>${info.pendiente} ${info.moneda}</td>
<td>${info.fecha_movimiento}</td>
<td>${info.fecha_vencimiento}</td>
</tr>`
        }

        document.getElementById('busqueda').addEventListener('change', function (e) {
            console.log(e);
            if (document.getElementById('busqueda').value == '') {
                document.getElementById('proveedor').value = '';
            }
        });

        function generarPdf() {


        }

    </script>