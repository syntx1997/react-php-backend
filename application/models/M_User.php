<?php

if(!defined('BASEPATH')) exit('No direct script access allowed!');

class M_User extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function add($firstname, $middlename, $lastname, $email) {
        $data = array(
            'firstname'     => $firstname,
            'middlename'    => $middlename,
            'lastname'      => $lastname,
            'email'         => $email
        );

        return $this->db->insert('users', $data);
    }

    public function get() {
        return $this->db->get('users')->result();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function edit($id, $firstname, $middlename, $lastname, $email) {
        $this->db->where('id', $id);
        return $this->db->update('users', array(
            'firstname'     => $firstname,
            'middlename'    => $middlename,
            'lastname'      => $lastname,
            'email'         => $email
        ));
    }

    public function register($username, $password) {
        return $this->db->insert('accounts', array(
            'username'      => $username,
            'password'      => $password,
            'access_token'  => md5($username . $password)
        ));
    }

    public function login($username, $password) {
        $data       = array();
        $login_details    = array(
            'username' => $username,
            'password' => $password
        );

        $this->db->where($login_details);
        $this->db->limit(1);
        $q = $this->db->get('accounts');

        if ($q->num_rows() > 0)
        {
            $data = $q->row_array();
        }

        $q->free_result();
        return $data;
    }
    
    public function check_token($token) {
        $data = array();

        $this->db->where('access_token', $token);
        $this->db->limit(1);
        $q = $this->db->get('accounts');

        if ($q->num_rows() > 0)
        {
            $data = $q->row_array();
        }

        $q->free_result();
        return $data;
    }

}