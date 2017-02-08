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
		$this->load->view('dashboard_view');
	}

	
	
}

?>