<?php

class Model_user extends CI_Model {

    public function insertUser () {

        //insert data
        $data = array(
            //assign data into array elements
            'username' => $this->input->post('username'),
            'fname' => $this->input->post('fname'),
            'email' =>$this->input->post('email'),
            'contact' => $this->input->post('contact'),
            'nic' => $this->input->post('nic'),
            'password' => sha1($this->input->post('password'))

        );
        //insert data to the database
        $this->db->insert('users',$data);

    }

    public function checkLogin() {

        //enter username and password
        $username = $this->input->post('username',TRUE);
        $password = sha1($this->input->post('password',TRUE));

        //fetch data from database
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $res = $this->db->get('users');

        //check if there's a user with the above inputs
        if ($res->num_rows() == 1) {

            //retrieve the details of the user
            return $res->result();

        } else {

            return false;

        }

    }
}



?>
