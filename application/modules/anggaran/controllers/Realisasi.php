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
		}
		else
		{
			$data['listing'] = $this->db->query("SELECT * FROM anggaran_master_kegiatan INNER JOIN anggaran_biaya_kegiatan ON abk_amk_id = amk_id WHERE amk_is_deleted = 0 AND abk_tahun = ".$tahun);
		}

		$this->load->view('realisasi/daftar_view',$data);
	}
	
}

?>