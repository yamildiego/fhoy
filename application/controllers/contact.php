<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// if (file_exists($file = APPPATH . 'core/MY_controller.php')) {
//     include $file;
// }

class contact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['publicidades'] = '';
        $this->load->library('session');
    }

    public function index() {
        $this->main();
    }

    function main($obj = null) {
        if ($obj == null) {
            $obj = new stdClass;
            $obj->name = "";
            $obj->last_name = "";
            $obj->email = "";
            $obj->phone = "";
            $obj->message = "";
        }

        $this->data['title'] = 'Contactenos';

        $this->data['form_open'] = form_open('contact/validate', array('autocomplete' => 'off'));
        $this->data['form_close'] = form_close();
        $this->data['name'] = form_input('name', $obj->name, 'class="w90"');
        $this->data['last_name'] = form_input('last_name', $obj->last_name, 'class="w90"');
        $this->data['email'] = form_input('email', $obj->email, 'class="w90"');
        $this->data['phone'] = form_input('phone', $obj->phone, 'class="w90"');
        $this->data['message'] = form_textarea('message', $obj->message, 'class="w90" style="max-width:285px; max-height:150px; resize: none;"');
        $this->data['send'] = form_submit('send', 'Enviar', 'class="btn"');

        $this->View('contact_view');
    }

    function validate() {
        $this->data['title'] = 'Farmacias por localidad';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'nombre', 'required');
        $this->form_validation->set_rules('last_name', 'apellido', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'email', '');
        $this->form_validation->set_rules('message', 'mensaje', 'required');

        $obj = (object) $this->input->post();

        if ($this->form_validation->run() == FALSE) {
            $this->main($obj);
        } else {
            $mensaje = $this->load->view('email_view', array('obj' => $obj), true);
            if ($this->_send_email($obj->email, 'yamildiego@gmail.com', $mensaje, 'Consulta WEB')) {
                $this->session->set_flashdata('mensaje', '<div class="ok">Su mensaje se envio con &eacute;xito.</div>');
                redirect('contact');
            }
        }
    }

    function _send_email($p_email_from, $p_email_to, $p_message, $p_subject) {
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from($p_email_from, 'FarmaciasDuTurnoHoy');
        $this->email->to($p_email_to);
        $this->email->subject($p_subject);
        $this->email->message($p_message);
        return $this->email->send();
    }

}
