<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function loginUser() {

        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('login_view');

        } else {

            $this->load->model('Model_user');
            $reslt = $this->Model_user->checkLogin();

            if ($reslt != false) {

                //set session
                $username = $_POST['username'];
                $password = sha1($_POST['password']);

                //fetch from databse
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('username' => $username , 'password' => $password));
                $query = $this->db->get();

                $user = $query->row();

                //if use exists
                if ($user->username) {

                    //login message
                    $this->session->set_flashdata("success","You are logged in");

                    //set session variables
                    $_SESSION['user_logged'] = TRUE;
                    $_SESSION['username'] = $user->username;

                    //redirect
                    redirect('user/profile','refresh');

                }


            } else {

                //wrong credentials
                $this->session->set_flashdata('error','Username or Password invalid!');
                redirect('Home/Login');

            }
        }

    }
    //logging out of a user
    public function logoutUser() {
		unset($_SESSION);
		redirect('Home/Login');
	}
}
