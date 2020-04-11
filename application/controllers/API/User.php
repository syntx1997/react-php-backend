<?php

defined('BASEPATH') OR exit('No direct script access allowed!');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('M_User', 'user');
    }

    public function add() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $firstname  = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname   = $this->input->post('lastname');
        $email      = $this->input->post('email');

        if($this->user->add($firstname, $middlename, $lastname, $email)) {
            $inserted = true;
        } else {
            $inserted = false;
        }

        $data = array('inserted' => $inserted);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $data = $this->user->get();

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function delete() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $id = $this->input->post('id');

        if($this->user->delete($id)) {
            $deleted = true;
        } else {
            $deleted = false;
        }

        $data = array('deleted' => $deleted);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function edit() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $id         = $this->input->post('id');
        $firstname  = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname   = $this->input->post('lastname');
        $email      = $this->input->post('email');

        $this->user->edit($id, $firstname, $middlename, $lastname, $email);
    }

    public function register() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->user->register($username, $password);
    }

    public function login() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $login = $this->user->login($username, $password);

        if(count($login)) {
            $logged_in  = true;
            $token      = $login['access_token'];
        } else {
            $logged_in  = false;
            $token      = '';
        }

        $data = array(
            'logged_in' => $logged_in,
            'token'     => $token
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function check_token() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');

        $token = $this->input->post('token');

        $check_token = $this->user->check_token($token);

        if(count($check_token)) {
            $valid = true;
        } else {
            $valid = false;
        }

        $data = array('valid' => $valid);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

}