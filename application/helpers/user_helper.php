<?php

function role($id)
{
	$ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT * FROM role WHERE r_id = '".$id."'"; 
    $query = $ci->db->query($sql);
    $row = $query->row()->r_nama;

    return $row;
}