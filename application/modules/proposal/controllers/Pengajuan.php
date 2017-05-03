<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Pengajuan extends MX_controller
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
				$data['daftar'] = $this->db->query('SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id');
				break;
			
			case '2':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal WHERE p_u_id = '.$_SESSION['userId']);
				break;

			case '3':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id');
				break;

			case '4':
				$data['daftar'] = $this->db->query('SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id');
				break;

			case '5':
				$idProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row()->ua_p_id;
				$data['daftar'] = $this->db->query('SELECT * FROM proposal LEFT JOIN user_auth ON ua_u_id = p_u_id INNER JOIN user ON p_u_id = u_id WHERE ua_p_id = '.$idProdi);
				break;
		}
		
		$this->load->view('daftar_view',$data);	
	}

	function kegiatan()
	{
		$this->load->view('kegiatan_view');	
	}

	function add()
	{
		$data['jenis'] = $this->db->query('SELECT * FROM jenis_kegiatan');
		$this->load->view('add_view',$data);
	}

	function insert()
	{
		
		$this->db->trans_begin(); //echo "<pre>"; print_r($_POST);exit;

		$isLkmProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row()->ua_p_id;

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
        $this->db->set('p_biaya',str_replace('.', '', $_POST['biaya']));
        $this->db->set('p_latar_belakang',$_POST['latarBelakang']);
        $this->db->set('p_luaran',$_POST['luaran']);
        $this->db->set('p_penanggung_jawab1',$_POST['penanggungJawab1']);
        $this->db->set('p_handphone1',$_POST['hp1']);
        $this->db->set('p_is_pihak_luar',$_POST['statusPihakLuar']);
        $this->db->set('p_pihak_luar_nama',$_POST['namaPihakLuar']);
        $this->db->set('p_pihak_luar_telephone',$_POST['nomorPihakLuar']);
        $this->db->set('p_pihak_luar_instansi',$_POST['organisasiPihakLuar']);

        if ($isLkmProdi == '0')
        {
        	$this->db->set('p_status','4');
        }
        else
        {
        	$this->db->set('p_status','0');	
        }

        $this->db->set('p_created',date('Y-m-d H:i:j'));
        $this->db->insert('proposal');

        $id = $this->db->insert_id();

        $this->db->set('tp_p_id',$id);
        if ($isLkmProdi == '0')
        {
        	$this->db->set('tp_status','4');
        }
        else
        {
        	$this->db->set('tp_status','0');	
        }
        $this->db->set('tp_created',date('Y-m-d H:i:j'));
        $this->db->set('tp_u_id',$_SESSION['userId']);
        $this->db->insert('trx_pengajuan');

        $idPengajuan = $this->db->insert_id();

        $this->db->set('p_tp_id',$idPengajuan);
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

		    if ($isLkmProdi == '0')
	        {
	        	$dataKirim = $this->db->query("SELECT * FROM role INNER JOIN user_auth ON ua_r_id = r_id INNER JOIN user ON u_id = ua_u_id WHERE r_id = 4")->row()->u_email;
	        }
	        else
	        {
	        	$cariProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row();

	        	$isProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_is_prodi = 1 AND ua_p_id = ".$cariProdi->ua_p_id)->row();

	        	//echo $this->db->last_query();

	        	$dataKirim = $this->db->query("SELECT * FROM user WHERE u_id = ".$isProdi->ua_u_id)->row()->u_email;
	        }

		    $this->sendEmailPengajuanProposal( $idPengajuan , $dataKirim );

		    $this->session->set_flashdata('success', 'Proposal Berhasil di Ajukan');
		    redirect('proposal/pengajuan/daftar');
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
        $this->db->set('p_kegiatan',$_POST['nama']);
        $this->db->set('p_lingkup',$_POST['lingkupKegiatan']);
        $this->db->set('p_tujuan',$_POST['tujuan']);
        $this->db->set('p_tempat',$_POST['tempat']);
        $this->db->set('p_penanggung_jawab',$_POST['penanggungJawab']);
        $this->db->set('p_ringkasan',$_POST['ringkasan']);
        $this->db->set('p_handphone',$_POST['hp']);
        $this->db->set('p_tanggal_mulai',$_POST['tanggalMulai']);
        $this->db->set('p_tanggal_selesai',$_POST['tanggalSelesai']);
        $this->db->set('p_biaya',str_replace('.', '', $_POST['biaya']));
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
		if(unlink($baseUrl.'/simatek/'.$detail->p_file_rab_path))
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
		//echo $this->db->last_query();exit;
		$data['anggaran'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');

		$this->load->view('proses_view',$data);
	}

	function prosesSet($proposalId)
	{
		$this->db->trans_begin();

		$this->db->set('tp_p_id',$proposalId);
		$this->db->set('tp_u_id',$_SESSION['userId']);
		$this->db->set('tp_status',$_POST['status']);
		$this->db->set('tp_catatan',$_POST['catatan']);
		$this->db->set('tp_created',date('Y-m-d H:i:j'));
		$this->db->insert('trx_pengajuan');

		$trxId = $this->db->insert_id();

		$this->db->set('p_status',$_POST['status']);
		$this->db->set('p_biaya_mata_anggaran_temp',str_replace('.' , '' , $_POST['biayaRealisasi']) );
		$this->db->set('p_biaya_amk_id',$_POST['amkId']);
		$this->db->set('p_tp_id',$trxId);
		$this->db->where('p_id',$proposalId);
		$this->db->update('proposal');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('proposal/pengajuan/daftar');
		}
		else
		{
		    $this->db->trans_commit();

		    $email = $this->db->query("SELECT * FROM proposal INNER JOIN user ON u_id = p_u_id WHERE p_id = ".$proposalId)->row()->u_email;

		    $this->sendEmailProsesProposal( $trxId , $email );

		    if ($_POST['status'] == '4')
		    {
		    	$emailWadek2 = $this->db->query("SELECT * FROM user_auth INNER JOIN role ON r_id = ua_r_id INNER JOIN user ON u_id = ua_u_id WHERE r_id = 4")->row()->u_email;
		    	$this->sendEmailPengajuanProposal( $trxId , $emailWadek2 );
		    }

		    $this->session->set_flashdata('success', 'Proses Proposal Berhasil Di Ubah');
		    redirect('proposal/pengajuan/daftar');
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

        if ($_FILES['filesRab']['name'] != '')
        {
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

		    $isLkmProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row()->ua_p_id;

		    if ($isLkmProdi == '0')
	        {
	        	$dataKirim = $this->db->query("SELECT * FROM role INNER JOIN user_auth ON ua_r_id = r_id INNER JOIN user ON u_id = ua_u_id WHERE r_id = 4")->row()->u_email;
	        }
	        else
	        {
	        	$cariProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_u_id = ".$_SESSION['userId'])->row();

	        	$isProdi = $this->db->query("SELECT * FROM user_auth WHERE ua_is_prodi = 1 AND ua_p_id = ".$cariProdi->ua_p_id)->row();

	        	//echo $this->db->last_query();

	        	$dataKirim = $this->db->query("SELECT * FROM user WHERE u_id = ".$isProdi->ua_u_id)->row()->u_email;
	        }

		    $this->sendEmailRevisiProposal( $trxId , $dataKirim );

		    $this->session->set_flashdata('success', 'Proposal Berhasil di Ajukan');
		    redirect('proposal/pengajuan/daftar');
		}

	}

	function prosesProposalMataAnggaran( $id )
	{
		$proposal = $this->db->query('SELECT * FROM proposal WHERE p_id = '.$id)->row();
		$data['proposal'] = $proposal;
		$data['jenis'] = $this->db->query('SELECT * FROM jenis_kegiatan');
		$data['mataAnggaran'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_id = '.$proposal->p_biaya_amk_id)->row()->amk_nama;
		$data['anggaran'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');

		$this->load->view('prosesProposalMataAnggaran_view',$data);
	}

	function prosesSetMataAnggaranProposal($id)
	{
		//echo "<pre>";
		//print_r($_POST);

		$jumlah = 0;

		for ($i=0; $i < count($_POST['angka']) ; $i++) { 
			$rupi = $_POST['angka'][$i];

			$jumlah = $jumlah + str_replace('.', '', $rupi);

			$data[] = array(
					'pma_p_id' => $id,
					'pma_amk_id' => $_POST['amk_id'][$i],
					'pma_angka' => $rupi,
					'pma_created' => date('Y-m-d H:i:j')
				);
		}

		//echo $jumlah;
		//echo "<pre>";
		//print_r($data);
		//exit;

		$rencana = $this->db->query("SELECT p_biaya_mata_anggaran_temp FROM proposal WHERE p_id = ".$id)->row()->p_biaya_mata_anggaran_temp;

		//echo $rencana;exit;

		if ($jumlah > $rencana) 
		{
			$this->session->set_flashdata('error', 'Maaf Setting Mata Anggaran Anda Melebihi Rencana Anggaran Yang di Tentukan');
		    redirect('proposal/pengajuan/prosesProposalMataAnggaran/'.$id);
		}
		else
		{

			$this->db->trans_begin();

			$this->db->set('tp_p_id',$id);
			$this->db->set('tp_u_id',$_SESSION['userId']);
			$this->db->set('tp_status',$_POST['status']);
			$this->db->set('tp_created',date('Y-m-d H:i:j'));
			$this->db->insert('trx_pengajuan');

			$trxId = $this->db->insert_id();

			$this->db->set('p_biaya_realisasi',$jumlah);
			$this->db->set('p_status',$_POST['status']);
			$this->db->set('p_tp_id',$trxId);
			$this->db->where('p_id',$id);
			$this->db->update('proposal');

			//$ins = array($data);

			$this->db->insert_batch('proposal_mata_anggaran', $data);

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
			    redirect('proposal/pengajuan/daftar');
			}
			else
			{
			    $this->db->trans_commit();
			    $this->session->set_flashdata('success', 'Proposal Berhasil di Set Mata Anggarannya');
			    redirect('proposal/pengajuan/daftar');
			}
		}

	}

	function cetakBuktiApproval( $proposalId )
	{
		$this->load->library('m_pdf');

		$data['data'] = $this->db->query("SELECT * FROM proposal INNER JOIN user ON u_id = p_u_id WHERE p_id = ".$proposalId)->row();

		$html = $this->load->view('cetakBuktiApproval_view', $data , true);

		$this->m_pdf->pdf->WriteHTML($html);

		$this->m_pdf->pdf->Output($pdfFilePath, "D"); 
	}

	function complete( $proposalId )
	{
		
		$data['proposal'] = $this->db->query("SELECT * FROM proposal WHERE p_id = ".$proposalId)->row();

		$data['complete'] = $this->db->query("SELECT * FROM proposal_complete WHERE pc_p_id = ".$proposalId);

		$this->load->view('complete_view',$data);

	}

	function insertComplete( $proposalId )
	{

		$this->db->trans_begin();
		
		$cek = $this->db->query("SELECT * FROM proposal_complete WHERE pc_p_id = ".$proposalId);

		if ($cek->num_rows() > 0) 
		{
			$this->db->set('pc_updated',date('Y-m-d H:i:j'));
			$this->db->where('pc_p_id',$proposalId);
			$this->db->update('proposal_complete');
		}
		else
		{
			$this->db->set('pc_p_id',$proposalId);
			$this->db->set('pc_created',date('Y-m-d H:i:j'));
			$this->db->insert('proposal_complete');
		}
		
		if ($_FILES['panitia']['name'] != '')
        {

	        $filename = $proposalId.'_pernyataan_panitia.pdf';

			$config['upload_path']          = './assets/proposal/complete';
	        $config['allowed_types']        = 'pdf|PDF';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 1024;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('panitia'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('pc_surat_pernyataan_panitia_path','assets/proposal/complete/'.$filename);
	            $this->db->set('pc_surat_pernyataan_panitia',$filename);
	            $this->db->where('pc_p_id',$proposalId);
	            $this->db->update('proposal_complete');
	        }
        }

        if ($_FILES['pemerintah']['name'] != '')
        {

	        $filename = $id.'_izin_pemerintah.pdf';

			$config['upload_path']          = './assets/proposal/complete';
	        $config['allowed_types']        = 'pdf|PDF';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 1024;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('pemerintah'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('pc_surat_izin_pemerintah_path','assets/proposal/complete/'.$filename);
	            $this->db->set('pc_surat_izin_pemerintah',$filename);
	            $this->db->where('pc_p_id',$proposalId);
	            $this->db->update('proposal_complete');
	        }
        }

        if ($_FILES['polisi']['name'] != '')
        {

	        $filename = $id.'_izin_polisi.pdf';

			$config['upload_path']          = './assets/proposal/complete';
	        $config['allowed_types']        = 'pdf|PDF';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 1024;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('polisi'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('pc_surat_izin_polisi_path','assets/proposal/complete/'.$filename);
	            $this->db->set('pc_surat_izin_polisi',$filename);
	            $this->db->where('pc_p_id',$proposalId);
	            $this->db->update('proposal_complete');
	        }
        }

        if ($_FILES['ortu']['name'] != '')
        {

	        $filename = $id.'_izin_ortu.pdf';

			$config['upload_path']          = './assets/proposal/complete';
	        $config['allowed_types']        = 'pdf|PDF';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 10240;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('ortu'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('pc_surat_izin_ortu_path','assets/proposal/complete/'.$filename);
	            $this->db->set('pc_surat_izin_ortu',$filename);
	            $this->db->where('pc_p_id',$proposalId);
	            $this->db->update('proposal_complete');
	        }
        }

        if ($_FILES['dokter']['name'] != '')
        {

	        $filename = $id.'_izin_dokter.pdf';

			$config['upload_path']          = './assets/proposal/complete';
	        $config['allowed_types']        = 'pdf|PDF';
	        $config['overwrite']           	= TRUE;
	        $config['max_size']            	= 10240;
	        $config['file_name'] 			= $filename;

	        $this->load->library('upload', $config);

	        $this->upload->initialize($config);
	        if ( ! $this->upload->do_upload('dokter'))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('errorf', $error);
	        }
	        else
	        {

	            $data = array('upload_data' => $this->upload->data());

	            $this->db->set('pc_surat_izin_dokter_path','assets/proposal/complete/'.$filename);
	            $this->db->set('pc_surat_izin_dokter',$filename);
	            $this->db->where('pc_p_id',$proposalId);
	            $this->db->update('proposal_complete');
	        }
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
		    $this->session->set_flashdata('success', 'Proposal Berhasil di Lengkapi');
		    redirect('proposal/pengajuan/daftar');
		}

	}

	function sendEmailPengajuanProposal( $trxPengajuanId , $email )
	{
		
		$proposalId = $this->db->query("SELECT * FROM trx_pengajuan WHERE tp_id = ".$trxPengajuanId)->row()->tp_p_id;
		$data = $this->db->query("SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id WHERE p_id = ".$proposalId)->row();

		//echo $this->db->last_query();exit;

		//$dataTarget = $this->db->query("SELECT * FROM user WHERE u_id = ".$userIdReceived)->row();

		$subject = "PENGAJUAN PROPOSAL";
		$emailTo = $email;

		$message = "";

		$message .= "PROPOSAL KEGIATAN DARI : <br />";
		$message .= "Organisasi : ".$data->u_nama."<br />";
		$message .= "Judul Kegiatan : ".$data->p_kegiatan."<br />";
		$message .= "<a href='".base_url()."' target='__blank'>Lebih Detail Login SIMATEK</a>";

		$config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'fauzinurdanang@gmail.com', 
                    'smtp_pass' => 't3l0g0d0g', 
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'wordwrap'  => TRUE,
                    'priority' => '1'
                  );

        //print_r($set);exit;
        
        $this->load->library('email', $config);
        
        $this->email->set_newline("\r\n");  
        $this->email->from('no-reply@simatek.umy.ac.id'); 
        $this->email->to($emailTo);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        {
            $status = "success";
        }
        else
        {
            $status = $this->email->print_debugger();
            //print_r($status);
            //show_error($this->email->print_debugger());
        }

	}

	function sendEmailRevisiProposal( $trxPengajuanId , $email )
	{
		
		$proposalId = $this->db->query("SELECT * FROM trx_pengajuan WHERE tp_id = ".$trxPengajuanId)->row()->tp_p_id;

		$data = $this->db->query("SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id WHERE p_id = ".$proposalId)->row();

		$subject = "PENGAJUAN PROSES PROPOSAL";
		$emailTo = $email;

		$message = "";

		$message .= "PROPOSAL KEGIATAN DARI : <br />";
		$message .= "Organisasi : ".$data->u_nama."<br />";
		$message .= "Judul Kegiatan : ".$data->p_kegiatan."<br />";
		$message .= "Status : <strong>Telah Di Perbaiki</strong><br />";
		$message .= "<a href='".base_url()."' target='__blank'>Lebih Detail Login SIMATEK</a>";

		$config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'fauzinurdanang@gmail.com', 
                    'smtp_pass' => 't3l0g0d0g', 
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'wordwrap'  => TRUE,
                    'priority' => '1'
                  );

        //print_r($set);exit;
        
        $this->load->library('email', $config);
        
        $this->email->set_newline("\r\n");  
        $this->email->from('no-reply@simatek.umy.ac.id'); 
        $this->email->to($emailTo);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        {
            $status = "success";
        }
        else
        {
            $status = $this->email->print_debugger();
            //print_r($status);
            //show_error($this->email->print_debugger());
        }

	}

	function sendEmailProsesProposal( $trxPengajuanId , $email )
	{
		
		$proposal = $this->db->query("SELECT * FROM trx_pengajuan WHERE tp_id = ".$trxPengajuanId)->row();
		
		$data = $this->db->query("SELECT * FROM proposal INNER JOIN user ON p_u_id = u_id WHERE p_id = ".$proposal->tp_p_id)->row();

		$statusProposal = $this->statusPengajuan($proposal->tp_status);
		
		$subject = "PENGAJUAN PROSES PROPOSAL";
		$emailTo = $email;

		$message = "";

		$message .= "PROPOSAL KEGIATAN DARI : <br />";
		$message .= "Organisasi : ".$data->u_nama."<br />";
		$message .= "Judul Kegiatan : ".$data->p_kegiatan."<br />";
		$message .= "Status : <strong>".$statusProposal."</strong><br />";
		$message .= "<a href='".base_url()."' target='__blank'>Lebih Detail Login SIMATEK</a>";

		$config = Array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'ssl://smtp.googlemail.com',
                    'smtp_port' => '465',
                    'smtp_user' => 'fauzinurdanang@gmail.com', 
                    'smtp_pass' => 't3l0g0d0g', 
                    'mailtype'  => 'html',
                    'charset'   => 'iso-8859-1',
                    'wordwrap'  => TRUE,
                    'priority' => '1'
                  );

        //print_r($set);exit;
        
        $this->load->library('email', $config);
        
        $this->email->set_newline("\r\n");  
        $this->email->from('no-reply@simatek.umy.ac.id'); 
        $this->email->to($emailTo);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        {
            $status = "success";
        }
        else
        {
            $status = $this->email->print_debugger();
            print_r($status);
            show_error($this->email->print_debugger());
        }

	}

	function statusPengajuan( $statusId )
	{
		switch ($statusId) 
		{
			case '0':
				return 'waiting prodi';
				break;
			
			case '1':
				return 'acc prodi';
				break;

			case '2':
				return 'ditolak prodi';
				break;

			case '3':
				return 'revisi prodi';
				break;

			case '4':
				return 'waiting fakultas';
				break;

			case '5':
				return 'acc fakultas';
				break;

			case '6':
				return 'ditolak fakultas';
				break;

			case '7':
				return 'revisi fakultas';
				break;

			case '8':
				return 'acc fakultas';
				break;

			case '9':
				return 'ditolak fakultas';
				break;
		}
	}
	
}

?>