<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AuthModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function validate($nohp, $password)
    {
        $this->db->where('username', $nohp);
        $query = $this->db->get('user', 1)->row();

        if ($query == null) {
            return "UserNotFund";
        } else {
            if ($query->password != md5($password)) {
                return "PasswordWrong";
            } else {
                return $query;
            }
        }
    }
}
