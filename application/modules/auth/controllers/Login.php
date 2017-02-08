<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Login extends MX_controller
{

	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
		if ( isset($_SESSION['logged_in']) )
		{
			redirect('home/dashboard');
		}
		
		$this->load->view('auth/login_view');
	}

	function validate()
	{
		$username 	= $_POST['username']; 
		$password 	= $_POST['password'];

		$isValidate = $this->db->query("SELECT * FROM user_auth INNER JOIN user ON u_id = ua_u_id WHERE ua_username = '".$username."' AND ua_password = '".md5($password)."'");

		if ($isValidate->num_rows() > 0)
		{
			$data = $isValidate->row();

			$setData = array(
						'userId' 	=> $data->ua_u_id,
						'roleId' 	=> $data->ua_r_id,
						'username'	=> $data->ua_username,
						'picture'	=> $data->u_logo_path,
						'logged_in'	=> TRUE
						);

			$this->session->set_userdata($setData);
			redirect('home/dashboard');
		}
		else
		{
			$this->session->set_flashdata('error', 'Username dan Password Salah');
			redirect('auth/login');
		}

	}

	function logout()
	{
		session_destroy();
		redirect('auth/login');
	}
	
}

?>