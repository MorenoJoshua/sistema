<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistema extends CI_Controller
{

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/iniciar_sesion');
        $this->load->view('templates/footer');
    }

    public function admin()
    {
        $data['modulos'] = $this->db->get('admin_modulos')->result_array();

        $this->load->view('templates/header');
        $this->load->view('vistas/admin', $data);
        $this->load->view('formas/admin');
        $this->load->view('templates/footer');
    }

    public function admin_editar_modulo($moduloId)
    {
        $data['modulo'] = $this->db->where('id', $moduloId)->get('admin_modulos')->result_array();
        $data['submodulos'] = $this->db->where('modulo', $data['modulo'][0]['id'])->get('admin_modulos_submenus')->result_array();

        $this->load->view('templates/header');
        $this->load->view('vistas/admin_editar_modulo', $data);
//        $this->load->view('formas/admin');
        $this->load->view('templates/footer');
    }

    public function proveedores_vistas()
    {
        $this->load->view('templates/header');
        $this->load->view('vistas/proveedores/general');
        $this->load->view('formas/proveedores');
        $this->load->view('formas/proveedores_tipo');
        $this->load->view('formas/proveedores_sucursales');
        $this->load->view('templates/footer');
    }

    public function proveedores()
    {
        $this->load->view('templates/header');
        $this->load->view('vistas/proveedores/movimientos');
        $this->load->view('templates/footer');
    }

    public function proveedores_reportes()
    {
        $this->load->view('templates/header');
        $this->load->view('vistas/proveedores/reportes');
        $this->load->view('templates/footer');

    }

    public function proveedores_tipos()
    {
        $this->_wip();
    }

    private function _wip()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/wip');
        $this->load->view('templates/footer');
    }

    public function facturacion()
    {
        $this->_wip();
    }

    public function contratos()
    {
        $this->_wip();
    }

    public function cotizaciones()
    {
        $this->_wip();
    }

    public function maquinaria()
    {
        $this->_wip();
    }

    public function clientes()
    {
        $this->_wip();
    }

    public function parametros()
    {
        $this->_wip();
    }
}
