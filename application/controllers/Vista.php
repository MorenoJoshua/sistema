<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vista extends CI_Controller
{

    public function index()
    {
        http_response_code(404);
    }

    public function html($folder, $archivo)
    {
        $this->load->view($folder . DIRECTORY_SEPARATOR . $archivo);
    }
}
