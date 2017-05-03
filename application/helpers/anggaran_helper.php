<?php

function realisasiAnggaranKegiatan( $jenisAnggaran , $tahun )
{
	$ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT SUM(p_biaya_realisasi) AS REALISASI FROM proposal WHERE p_biaya_amk_id = ".$jenisAnggaran." AND p_status = 8 AND YEAR(p_tanggal_mulai) = ".$tahun;
    $query = $ci->db->query($sql);
    $row = $query->row()->REALISASI;

    return $row;
}