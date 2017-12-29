<?php

class Base extends CI_Controller
{
    public $db;

    public function __construct()
    {

        $this->db = parent::get_instance()->db;
        $this->load = parent::get_instance()->load;

//        Strings primero, son utilizados en varios lugares
        define('SIST_VERSION', 'dev-0.1');
        define('SIST_NOMBRE', 'RMC');

//        Sidebars y asi
        if (isset($_SESSION['email']) && abs($_SESSION['time'] - time()) < (60 * 60 * 1000)) {
            if (count($_REQUEST) < 1) {
                header('location: ' . site_url('proveedores'));
            }
            define('NAVBAR_HTML', $this->navbar());
            define('SIDEBAR_HTML', $this->sidebar());
            define('MODALES', $this->modales());
        } else {
            define('NAVBAR_HTML', '');
            define('SIDEBAR_HTML', '');
            define('MODALES', '');

        }

    }

    public function navbar()
    {
        return $this->viewToVar('templates/navbar');
    }

    public function viewToVar($vista, $data = [])
    {
        ob_start();
        $this->load->view($vista, $data);
        $toreturn = ob_get_contents();
        ob_end_clean();
        return $toreturn;
    }

    public function sidebar()
    {
        $modulos = $this->db
            ->order_by('orden', 'asc')
            ->get('admin_modulos')
            ->result_array();

        $modulosLimpio = [];
        foreach ($modulos as $modulo) {
            $modulosLimpio[$modulo['id']] = $modulo;
            $modulosLimpio[$modulo['id']]['submodulos'] = $this->db
                ->where('modulo', $modulo['id'])
                ->get('admin_modulos_submenus')
                ->result_array();
        }

        $data['modulos'] = $modulosLimpio;

        return $this->viewToVar('templates/sidebar', $data);

    }

    public function modales()
    {
        return $this->viewToVar('templates/modales');
    }

    public function forma($vista, $action, $method)
    {
        $data['action'] = $action;
        $data['method'] = $method;
        $this->load->view('formas/' . $vista, $data);
    }

}