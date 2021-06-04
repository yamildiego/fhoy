<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// if (file_exists($file = APPPATH . 'core/MY_controller.php')) {
//     include $file;
// }

class the_web extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['publicidades'] = '';
    }

    public function index() {
        $this->data['title'] = 'La Web';
        $this->View('the_web_view');
    }

    function proceso() {
        $pharmacies = $this->constructor_model->all_pharmacies();

        $listado = array();

        foreach ($pharmacies as $pharmacy) {
            $marker = new stdClass();

            $marker->id = $pharmacy->id;
            $marker->name = $pharmacy->name_pharmacy;

            $marker->location = 'Argentina, ' . $pharmacy->name_province . ', ' . $pharmacy->name_department . ', ' . $pharmacy->name_locality . ', ' . $pharmacy->address;

            $listado[] = $marker;
        }

        $this->data['listado'] = json_encode($listado);

        $this->load->view('proceso', $this->data);
    }

}
