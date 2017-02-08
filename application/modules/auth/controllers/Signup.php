<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Signup extends MX_controller
{
	
	var $api = "";

	function __construct()
	{
		parent::__construct();
		
		$this->api = 'http://localhost/ikat.api/index.php/karyawan/';
		
	}

	function index()
	{
		$this->load->view('auth/signup_view');
	}

	function register()
	{
		//echo $_POST['npk'];
		$check = $this->rest->get($this->api.'checkNpk',array('npk'=>$_POST['npk']),'application/json');
		print_r($check);exit;
		if ($check->status == 'true')
		{

			$data = $this->rest->get($this->api.'dataKaryawanNpk',array('npk'=>$_POST['npk']),'application/json');

			$isRegister = $this->db->query('SELECT * FROM user_register WHERE ur_karyawan_id = '.$data->id);
			
			if ( $isRegister->num_rows() > 0 )
			{
				$this->session->set_flashdata('error', 'Anda Sudah Pernah Daftar');
				redirect('auth/login');
			}
			else
			{
				$this->db->trans_begin();

				$this->db->set('ur_aktivasi','1');
				$this->db->set('ur_karyawan_id',$data->id);
				$this->db->set('ur_created',date('Y-m-d H:i:j'));
				$this->db->insert('user_register');

				if ($this->db->trans_status() === FALSE)
				{
				    $this->db->trans_rollback();
				    $this->session->set_flashdata('error', 'Maaf Terjadi Kesalahan Sistem Saat Penyimpanan, Harap Ulangi Kembali');
					redirect('auth/signup');
				}
				else
				{
				    $this->db->trans_commit();
				    $this->session->set_flashdata('success', 'Register Anda Berhasil Silahkan Login Dengan Username dan Password Sesuai Akun IKaT');
					redirect('auth/login');
				}
			}

		}
		else
		{
			$this->session->set_flashdata('error', 'Maaf NPK Anda Salah.');
			redirect('auth/signup');
		}

		//print_r($check->status);
	}
	
}

?>