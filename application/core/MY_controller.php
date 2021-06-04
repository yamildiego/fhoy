<?php

class MY_Controller extends CI_Controller {

    protected $data;

    function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    function View($view) {
        $this->data['layout'] = $this->load->view($view, $this->data, true);
        $this->load->view('layout_view', $this->data);
    }

}
