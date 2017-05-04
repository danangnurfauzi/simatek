<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Anggaran extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}
		
	}

	function daftar( $tahun = '' )
	{
		switch ($_SESSION['roleId']) {
			case '1':
				if($tahun == '')
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8');

					$data['selected'] = 0;
				}
				else
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8 AND YEAR(p_tanggal_mulai) = '.$tahun);

					$data['selected'] = $tahun;
				}
				
				break;
			
			case '2':
				if($tahun == '')
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id WHERE p_status = 8 AND p_u_id = '.$_SESSION['userId']);

					$data['selected'] = 0;
				}
				else
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id WHERE p_status = 8 AND p_u_id = '.$_SESSION['userId'].' AND YEAR(p_tanggal_mulai) = '.$tahun);

					$data['selected'] = $tahun;
				}
				
				break;

			case '3':
				if($tahun == '')
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8');

					$data['selected'] = 0;
				}
				else
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8 AND YEAR(p_tanggal_mulai) = '.$tahun);

					$data['selected'] = $tahun;
				}
				
				break;

			case '4':
				if($tahun == '')
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8');

					$data['selected'] = 0;
				}
				else
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 8 AND YEAR(p_tanggal_mulai) = '.$tahun);

					$data['selected'] = $tahun;
				}
				
				break;

			case '5':
				
				$idProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row()->ua_p_id;

				if($tahun == '')
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id LEFT JOIN user_auth ON ua_u_id = p_u_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5 AND ua_p_id = '.$idProdi);

					$data['selected'] = 0;
				}
				else
				{
					$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id LEFT JOIN user_auth ON ua_u_id = p_u_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5 AND ua_p_id = '.$idProdi.' AND YEAR(p_tanggal_mulai) = '.$tahun);

					$data['selected'] = $tahun;
				}
				
				break;
		}

		$data['tahun'] = $this->db->query('SELECT DISTINCT YEAR(p_tanggal_mulai) AS TAHUN FROM proposal');

		$data['mata'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');

		$data['lkm'] = $this->db->query('SELECT * FROM user INNER JOIN user_auth ON u_id = ua_u_id WHERE ua_r_id = 2');

		$data['kegiatan'] = $this->db->query('SELECT * FROM jenis_kegiatan');

		if($this->input->post('submit'))
		{
			redirect('proposal/laporan/daftar/'.$_POST['tahun']);
		}
		
		$this->load->view('pelaporan/anggaran/daftar_view',$data);	
	}

	public function dataPost()
	{
		echo "<pre>";
		print_r($_POST);
	}
	
}

?>