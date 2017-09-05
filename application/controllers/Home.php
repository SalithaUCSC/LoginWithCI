<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        $this->load->view('login_view');
    }

    public function Login() {
        $this->load->view('login_view');
    }

    public function Register() {
        $this->load->view('register_view');
    }

}

?>
