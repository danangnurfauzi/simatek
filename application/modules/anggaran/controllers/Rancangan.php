<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class Rancangan extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}
		
	}

	function jenis()
	{
		switch ($_SESSION['roleId']) {
			case '1':
				$data['daftar'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');
				break;
			
			case '2':
				
				break;

			case '3':
				
				break;

			case '4':
				
				break;

			case '5':
				
				break;
		}
		
		$this->load->view('jenis_view',$data);	
	}

	function add()
	{
		
		$this->load->view('add_view',$data);	
	}

	function insert()
	{
		
		$this->db->trans_begin();

		$this->db->set('amk_nama',$_POST['nama']);
        $this->db->set('amk_created',date('Y-m-d H:i:j'));
        $this->db->insert('anggaran_master_kegiatan');

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/jenis');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Tambah');
		    redirect('anggaran/rancangan/jenis');
		}

	}

	function edit($id)
	{
		$data['data'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_id = '.$id)->row();
		
		$this->load->view('edit_view',$data);
	}

	function update($id)
	{
		$this->db->trans_begin();

        $this->db->set('amk_nama',$_POST['nama']);
        $this->db->set('amk_updated',date('Y-m-d H:i:j'));
        $this->db->where('amk_id',$id);
        $this->db->update('anggaran_master_kegiatan');

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/jenis');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
		    redirect('anggaran/rancangan/jenis');
		}
	}

	function delete($id)
	{
		$this->db->trans_begin();

		$this->db->set('amk_is_deleted','1');
        $this->db->set('amk_updated',date('Y-m-d H:i:j'));
        $this->db->where('amk_id',$id);
        $this->db->update('anggaran_master_kegiatan');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/jenis');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Hapus Data Berhasil');
		    redirect('anggaran/rancangan/jenis');
		}
	}

	function set( $tahun = '' )
	{
		if ($tahun == '') 
		{
			$data['daftar'] = $this->db->query("SELECT * FROM anggaran_biaya_kegiatan INNER JOIN anggaran_master_kegiatan ON abk_amk_id = amk_id");

			$data['selected'] = 0;
		}
		else
		{
			$data['daftar'] = $this->db->query("SELECT * FROM anggaran_biaya_kegiatan INNER JOIN anggaran_master_kegiatan ON abk_amk_id = amk_id WHERE abk_tahun = ".$tahun);

			$data['selected'] = $tahun;
		}

		if($this->input->post('submit'))
		{
			redirect('anggaran/rancangan/set/'.$_POST['tahun']);
		}

		$data['jenis'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');

		$data['tahun'] = $this->db->query('SELECT DISTINCT abk_tahun AS TAHUN FROM anggaran_biaya_kegiatan');
		
		$this->load->view('set_view',$data);
	}

	function insertSet()
	{
		
		$this->db->trans_begin();

		$this->db->set('abk_amk_id',$_POST['jenisAnggaran']);
		$this->db->set('abk_tahun',$_POST['tahun']);
		$this->db->set('abk_nilai',str_replace('.', '', $_POST['nilai']) );
		$this->db->set('abk_created', date('Y-m-d H:i:j'));
		$this->db->insert('anggaran_biaya_kegiatan');

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/set');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Tambah');
		    redirect('anggaran/rancangan/set');
		}

	}

	function editSet($id)
	{
		$data['data'] = $this->db->query('SELECT * FROM anggaran_biaya_kegiatan WHERE abk_id = '.$id)->row();

		$data['jenis'] = $this->db->query('SELECT * FROM anggaran_master_kegiatan WHERE amk_is_deleted = 0');
		
		$this->load->view('editSet_view',$data);
	}

	function updateSet($id)
	{
		$this->db->trans_begin();

        $this->db->set('abk_amk_id',$_POST['jenisAnggaran']);
		$this->db->set('abk_tahun',$_POST['tahun']);
		$this->db->set('abk_nilai',$_POST['nilai']);
		$this->db->set('abk_updated', date('Y-m-d H:i:j'));
		$this->db->where('abk_id',$id);
		$this->db->update('anggaran_biaya_kegiatan');
		//echo $this->db->last_query();exit;
        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/set');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
		    redirect('anggaran/rancangan/set');
		}
	}

	function deleteSet($id)
	{
		$this->db->trans_begin();

        $this->db->where('abk_id',$id);
        $this->db->delete('anggaran_biaya_kegiatan');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/set');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Hapus Data Berhasil');
		    redirect('anggaran/rancangan/set');
		}
	}

	function relasi( $tahun = null )
	{
		if ( $tahun != null)
		{
			$data['daftar'] = $this->db->query('SELECT * FROM anggaran_relasi_kegiatan INNER JOIN anggaran_master_kegiatan ON amk_id = ark_amk_id INNER JOIN jenis_kegiatan ON jk_id = ark_jk_id WHERE ark_tahun = '.$tahun);
		}
		else
		{
			$data['daftar'] = $this->db->query('SELECT * FROM anggaran_relasi_kegiatan INNER JOIN anggaran_master_kegiatan ON amk_id = ark_amk_id INNER JOIN jenis_kegiatan ON jk_id = ark_jk_id');
		}

		$data['anggaranKegiatan'] = $this->db->query("SELECT * FROM anggaran_master_kegiatan");

		$data['jenisKegiatan'] = $this->db->query("SELECT * FROM jenis_kegiatan"); 

		$this->load->view('relasi_view',$data);
	}

	function insertRelasi()
	{
		
		$this->db->trans_begin();

		$this->db->set('ark_amk_id',$_POST['anggaranKegiatan']);
		$this->db->set('ark_tahun',$_POST['tahun']);
		$this->db->set('ark_jk_id',$_POST['jenisKegiatan']);
		$this->db->set('ark_created', date('Y-m-d H:i:j'));
		$this->db->insert('anggaran_relasi_kegiatan');

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/relasi');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Tambah');
		    redirect('anggaran/rancangan/relasi');
		}

	}

	function editRelasi($id)
	{
		$data['data'] = $this->db->query('SELECT * FROM anggaran_relasi_kegiatan WHERE ark_id = '.$id)->row();

		$data['anggaranKegiatan'] = $this->db->query("SELECT * FROM anggaran_master_kegiatan");

		$data['jenisKegiatan'] = $this->db->query("SELECT * FROM jenis_kegiatan"); 
		
		$this->load->view('editRelasi_view',$data);
	}

	function updateRelasi($id)
	{
		
		$this->db->trans_begin();

		$this->db->set('ark_amk_id',$_POST['anggaranKegiatan']);
		$this->db->set('ark_tahun',$_POST['tahun']);
		$this->db->set('ark_jk_id',$_POST['jenisKegiatan']);
		$this->db->set('ark_updated', date('Y-m-d H:i:j'));
		$this->db->where('ark_id',$id);
		$this->db->update('anggaran_relasi_kegiatan');

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/relasi');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
		    redirect('anggaran/rancangan/relasi');
		}

	}

	function deleteRelasi($id)
	{
		$this->db->trans_begin();

        $this->db->where('ark_id',$id);
        $this->db->delete('anggaran_relasi_kegiatan');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('anggaran/rancangan/relasi');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Hapus Data Berhasil');
		    redirect('anggaran/rancangan/relasi');
		}
	}
	
}

?>