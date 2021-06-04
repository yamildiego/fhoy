<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// if (file_exists($file = APPPATH . 'core/MY_controller.php')) {
//     include $file;
// }

class pharmacies_for_locality extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->data['publicidades'] = '';
    }
    public function index() {
        $this->main();
    }

    function main($obj = null) {
        $this->data['title'] = 'Farmacias por localidad';

        $this->data['form_open'] = form_open('pharmacies_for_locality/validate');
        $this->data['form_close'] = form_close();
        $this->data['send'] = form_submit('send', 'Buscar', 'class="btn"');
        $this->data['locations'] = form_dropdown('location', $this->constructor_model->all_locations_dropdown(), null, ' id="combobox" ');

        $this->View('pharmacies_for_locality_view');
    }

    function validate() {
        $this->data['title'] = 'Farmacias por localidad';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('location', 'localidad', 'callback__required_localidad');

        $obj = new stdClass();
        $obj->location = ($this->input->post('location') == 0) ? null : $this->input->post('location');

        if ($this->form_validation->run() == FALSE) {
            $this->main($obj);
        } else {
            $this->_see_localities($obj);
        }
    }

    function _see_localities($obj) {
        $this->data['title'] = 'Farmacias por localidad';

        $pharmacies = $this->constructor_model->all_pharmacies_by_locations($obj->location);

        $pharmacy = $pharmacies[0];

        $html = $this->load->view('pharmacy_data_view', array('pharmacy' => $pharmacy, 'url_back' => base_url('pharmacies_for_locality')), true);

        foreach ($pharmacies as $pharmacy)
            $html.=$this->load->view('pharmacy_view', array('pharmacy' => $pharmacy), true);

        $this->data['pharmacies'] = $html;


        $this->View('pharmacies_for_locality_list_view');
    }

    function _required_localidad($id) {
        $this->form_validation->set_message('_required_localidad', 'El campo <span class="bold">%s</span> es obligatorio.');
        if ($id == null | $id == 0 | $id == false)
            return false;
        else
            return true;
    }

}
