<!DOCTYPE html>
<html>
<head>
	<title>Cetak Kuitansi</title>
	<style type="text/css">
	.header{
		margin: 0;
	}
	</style>
</head>
<body>

<div id="header">
	<h1 style="margin: 0;">SIMATEK</h1>
	<p style="margin: 0">Fakultas Teknik</p>
	<p style="margin: 0">Universitas Muhammadiyah Yogyakarta</p>
	<hr /><br />
</div>
<div id="content">
	<h2 style="text-align: center;">KUITANSI</h2>
	<table>
		<tr>
			<td>Organisasi</td>
			<td>:</td>
			<td><?php echo $data->u_nama ?></td>
		</tr>
		<tr>
			<td>Proposal Kegiatan</td>
			<td>:</td>
			<td><?php echo $data->p_kegiatan ?></td>
		</tr>
		<tr>
			<td>Penanggung Jawab</td>
			<td>:</td>
			<td><?php echo $data->p_penanggung_jawab ?></td>
		</tr>
		<tr>
			<td>Nomor Telp</td>
			<td>:</td>
			<td><?php echo $data->p_handphone ?></td>
		</tr>
		<tr>
			<td>Dana Disetujui</td>
			<td>:</td>
			<td><?php echo number_format($data->p_biaya_realisasi) ?></td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: right;"><img src="http://localhost/simatek/assets/vendors/barcode/barcode.php?text=<?php echo str_pad($data->p_id , 8, "0", STR_PAD_LEFT); ?>"></td>
		</tr>
	</table>
</div>

</body>
</html>