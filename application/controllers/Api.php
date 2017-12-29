<?php
setlocale(LC_MONETARY, 'es_MX');
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function index()
    {
        echo 'asas';
    }

    public function admin_editar_modulo($modulo)
    {
//        var_dump($_POST);
        if(isset($_POST['guardar']) && $_POST['guardar'] == 'Guardar'){
            unset($_POST['guardar']);
            if($this->db->where('id', $_POST['id'])->update('admin_modulos_submenus', $_POST)){
                header('location:'. site_url('admin_editar_modulo/' . $modulo));
            };
        }
    }

    public function admin($funcion = null, $extra = null)
    {
        $funcion = isset($_POST['funcion']) ? strtolower($_POST['funcion']) : $funcion;

        unset($_POST['funcion']);
        switch ($funcion) {
            case 'agregar':
                $this->db->insert('admin_modulos', $_POST);
                header('location: ' . site_url('admin'));
                break;
            case 'eliminar_modulo':
                $this->db->where('id', $extra)->delete('admin_modulos');
                header('location: ' . site_url('admin'));
                break;
        }
    }

    public function proveedores($funcion = null)
    {
        switch ($funcion) {
            case 'alta':
                $this->db->insert('proveedores', $_POST);
                header('location: ' . site_url('proveedores') . '?proveedor=' . $this->db->result_id);
                break;
            default:
        }
    }

    public function busqueda_json($funcion = null)
    {

//        SELECT * FROM `proveedores` p RIGHT JOIN sistema.`proveedores_movimientos` pm
//   ON (pm.`proveedor` = p.id) WHERE activo IS NULL AND pm.tipo = 'factura' GROUP BY pm.factura

        switch ($funcion) {
            case 'proveedores':
                echo json_encode([
                    'nombre' => $this->db->like('nombre', $_POST['busqueda'])->get('proveedores')->result_array(),
                    'rfc' => $this->db->like('rfc', $_POST['busqueda'])->get('proveedores')->result_array(),
                    'factura' => $this->db
                        ->join('proveedores_movimientos pm', 'pm.proveedor = p.id', 'left')
                        ->where('activo is null')
                        ->where('pm.tipo', 'factura')
                        ->like('pm.factura', $_POST['busqueda'])
                        ->group_by('p.id')
                        ->get('proveedores p')
                        ->result_array(),
                ]);
                break;
        }
    }

    public function abonar_a_factura($factId)
    {
        $_POST['factura'] = $factId;
        $this->db->where('factura', $factId)->where('proveedor', $_POST['proveedor'])->insert('proveedores_movimientos', $_POST);
        echo json_encode($this->db->where('factura', $factId)->order_by('id', 'desc')->get('proveedores_movimientos')->result_array()[0]);
    }

    public function pagar_factura($factId)
    {
        $_POST['factura'] = $factId;
        $this->db->insert('proveedores_movimientos', $_POST);

        $this->db->where('factura', $factId)->where('proveedor', $_POST['proveedor'])->where('factura', $factId)->update('proveedores_movimientos', ['activo' => '1']);

        echo json_encode($_POST);
    }

    public function agregar_factura($proveedor_id)
    {
        if (count($this->db->where('factura', $_POST['factura'])->get('proveedores_movimientos')->result_array()) != 0) {
            echo json_encode(['status' => 'error', 'msg' => 'factura existente']);
        } else {
            false;
            $_POST['proveedor'] = $proveedor_id;
            $this->db->insert('proveedores_movimientos', $_POST);
            echo json_encode($this->db->where('proveedor', $proveedor_id)->order_by('id', 'desc')->get('proveedores_movimientos')->result_array()[0]);
        }
    }

    public function contacto_proveedor($id)
    {
        $facturasTemp = $this->db
            ->where('proveedor', $id)
            ->where('activo is null')
            ->order_by('moneda', 'asc')
            ->order_by('factura', 'asc')
            ->get('proveedores_movimientos')
            ->result_array();

        $facturas = [];
        foreach ($facturasTemp as $ft) {
            $facturas[$ft['moneda']][$ft['factura']][] = $ft;
        }

        $toEcho = [
            'info' => $this->db
                ->where('id', $id)
                ->get('proveedores')
                ->result_array()[0],
            'facturas' => $facturas,
            'pendiente_mxn' => $this->db
                ->select('SUM(IF(tipo IN (\'factura\', \'cargo\'), importe, CONCAT(\'-\', importe))) as pendiente', false)
                ->where('activo is null')
                ->where('moneda', 'mxn')
                ->where('proveedor', $id)
                ->get('proveedores_movimientos')
                ->result_array()[0]['pendiente'],
            'pendiente_usd' => $this->db
                ->select('SUM(IF(tipo IN (\'factura\', \'cargo\'), importe, CONCAT(\'-\', importe))) as pendiente', false)
                ->where('activo is null')
                ->where('moneda', 'usd')
                ->where('proveedor', $id)
                ->get('proveedores_movimientos')
                ->result_array()[0]['pendiente'],
        ];

        $toEcho['info']['maximo_mxn'] = $toEcho['info']['limite'] - $toEcho['pendiente_mxn'];
        $toEcho['info']['maximo_usd'] = $toEcho['info']['limite_usd'] - $toEcho['pendiente_usd'];

        echo json_encode($toEcho['info']);
    }

    public function info_proveedor($id)
    {
        $facturasTemp = $this->db
            ->where('proveedor', $id)
            ->where('activo is null')
            ->order_by('moneda', 'asc')
            ->order_by('factura', 'asc')
            ->get('proveedores_movimientos')
            ->result_array();

        $facturas = [];
        foreach ($facturasTemp as $ft) {
            $facturas[$ft['moneda']][$ft['factura']][] = $ft;
        }

        $toEcho = [
            'info' => $this->db
                ->where('id', $id)
                ->get('proveedores')
                ->result_array()[0],
            'facturas' => $facturas,
            'pendiente_mxn' => $this->db
                ->select('SUM(IF(tipo IN (\'factura\', \'cargo\'), importe, CONCAT(\'-\', importe))) as pendiente', false)
                ->where('activo is null')
                ->where('moneda', 'mxn')
                ->where('proveedor', $id)
                ->get('proveedores_movimientos')
                ->result_array()[0]['pendiente'],
            'pendiente_usd' => $this->db
                ->select('SUM(IF(tipo IN (\'factura\', \'cargo\'), importe, CONCAT(\'-\', importe))) as pendiente', false)
                ->where('activo is null')
                ->where('moneda', 'usd')
                ->where('proveedor', $id)
                ->get('proveedores_movimientos')
                ->result_array()[0]['pendiente'],
        ];

        $toEcho['info']['maximo_mxn'] = $toEcho['info']['limite'] - $toEcho['pendiente_mxn'];
        $toEcho['info']['maximo_usd'] = $toEcho['info']['limite_usd'] - $toEcho['pendiente_usd'];

        echo json_encode($toEcho);
    }

    public function agregar_cargo_a_factura($facturaId, $proveedor)
    {
        $_POST['proveedor'] = $proveedor;
        $_POST['factura'] = $facturaId;
        $this->db->insert('proveedores_movimientos', $_POST);
        echo json_encode($this->db->where('proveedor', $proveedor)->order_by('id', 'desc')->get('proveedores_movimientos')->result_array()[0]);
    }

    public function actualizar_proveedor()
    {

//        var_dump($_POST);
        if (isset($_POST['rfc']) && $_POST['rfc'] != '') {
            $this->db->where('rfc', $_POST['rfc'])->update('proveedores', $_POST);
            echo json_encode($this->db->where('rfc', $_POST['rfc'])->get('proveedores')->result_array());
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Hubo un error']);
        }

    }

    public function reporte_saldos()
    {


        $proveedor_id = isset($_REQUEST['proveedor']) && $_REQUEST['proveedor'] != '' ? $_REQUEST['proveedor'] : null;
        $fecha_inicial = isset($_REQUEST['fecha_inicial']) && $_REQUEST['fecha_inicial'] != '' ? $_REQUEST['fecha_inicial'] : null;
        $fecha_final = isset($_REQUEST['fecha_vencimiento']) && $_REQUEST['fecha_vencimiento'] != '' ? $_REQUEST['fecha_vencimiento'] : null;

        if (isset($_REQUEST['fechas']) && $_REQUEST['fechas'] != '') {
            $fechas = $_REQUEST['fechas'];
            $fecha_inicial = date("Y-m-d", strtotime(substr($fechas, 0, 10)));
            $fecha_final = date("Y-m-d", strtotime(substr($fechas, 13, 10)));
        }

        $moneda = isset($_REQUEST['moneda']) && $_REQUEST['moneda'] != '' ? $_REQUEST['moneda'] : null;

        echo json_encode($this->_reporte_proveedor_saldos_por_proveedor($moneda, $proveedor_id, $fecha_inicial, $fecha_final), JSON_PRETTY_PRINT);
    }

    private function _reporte_proveedor_saldos_por_proveedor($moneda = null, $proveedor_id = null, $fecha_inicial = null, $fecha_final = null)
    {
        $ifMoneda = $moneda != null ? 'moneda = "' . $moneda . '"' : '1=1';
        $ifProveedor = $proveedor_id != null ? 'proveedor like "%' . $proveedor_id . '%"' : '1=1';
        $ifProveedorP = $proveedor_id != null ? 'id = ' . $proveedor_id : '1=1';
        if ($fecha_final != null && $fecha_inicial != null) {
            $ifFecha = <<<SQL
            fecha_vencimiento BETWEEN '$fecha_inicial' AND '$fecha_final'
SQL;
        } else {
            $ifFecha = '2=2';
        }
        $proveedoresTemp = $this->db->get('proveedores')->result_array();
        foreach ($proveedoresTemp as $x) {
            $proveedores[$x['id']] = $x;
        }
        $proveedores = $this->db
            ->where($ifProveedorP)
            ->get('proveedores')
            ->result_array();

        $proveedoresLimpio = [];
        foreach ($proveedores as $proveedorX) {
            $proveedoresLimpio[$proveedorX['id']] = $proveedorX;
        }

        $facturas = $this->db
            ->select('factura')
            ->where('activo is null')
            ->where('tipo', 'Factura')
            ->where($ifMoneda)
            ->where($ifProveedor)
            ->where($ifFecha)
            ->order_by('proveedor', 'asc')
            ->order_by('moneda', 'asc')
            ->order_by('id', 'asc')
            ->get('proveedores_movimientos')
            ->result_array();

        if (count($facturas) > 0) {
            $facturaLimpias = [];
            foreach ($facturas as $factura) {
                $facturaLimpias[] = $factura['factura'];
            }
            $movimientos = $this->db
                ->where('activo is null')
                ->where_in('factura', $facturaLimpias)
                ->order_by('proveedor', 'asc')
                ->order_by('moneda', 'asc')
                ->order_by('id', 'asc')
                ->get('proveedores_movimientos')
                ->result_array();
        } else {
            $movimientos = [];
        }


        $reporte = [];
        $reporteTemp = [];
        foreach ($movimientos as $movimiento) {
            $reporteTemp[$movimiento['factura']][] = $movimiento;
        }

        $pendientes = [];
        foreach ($reporteTemp as $fact => $mov) {
            if (!isset($pendientes[$mov[0]['proveedor']]['pendiente'])) {
                $pendientes[$mov[0]['proveedor']]['pendiente'] = 0;
            }

            $reporte[$mov[0]['proveedor']]['facturas'][$mov[0]['moneda']][$fact] = $mov[0];
            $reporte[$mov[0]['proveedor']]['facturas'][$mov[0]['moneda']][$fact]['pendiente'] = 0;
            foreach ($mov as $m) {
                if ($m['tipo'] == 'Cargo' || $m['tipo'] == 'Factura') {
                    $importe = $m['importe'];
                } else {
                    $importe = 0 - $m['importe'];
                }
                $reporte[$mov[0]['proveedor']]['facturas'][$mov[0]['moneda']][$fact]['pendiente'] =
                    $reporte[$mov[0]['proveedor']]['facturas'][$mov[0]['moneda']][$fact]['pendiente'] + $importe;
                $pendientes[$mov[0]['proveedor']]['pendiente'] =
                    $pendientes[$mov[0]['proveedor']]['pendiente'] + $importe;
            }
            $reporte[$mov[0]['proveedor']]['info'] = $proveedoresLimpio[$mov[0]['proveedor']];
            foreach ($pendientes as $k => $pendienteProveedor) {
                $reporte[$k]['info']['pendiente'] = $pendienteProveedor['pendiente'];
            }
        }

        return $reporte;

    }

    public function login()
    {
//        var_dump($_REQUEST);
        if (isset($_REQUEST['usuario']) && isset($_REQUEST['password'])) {
            if ($_REQUEST['password'] == 'admin' && $_REQUEST['usuario'] == 'admin') {
                $_SESSION['email'] = true;
                $_SESSION['time'] = time();

                header('location: ' . site_url('proveedores'));
            }
        }
    }

    public function kill()
    {
        unset($_SESSION);
        session_destroy();

        header('location: ' . site_url(''));
    }

    public function renderPDF()
    {
        date_default_timezone_set('America/Tijuana');

//        var_dump($_POST);
        $outfile = '/var/www/sites/sist/out/out.pdf';
        $cmd = 'wkhtmltopdf "' . $_POST['url'] . '" ' . $outfile;
//        var_dump($cmd);
        exec($cmd);
        header('content-type: application/pdf');
        echo file_get_contents($outfile);
        unlink($outfile);
    }

    public function xslx($moneda = 'mxn', $proveedor = null, $fechas = null)
    {
        // pdf y xslx comienzan igual, actualizar si hay cambios
        // consolidar despues
        date_default_timezone_set('America/Tijuana');

        $proveedor = $proveedor == '-' ? null : $proveedor;
        $fechas = $fechas == '-' ? null : urldecode($fechas);

        if ($fechas != null) {
            $fecha_inicial = date("Y-m-d", strtotime(substr($fechas, 0, 10)));
            $fecha_final = date("Y-m-d", strtotime(substr($fechas, 15, 10)));
        } else {
            $fecha_final = null;
            $fecha_inicial = null;
        }
        $proveedor_id = $proveedor != null ? $proveedor : null;


        $reporte = $this->_reporte_proveedor_saldos_por_proveedor($moneda, $proveedor_id, $fecha_inicial, $fecha_final);

        $reporteLimpio = [];
        $reporteLimpio[] = [
            'Factura',
            'Concepto',
            'Importe',
            'Pendiente',
            'Fecha De Creacion',
            'Fecha De Vencimiento',
        ];
        $totalDeTotales = 0;
        foreach ($reporte as $provID => $provInfo) {
            $info = $provInfo['info'];
            $reporteLimpio[] = [$info['rfc'], $info['nombre'], $info['pendiente']];
            foreach ($provInfo['facturas'] as $moneda => $facturas) {
                $total = 0;
                foreach ($facturas as $factura) {
                    $reporteLimpio[] = [
                        $factura['factura'],
                        $factura['concepto'],
                        $this->_f_mon($factura['importe']),
                        $this->_f_mon($factura['pendiente']),
                        $this->_f_fecha($factura['fecha_movimiento']),
                        $this->_f_fecha($factura['fecha_vencimiento']),
                    ];
                    $total += $factura['pendiente'];
                }
                $reporteLimpio[] = ['', 'Total:', $this->_f_mon($total)];
                $reporteLimpio[] = [''];
                $totalDeTotales += $total;
            }
            $reporteLimpio[] = ['Total General:', $this->_f_mon($totalDeTotales)];
        }


        $excel = new PHPExcel();
        $sheet = $excel->getActiveSheet();
        $sheet->fromArray($reporteLimpio);
//        $lineas = count($reporteLimpio);
//        $i = 1;
        $sheet->calculateColumnWidths();


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
        exit;


    }

    private function _f_mon($cantidad)
    {
        return money_format('%n', $cantidad);
    }

    private function _f_fecha($fecha)
    {
        $separador = '-';
        return substr($fecha, 8, 2) . $separador . substr($fecha, 5, 2) . $separador . substr($fecha, 0, 4);
    }

    public function pdf($moneda = 'mxn', $proveedor = null, $fechas = null)
    {
//        die($_REQUEST['fechas']);
        // pdf y xslx comienzan igual, actualizar si hay cambios
        // consolidar despues
        date_default_timezone_set('America/Tijuana');

        $proveedor = $proveedor == '-' ? null : $proveedor;
        $fechas = $fechas == '-' ? null : preg_replace('/-/', '/', urldecode($fechas));


        if ($fechas != null) {
            $fecha_inicial = date("Y-m-d", strtotime(substr($fechas, 0, 10)));
            $fecha_final = date("Y-m-d", strtotime(substr($fechas, 13, 10)));
        } else {
            $fecha_final = null;
            $fecha_inicial = null;
        }
        $proveedor_id = $proveedor != null ? $proveedor : null;

        $reporte = $this->_reporte_proveedor_saldos_por_proveedor($moneda, $proveedor_id, $fecha_inicial, $fecha_final);

        $totalDeTotales = 0;

        $logoUrl = base_url('assets/imagenes/rmclogo.png');

        echo <<<HTML
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/custom.css">

<style>
td {
font-size: 9pt !important;
line-height: 1em;
text-align: right;
}
tr {
line-height: 1em;
    page-break-inside: avoid;
}
th {
font-size: 10pt !important;
}
@media print {
    .element-that-contains-table {
        overflow: visible !important;
    }
    
    div.header {
    position: fixed;
    bottom: 0;
  }
}

tr.simple {
display: none;
}

@media screen {
  div.header {
    display: none;
  }
}
.grande {
font-size: large;
}
</style>

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    </head>
<body>
<div class="">
<div class="col-xs-12 p-x-0"><img src="$logoUrl" alt="" class="col-xs-6"></div>
<p class="col-xs-12 p-l-2 h5">Rentas Martin del Campo S.A.</p>
<br>
</div>


HTML;
        $display = '';
        if (isset($_POST['simple']) && $_POST['simple'] == 'PDF Simple') {
            $display = 'simple';
        } elseif (isset($_POST['simple']) && $_POST['simple'] == 'PDF'){
            $display = 'normal';
        }

        foreach ($reporte as $k => $v) {
            $rows = '';
            $totalPendiente = 0;

            foreach ($v['facturas'][$moneda] as $factura) {
                $fecha_movimiento = $this->_f_fecha($factura['fecha_movimiento']);
                $fecha_vencimiento = $this->_f_fecha($factura['fecha_vencimiento']);
                $importe = $this->_f_mon($factura['importe']);
                $pendiente = $this->_f_mon($factura['pendiente']);
                $rows .= <<<HTML
<tr class="{$display}">
<td>{$factura['factura']}</td>
<td>{$factura['concepto']}</td>
<td>{$importe}</td>
<td>{$pendiente}</td>
<td>{$fecha_movimiento}</td>
<td>{$fecha_vencimiento}</td>
</tr>
                
HTML;
                $totalPendiente += $factura['pendiente'];
            }

            $fechasEcho = 'De: ' . $this->_f_fecha($fecha_inicial) . ' a ' . $this->_f_fecha($fecha_final);
            $fechasEcho = strlen($fechasEcho) < 15 ? '' : $fechasEcho;
            $echomoneda = $this->_f_moneda($moneda);
            echo <<<HTML


<div class="container-fluid element-that-contains-table">
<table class="table table-bordered table-condensed w-100">
<thead>
</tr>
<tr>
<th colspan="6"><b class="grande">{$v['info']['nombre']}</b><br>Facturas por pagar en {$echomoneda} </div>
<div class="">$fechasEcho</div></th>
</tr>
<tr class="$display">
<th>Factura</th>
<th>Concepto</th>
<th>Importe</th>
<th>Pendiente</th>
<th>F. Creacion</th>
<th>F. Vencimiento</th>
</tr>
</thead>
<tbody>
$rows
<tr>
<td></td>
<td></td>
<td>Total</td>
<td>{$this->_f_mon($totalPendiente)}</td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
</div>



HTML;

            $totalDeTotales += $totalPendiente;


        }

        echo <<<HTML

<h4 class="text-xs-right">Total general: {$this->_f_mon($totalDeTotales)}</h4>

HTML;


    }

    private function _f_moneda($moneda)
    {
        if ($moneda == 'mxn') {
            return 'MN';
        } elseif ($moneda == 'usd') {
            return 'USD';
        } else {
            return $moneda;
        }
    }


}