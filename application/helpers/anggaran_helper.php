<?php

function realisasiAnggaranKegiatan( $jenisAnggaran , $tahun )
{
	$ci=& get_instance();
    $ci->load->database(); 

    $sql = "SELECT SUM(p_biaya_realisasi) AS REALISASI FROM proposal INNER JOIN anggaran_relasi_kegiatan ON ark_jk_id = p_jk_id WHERE p_status = 5 AND ark_tahun = ".$tahun." AND ark_amk_id = ".$jenisAnggaran." AND YEAR(p_created) = ".$tahun; 
    $query = $ci->db->query($sql);
    $row = $query->row()->REALISASI;

    return $row;
}