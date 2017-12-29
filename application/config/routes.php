<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'sistema';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['(:any)'] = 'sistema/$1';
$route['vista/(:any)/(:any)'] = 'vista/html/$1/$2';
$route['admin_editar_modulo/(:any)'] = 'sistema/admin_editar_modulo/$1'; // arreglar esta cosa, no deveria haber una especifica
$route['admin_editar_modulo/(:any)/(:any)'] = 'sistema/admin_editar_modulo/$1/$2'; // arreglar esta cosa, no deveria haber una especifica
$route['(:any)/(:any)'] = '$1/$2';
$route['(:any)/(:any)/(:any)'] = '$1/$2/$3';
