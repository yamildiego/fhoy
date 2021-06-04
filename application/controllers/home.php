<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// if (file_exists($file = APPPATH . 'core/MY_controller.php')) {
//     include $file;
// }

class home extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['title'] = 'Farmacias de turno';
    }

    function index() {
        $this->main();
    }

    function main($obj = null) {
        $date_pharmacy = date('Y-m-d');

        if ($obj == null)
            $location = null;
        else
            $location = $obj->location;

        //server local no lo soporta 
        //setlocale(LC_ALL, "es_ES");

        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $this->data['date'] = $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1];

        $this->data['form_open'] = form_open('home/validate');
        $this->data['form_close'] = form_close();
        $this->data['send'] = form_submit('send', 'Buscar', 'class="btn"');
        $this->data['locations'] = form_dropdown('location', $this->constructor_model->locations($date_pharmacy), $location, ' id="combobox" ');
        $this->data['publicidades'] = $this->load->view('publicidad_view', $this->data, true);
        $this->View('home_view');
    }

    function validate() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('location', 'localidad', 'callback__required_localidad');

        $obj = new stdClass();
        $obj->date_turn = date('Y-m-d');
        $obj->location = ($this->input->post('location') == 0) ? null : $this->input->post('location');

        if ($this->form_validation->run() == FALSE) {
            $this->index($obj);
        } else {
            $this->_see_pharmacy($obj);
        }
    }

    function _see_pharmacy($obj) {
        $pharmacies = $this->constructor_model->pharmacies_on_turn($obj);
        $obj2 = $obj;
        $date_temp2 = strtotime('+1 day', strtotime($obj2->date_turn));
        $obj2->date_turn = date('Y-m-d', $date_temp2);

        $pharmacies_manana = $this->constructor_model->pharmacies_on_turn($obj2);

        if ($pharmacies != false) {
            $pharmacy = $pharmacies[0];

            $hour = date('H');

            if ($hour < 8) {
                $date_temp = strtotime('+1 day', strtotime($pharmacy->date));
                $pharmacy->date = date('Y-m-d', $date_temp);
            }
            $this->data['publicidades'] = '';
            if ($pharmacy->locality_id == 1)
                $this->data['publicidades'] = $this->load->view('publi_cdelu_view', $this->data, true);
            if ($pharmacy->locality_id == 2)
                $this->data['publicidades'] = $this->load->view('publi_sanjo_view', $this->data, true);
            if ($pharmacy->locality_id == 3)
                $this->data['publicidades'] = $this->load->view('publi_colon_view', $this->data, true);
            if ($pharmacy->locality_id == 4)
                $this->data['publicidades'] = $this->load->view('publi_ve_view', $this->data, true);
            if ($pharmacy->locality_id == 6)
                $this->data['publicidades'] = $this->load->view('publi_gchu_view', $this->data, true);
            if ($pharmacy->locality_id == 7)
                $this->data['publicidades'] = $this->load->view('publi_villaguay_view', $this->data, true);
            if ($pharmacy->locality_id == 8)
                $this->data['publicidades'] = $this->load->view('publi_concordia_view', $this->data, true);
            if ($pharmacy->locality_id == 12)
                $this->data['publicidades'] = $this->load->view('publi_chajari_view', $this->data, true);

            $this->data['is_chajari'] = ($obj->location == 12);

            $this->data['pharmacies'] = $this->generar_html($pharmacies, strtotime($pharmacy->date), true);
            $this->data['pharmacies'].= $this->generar_html($pharmacies_manana, strtotime($obj2->date_turn), FALSE);
            $this->View('pharmacies_view');
        } else {
            $this->View('error_view');
        }
    }

    function generar_html($pharmacies, $day, $mostrar_volver_mapa) {
        $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $today = $dias[date('w', $day)] . " " . date('d', $day) . " de " . $meses[date('n', $day) - 1];
        $html = "";
        if ($pharmacies != false) {

            $pharmacy = $pharmacies[0];
            $html = $this->load->view('pharmacy_data_view', array('pharmacy' => $pharmacy, 'today' => $today, 'url_back' => base_url(), 'mostrar_volver' => $mostrar_volver_mapa), true);
            $markers = array();
            foreach ($pharmacies as $pharmacy) {
                $marker = new stdClass();

                $marker->name = $pharmacy->name_pharmacy;
                $marker->lat = ($pharmacy->latitude == null) ? 0 : $pharmacy->latitude;
                $marker->long = ($pharmacy->longitude == null) ? 0 : $pharmacy->longitude;

                $marker->location = 'Argentina, ' . $pharmacy->name_province . ', ' . $pharmacy->name_department . ', ' . $pharmacy->name_locality . ', ' . $pharmacy->address;

                $markers[] = $marker;

                $html.=$this->load->view('pharmacy_view', array('pharmacy' => $pharmacy), true);
            }
            if ($mostrar_volver_mapa)
                $html.= $this->load->view('pharmacy_map_view', array('markers' => json_encode($markers)), true);
        }
        return $html;
    }

    function _not_less_date($date) {
        $this->form_validation->set_message('_not_less_date', 'El campo <span class="bold">%s</span> es inválido.');
        $date_pharmacy = date('Y-m-d');
        return ($date_pharmacy <= $date);
    }

    function _required_localidad($id) {
        $this->form_validation->set_message('_required_localidad', 'El campo <span class="bold">%s</span> es obligatorio.');
        if ($id == null | $id == 0 | $id == false)
            return false;
        else
            return true;
    }

}
