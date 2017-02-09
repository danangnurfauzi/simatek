<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Laporan extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}

		$this->load->helper('laporan_helper');
		
	}

	function daftar()
	{
		switch ($_SESSION['roleId']) {
			case '1':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5');
				break;
			
			case '2':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id WHERE p_status = 5 AND p_u_id = '.$_SESSION['userId']);
				break;

			case '3':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5');
				break;

			case '4':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5');
				break;

			case '5':
				
				$idProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row()->ua_p_id;

				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN laporan ON p_id = l_p_id LEFT JOIN user_auth ON ua_u_id = p_u_id INNER JOIN user ON p_u_id = u_id WHERE p_status = 5 AND ua_p_id = '.$idProdi);
				
				break;
		}
		
		$this->load->view('laporan/daftar_view',$data);	
	}

	function create($id)
	{
		$data['id'] = $id;
		$data['proposal'] = $this->db->query("SELECT * FROM proposal WHERE p_id = ".$id)->row();
		$this->load->view('laporan/create_view',$data);	
	}

	function insert($id)
	{
		//echo "<pre>";
		//print_r($_POST);
		//print_r($_FILES);
		//exit;
		$this->db->trans_begin();

		$this->db->set('l_p_id',$id);
        $this->db->set('l_luaran',$_POST['luaran']);
        $this->db->set('l_evaluasi',$_POST['evaluasi']);
        $this->db->set('l_realisasi_dana',$_POST['biaya']);
        $this->db->set('l_dokumentasi_link',$_POST['linkBerita']);
        $this->db->set('l_created',date('Y-m-d H:i:j'));
        $this->db->insert('laporan');

        $lastId = $this->db->insert_id();

        $this->db->set('tl_l_id',$lastId);
        $this->db->set('tl_status','0');
        $this->db->set('tl_created',date('Y-m-d H:i:j'));
        $this->db->insert('trx_laporan');

        $lastTrxId = $this->db->insert_id();

        $this->db->set('l_tl_id',$lastTrxId);
        $this->db->where('l_id',$lastId);
        $this->db->update('laporan');

        if ($_FILES['kuitansi']['name'] != '')
        {

	        $filename = $id.'_.pdf';

			$config['upload_path']          = './assets/dokumentasi/kuitansi';
	        $config['allowed_types']        = 'pdf|PDF|png|jpg|jpeg|JPG|PNG|JPEG';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 3072;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('kuitansi'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('l_file_kuitansi_path','assets/dokumentasi/kuitansi/'.$filename);
	            $this->db->set('l_file_kuitansi',$filename);
	            $this->db->where('l_id',$lastId);
	            $this->db->update('laporan');
	        }
        }

        if ($_FILES['foto1']['name'] != '')
        {
        	//echo "<pre>";print_r($_FILES['foto1']);exit;
	        $filename1 = $id.'_1.png';

			$config1['upload_path']         = './assets/dokumentasi/photo';
	        $config1['allowed_types']       = 'png|jpg|jpeg|JPG|PNG|JPEG';
	        $config1['overwrite']           = TRUE;
	        $config1['max_size']           	= 1024;
	        $config1['file_name'] 			= $filename1;

	        $this->load->library('upload', $config1);

	        $this->upload->initialize($config1);
	        if ( ! $this->upload->do_upload('foto1'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            //print_r($error);exit;
	            $this->session->set_flashdata('errorp1', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('l_file_photo1_path','assets/dokumentasi/photo/'.$filename1);
	            $this->db->set('l_file_photo1',$filename1);
	            $this->db->where('l_id',$lastId);
	            $this->db->update('laporan');
	        }
        }

        if ($_FILES['foto2']['name'] != '')
        {

	        $filename2 = $id.'_2.png';

			$config2['upload_path']         = './assets/dokumentasi/photo';
	        $config2['allowed_types']       = 'png|jpg|jpeg|JPG|PNG|JPEG';
	        $config2['overwrite']           = TRUE;
	        $config2['max_size']          	= 1024;
	        $config2['file_name'] 			= $filename2;

	        $this->load->library('upload', $config2);

	        $this->upload->initialize($config2);
	        if ( ! $this->upload->do_upload('foto2'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorp2', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('l_file_photo2_path','assets/dokumentasi/photo/'.$filename2);
	            $this->db->set('l_file_photo2',$filename2);
	            $this->db->where('l_id',$lastId);
	            $this->db->update('laporan');
	        }
        }

        if ($_FILES['foto3']['name'] != '')
        {

	        $filename3 = $id.'_3.png';

			$config3['upload_path']         = './assets/dokumentasi/photo';
	        $config3['allowed_types']       = 'png|jpg|jpeg|JPG|PNG|JPEG';
	        $config3['overwrite']         	= TRUE;
	        $config3['max_size']          	= 1024;
	        $config3['file_name'] 			= $filename3;

	        $this->load->library('upload', $config3);

	        $this->upload->initialize($config3);
	        if ( ! $this->upload->do_upload('foto3'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorp3', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('l_file_photo3_path','assets/dokumentasi/photo/'.$filename3);
	            $this->db->set('l_file_photo3',$filename3);
	            $this->db->where('l_id',$lastId);
	            $this->db->update('laporan');
	        }
        }

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/laporan/daftar');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Laporan Berhasil di Buat');
		    redirect('proposal/laporan/daftar');
		}

	}

	function edit($id)
	{
		$data['proposal'] = $this->db->query('SELECT * FROM proposal WHERE p_id = '.$id)->row();
		$data['jenis'] = $this->db->query('SELECT * FROM jenis_kegiatan');
		$this->load->view('edit_view',$data);
	}

	function update($id)
	{
		$this->db->trans_begin();

        $this->db->set('p_jk_id',$_POST['jenisKegiatan']);
        $this->db->set('p_lingkup',$_POST['lingkupKegiatan']);
        $this->db->set('p_kegiatan',$_POST['nama']);
        $this->db->set('p_tujuan',$_POST['tujuan']);
        $this->db->set('p_tempat',$_POST['tempat']);
        $this->db->set('p_penanggung_jawab',$_POST['penanggungJawab']);
        $this->db->set('p_ringkasan',$_POST['ringkasan']);
        $this->db->set('p_handphone',$_POST['hp']);
        $this->db->set('p_tanggal_mulai',$_POST['tanggalMulai']);
        $this->db->set('p_tanggal_selesai',$_POST['tanggalSelesai']);
        $this->db->set('p_biaya',$_POST['biaya']);
        $this->db->set('p_updated',date('Y-m-d H:i:j'));
        $this->db->where('p_id',$id);
        $this->db->update('proposal');

        $setFileName = str_replace(' ', '_', $_POST['nama']);

        $filename = $id.'_'.$setFileName.'.pdf';

		$config['upload_path']          = './assets/rab';
        $config['allowed_types']        = 'pdf|PDF';
        $config['overwrite']           	= TRUE;
        $config['max_size']            	= 3072;
        $config['file_name'] 			= $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('filesRab'))
        {
            $error = array('error' => $this->upload->display_errors());
            
            $this->session->set_flashdata('errorf', $error);
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('p_file_rab_path','assets/rab/'.$filename);
            $this->db->set('p_file_rab',$filename);
            $this->db->where('p_id',$id);
            $this->db->update('proposal');
        }

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/pengajuan/daftar');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
		    redirect('proposal/pengajuan/daftar');
		}
	}

	function delete($id)
	{
		$this->db->trans_begin();

		$detail = $this->db->query("SELECT * FROM proposal WHERE p_id = ".$id)->row();

		$baseUrl = $_SERVER['DOCUMENT_ROOT'];
		//echo $baseUrl;exit;
		if(unlink($baseUrl.'/lkmumy/'.$detail->p_file_path))
		$this->db->where('p_id',$id);
		$this->db->delete('proposal');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/pengajuan/daftar');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Hapus Data Berhasil');
		    redirect('proposal/pengajuan/daftar');
		}
	}

	function proses($id)
	{
		$data['proposal'] = $this->db->query('SELECT * FROM proposal INNER JOIN laporan ON p_id = l_p_id WHERE p_id = '.$id)->row();
		
		$data['catatan'] = $this->db->query('
										SELECT * 
										FROM trx_laporan 
										INNER JOIN laporan ON l_id = tl_l_id
										INNER JOIN proposal ON p_id = l_p_id 
										INNER JOIN user ON u_id = tl_u_id 
										INNER JOIN user_auth ON ua_u_id = u_id
										INNER JOIN role ON r_id = ua_r_id
										WHERE tl_catatan IS NOT NULL AND p_id = '.$id);

		$this->load->view('laporan/proses_view',$data);
	}

	function prosesSet($laporanId)
	{
		$this->db->trans_begin();

		$this->db->set('tl_l_id',$laporanId);
		$this->db->set('tl_u_id',$_SESSION['userId']);
		$this->db->set('tl_status',$_POST['status']);
		$this->db->set('tl_catatan',$_POST['catatan']);
		$this->db->set('tl_created',date('Y-m-d H:i:j'));
		$this->db->insert('trx_laporan');

		$trxId = $this->db->insert_id();

		$this->db->set('l_status',$_POST['status']);
		$this->db->set('l_tl_id',$trxId);
		$this->db->where('l_id',$laporanId);
		$this->db->update('laporan');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/laporan/daftar');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Proses Proposal Berhasil Di Ubah');
		    redirect('proposal/laporan/daftar');
		}
	}

	function revisi( $id , $trxId )
	{
		$data['proposal'] = $this->db->query('SELECT * FROM proposal WHERE p_id = '.$id)->row();
		$data['jenis'] = $this->db->query('SELECT * FROM jenis_kegiatan');
		$data['catatan'] = $this->db->query('
										SELECT * 
										FROM trx_pengajuan 
										INNER JOIN proposal ON p_id = tp_p_id 
										INNER JOIN user ON u_id = tp_u_id 
										INNER JOIN user_auth ON ua_u_id = u_id
										INNER JOIN role ON r_id = ua_r_id
										WHERE tp_catatan IS NOT NULL AND tp_p_id = '.$id);

		$this->load->view('revisi_view',$data);
	}

	function updateRevisi( $id , $trxId )
	{
		
		$this->db->trans_begin();

		$this->db->set('p_u_id',$_SESSION['userId']);
        $this->db->set('p_jk_id',$_POST['jenisKegiatan']);
        $this->db->set('p_kegiatan',$_POST['nama']);
        $this->db->set('p_lingkup',$_POST['lingkupKegiatan']);
        $this->db->set('p_tujuan',$_POST['tujuan']);
        $this->db->set('p_tempat',$_POST['tempat']);
        $this->db->set('p_penanggung_jawab',$_POST['penanggungJawab']);
        $this->db->set('p_ringkasan',$_POST['ringkasan']);
        $this->db->set('p_handphone',$_POST['hp']);
        $this->db->set('p_tanggal_mulai',$_POST['tanggalMulai']);
        $this->db->set('p_tanggal_selesai',$_POST['tanggalSelesai']);
        $this->db->set('p_biaya',$_POST['biaya']);
        $this->db->set('p_latar_belakang',$_POST['latarBelakang']);
        $this->db->set('p_luaran',$_POST['luaran']);
        $this->db->set('p_penanggung_jawab1',$_POST['penanggungJawab1']);
        $this->db->set('p_handphone1',$_POST['hp1']);
        $this->db->set('p_is_pihak_luar',$_POST['statusPihakLuar']);
        $this->db->set('p_pihak_luar_nama',$_POST['namaPihakLuar']);
        $this->db->set('p_pihak_luar_telephone',$_POST['nomorPihakLuar']);
        $this->db->set('p_pihak_luar_instansi',$_POST['organisasiPihakLuar']);
        $this->db->set('p_updated',date('Y-m-d H:i:j'));
        $this->db->where('p_id',$id);
        $this->db->update('proposal');

        $this->db->set('tp_updated',date('Y-m-d H:i:j'));
        $this->db->where('tp_id',$trxId);
        $this->db->update('trx_pengajuan');

        $setFileName = str_replace(' ', '_', $_POST['nama']);

        $filename = $id.'_'.$setFileName.'.pdf';

		$config['upload_path']          = './assets/rab';
        $config['allowed_types']        = 'pdf|PDF';
        $config['overwrite']           	= TRUE;
        $config['max_size']            	= 3072;
        $config['file_name'] 			= $filename;

        $this->load->library('upload', $config);

        /**if ( ! $this->upload->do_upload('files'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errorf', $error);
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('p_file_path','assets/proposal/'.$filename);
            $this->db->set('p_file',$filename);
            $this->db->where('p_id',$id);
            $this->db->update('proposal');
        }**/

        if ( ! $this->upload->do_upload('filesRab'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errorf', $error);
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('p_file_rab_path','assets/rab/'.$filename);
            $this->db->set('p_file_rab',$filename);
            $this->db->where('p_id',$id);
            $this->db->update('proposal');
        }

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/pengajuan/daftar');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Proposal Berhasil di Ajukan');
		    redirect('proposal/pengajuan/daftar');
		}

	}
	
}

?>