<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* 
*/
class User extends MX_controller
{

	function __construct()
	{
		parent::__construct();
		
		if ( ! isset($_SESSION['logged_in']) )
		{
			redirect('auth/login');
		}

		$this->load->helper('user_helper');
		
	}

	function userList()
	{
		$data['daftar'] = $this->db->query("SELECT * FROM user INNER JOIN user_auth ON u_id = ua_u_id");
		$this->load->view('userList_view',$data);
	}

	function add()
	{
		$data['role'] = $this->db->query("SELECT * FROM role");
		$data['prodi'] = $this->db->query("SELECT * FROM prodi");
		$this->load->view('add_view',$data);	
	}

	function insert()
	{
		
		$this->db->trans_begin();

		$this->db->set('u_nama',$_POST['nama']);
        $this->db->set('u_singkatan',$_POST['singkatan']);
        $this->db->set('u_ketua',$_POST['ketua']);
        $this->db->set('u_email',$_POST['email']);
        $this->db->set('u_handphone',$_POST['hp']);
        $this->db->set('u_deskripsi',$_POST['deskripsi']);
        $this->db->set('u_created',date('Y-m-d H:i:j'));
        $this->db->insert('user');

        $id = $this->db->insert_id();

        $this->db->set('ua_u_id',$id);
        $this->db->set('ua_r_id',$_POST['levelUser']);
        $this->db->set('ua_p_id',$_POST['prodi']);
        $this->db->set('ua_username',$_POST['username']);
        $this->db->set('ua_password',md5('12345'));
        $this->db->set('ua_plaintext','12345');
        $this->db->set('ua_created',date('Y-m-d H:i:j'));
        $this->db->insert('user_auth');

        $filename = $id.'_'.$_POST['singkatan'].'.jpg';

		$config['upload_path']          = './assets/images/logo';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']           	= TRUE;
        $config['max_size']            	= 1024;
        $config['file_name'] 			= $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
            $error = array('error' => $this->upload->display_errors());
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('u_logo_path','assets/images/logo/'.$filename);
            $this->db->set('u_logo',$filename);
            $this->db->where('u_id',$id);
            $this->db->update('user');
        }

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/userList');
		}
		else
		{
		    $this->db->trans_commit();
		    
		    $this->sendEmailCreateUser($id);

		    $this->session->set_flashdata('success', 'Data Berhasil Di Tambah');
		    redirect('user/userList');
		}

	}

	function edit($id)
	{
		$data['user'] = $this->db->query('SELECT * FROM user INNER JOIN user_auth ON u_id = ua_u_id WHERE u_id = '.$id)->row();
		$data['role'] = $this->db->query("SELECT * FROM role");
		$data['prodi'] = $this->db->query("SELECT * FROM prodi");
		$this->load->view('edit_view',$data);
	}

	function update($id)
	{
		$this->db->trans_begin();

		$this->db->set('u_nama',$_POST['nama']);
        $this->db->set('u_singkatan',$_POST['singkatan']);
        $this->db->set('u_ketua',$_POST['ketua']);
        $this->db->set('u_email',$_POST['email']);
        $this->db->set('u_handphone',$_POST['hp']);
        $this->db->set('u_deskripsi',$_POST['deskripsi']);
        $this->db->set('u_updated',date('Y-m-d H:i:j'));
        $this->db->where('u_id',$id);
        $this->db->update('user');

        $this->db->set('ua_username',$_POST['username']);
        $this->db->set('ua_updated',date('Y-m-d H:i:j'));
        $this->db->set('ua_p_id',$_POST['prodi']);
        $this->db->where('ua_u_id',$id);
        $this->db->update('user_auth');

        $filename = $id.'_'.$_POST['singkatan'].'.jpg';

		$config['upload_path']          = './assets/images/logo';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']           	= TRUE;
        $config['max_size']            	= 1024;
        $config['file_name'] 			= $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('logo'))
        {
            $error = array('error' => $this->upload->display_errors());
            //echo "<pre>";
            //print_r($error);exit;
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('u_logo_path','assets/images/logo/'.$filename);
            $this->db->set('u_logo',$filename);
            $this->db->where('u_id',$id);
            $this->db->update('user');
        }

        if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/userList');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Data Berhasil Di Ubah');
		    redirect('user/userList');
		}
	}

	function delete($id)
	{
		$this->db->trans_begin();

		$detail = $this->db->query("SELECT * FROM user WHERE u_id = ".$id)->row();

		$baseUrl = $_SERVER['DOCUMENT_ROOT'];
		//echo $baseUrl;exit;
		if(unlink($baseUrl.'/lkmumy/'.$detail->u_logo_path))

		$this->db->where('u_id',$id);
		$this->db->delete('user');

		$this->db->where('ua_u_id',$id);
		$this->db->delete('user_auth');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/userList');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Hapus Data Berhasil');
		    redirect('user/userList');
		}
	}

	function resetPassword($id)
	{
		$this->db->trans_begin();

		$this->db->set('ua_password',md5('12345'));
		$this->db->set('ua_plaintext','12345');
		$this->db->where('ua_u_id',$id);
		$this->db->update('user_auth');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/userList');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Reset Password Berhasil');
		    redirect('user/userList');
		}
	}

	function profiles()
	{
		$data['personal'] = $this->db->query("SELECT * FROM user INNER JOIN user_auth ON u_id = ua_u_id WHERE u_id = ".$_SESSION['userId'])->row();
		$this->load->view('profiles_view',$data);	
	}

	function updateProfile($userId)
	{
		$this->db->trans_begin();

		$this->db->set('u_nama',$_POST['nama']);
		$this->db->set('u_singkatan',$_POST['singkatan']);
		$this->db->set('u_ketua',$_POST['ketua']);
		$this->db->set('u_email',$_POST['email']);
		$this->db->set('u_handphone',$_POST['handphone']);
		$this->db->set('u_deskripsi',$_POST['deskripsi']);
		$this->db->where('u_id',$userId);
		$this->db->update('user');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/profiles');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Profile Berhasil di Update');
		    redirect('user/profiles');
		}
	}

	function updateUsername($userAuthId)
	{
		$this->db->trans_begin();

		$this->db->set('ua_username',$_POST['username']);
		$this->db->where('ua_id',$userAuthId);
		$this->db->update('user_auth');

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
		    redirect('user/profiles');
		}
		else
		{
		    $this->db->trans_commit();
		    $this->session->set_flashdata('success', 'Username Berhasil di Ganti');
		    redirect('user/profiles');
		}
	}

	function updatePassword($userAuthId)
	{
		
		if ($_POST['passw'] != $_POST['rePassw'])
		{
			$this->session->set_flashdata('error', 'Password baru dengan konfirmasi password tidak sama');
		    redirect('user/profiles');
		}
		else
		{

			$this->db->trans_begin();

			$this->db->set('ua_password',md5($_POST['passw']));
			$this->db->set('ua_plaintext',$_POST['passw']);
			$this->db->where('ua_id',$userAuthId);
			$this->db->update('user_auth');

			if ($this->db->trans_status() === FALSE)
			{
			    $this->db->trans_rollback();
			    $this->session->set_flashdata('error', 'Terjadi Kesalahan Sistem');
			    redirect('user/profiles');
			}
			else
			{
			    $this->db->trans_commit();
			    $this->session->set_flashdata('success', 'Password Berhasil di Ganti');
			    redirect('user/profiles');
			}

		}

	}

	function updatePicture($userId)
	{
		
		$data = $this->db->query("SELECT * FROM user WHERE u_id = ".$userId)->row();

		$filename = $userId.'_'.$data->u_singkatan.'.jpg';

		$config['upload_path']          = './assets/images/logo';
        $config['allowed_types']        = 'jpg|png';
        $config['overwrite']           	= TRUE;
        $config['max_size']            	= 1024;
        $config['file_name'] 			= $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('pict'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('errorf', $error );
			redirect('user/profiles');
        }
        else
        {

            $data = array('upload_data' => $this->upload->data());

            $this->db->set('u_logo_path','assets/images/logo/'.$filename);
            $this->db->set('u_logo',$filename);
            $this->db->where('u_id',$userId);
            $this->db->update('user');

            $this->session->set_flashdata('success', 'Gambar Berhasil di Ganti');
			redirect('user/profiles');
        }

	}

	function sendEmailCreateUser( $userId )
	{
		
		$data = $this->db->query("SELECT * FROM user INNER JOIN user_auth ON ua_u_id = u_id WHERE u_id = ".$userId)->row();

		$subject = "ANDA TELAH DIBUATKAN AKUN PADA APLIKASI SIMATEK";
		$emailTo = $data->u_email;

		$message = "";

		$message .= "Username : ".$data->ua_username."<br />";
		$message .= "Password : ".$data->ua_plaintext."<br />";
		$message .= "<a href='".base_url()."' target='__blank'>SIMATEK</a>";

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
	
}

?>