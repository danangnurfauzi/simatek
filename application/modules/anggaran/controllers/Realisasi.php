<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Realisasi extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}

		$this->load->helper('anggaran_helper');
		
	}

	function daftar( $tahun = '' )
	{

		if ($tahun == '')
		{
			$data['listing'] = $this->db->query("SELECT * FROM anggaran_master_kegiatan INNER JOIN anggaran_biaya_kegiatan ON abk_amk_id = amk_id WHERE amk_is_deleted = 0 AND abk_tahun = ".date("Y"));

			$data['selected'] = 0;
		}
		else
		{
			$data['listing'] = $this->db->query("SELECT * FROM anggaran_master_kegiatan INNER JOIN anggaran_biaya_kegiatan ON abk_amk_id = amk_id WHERE amk_is_deleted = 0 AND abk_tahun = ".$tahun);

			$data['selected'] = $tahun;
		}

		if($this->input->post('submit'))
		{
			redirect('anggaran/realisasi/daftar/'.$_POST['tahun']);
		}

		$data['tahun'] = $this->db->query('SELECT DISTINCT YEAR(p_tanggal_mulai) AS TAHUN FROM proposal');

		$this->load->view('realisasi/daftar_view',$data);
	}
	
}

?>