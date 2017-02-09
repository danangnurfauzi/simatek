<?php

function cekLaporanProposal( $proposalId )
{
	$ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT * FROM laporan WHERE l_p_id = '".$proposalId."'"; 
    $query = $ci->db->query($sql);
    $row = $query->num_rows();

    return $row;
}