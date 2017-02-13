<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Dashboard extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}
		
	}

	function index()
	{
		
		$data = $this->db->query('SELECT * FROM user_auth WHERE ua_u_id = '.$_SESSION['userId'])->row();

		if ( $data->ua_password == md5('12345') )
		{
			$this->changeDefaultPassword();
		}
		else
		{
			$this->load->view('dashboard_view');
		}

	}

	function changeDefaultPassword()
	{
		$this->load->view('changeDefaultPassword_view');
	}

	function updatePassword()
	{
		if ($_POST['passw'] != $_POST['rePassw'])
		{
			$this->session->set_flashdata('error', 'Password baru dengan konfirmasi password tidak sama');
		    redirect('home/dashboard/changeDefaultPassword');
		}
		else
		{

			$this->db->trans_begin();

			$this->db->set('ua_password',md5($_POST['passw']));
			$this->db->set('ua_plaintext',$_POST['passw']);
			$this->db->where('ua_u_id',$_SESSION['userId']);
			$this->db->update('user_auth');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
			    redirect('home/dashboard/changeDefaultPassword');
			}
			else
			{
			    $this->db->trans_commit();
			    $this->session->set_flashdata('success', 'Password Berhasil di Ganti');
			    redirect('home/dashboard');
			}

		}
	}
	
}

?>