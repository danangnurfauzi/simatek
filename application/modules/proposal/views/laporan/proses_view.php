<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<?php $bulan = array( 1 => 'Januari', 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember' ) ?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Manajemen Laporan</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Proposal</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">laporan</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">

                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="display:block;">CATATAN</a></div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Dari</th>
                                                <th>Catatan</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($catatan->num_rows() > 0){ foreach($catatan->result() as $row){ ?>
                                                <tr>
                                                    <td><?php echo $row->r_nama ?></td>
                                                    <td><?php echo $row->tl_catatan ?></td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="display:block;">DESKRIPSI PROPOSAL</a></div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="form-body pal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Organisasi</label>
                                                <div class="col-md-9">
                                                    <?php $jenisKegiatan = $this->db->query("SELECT * FROM user WHERE u_id = ".$proposal->p_u_id)->row()->u_nama ?>
                                                    <h3 class="text-green"><?php echo $jenisKegiatan ?></h3>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Jenis Kegiatan</label>
                                                <div class="col-md-9">
                                                    <?php $jenisKegiatan = $this->db->query("SELECT * FROM jenis_kegiatan WHERE jk_id = ".$proposal->p_jk_id)->row()->jk_nama ?>
                                                    <h3 class="text-green"><?php echo $jenisKegiatan ?></h3>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Lingkup Kegiatan</label>
                                                <div class="col-md-9">
                                                    <?php
                                                        switch ($proposal->p_lingkup)
                                                        {
                                                            case '1':
                                                                $lingkup = 'INTERNAL';
                                                                break;
                                                            
                                                            case '2':
                                                                $lingkup = 'REGIONAL';
                                                                break;

                                                            case '3':
                                                                $lingkup = 'NASIONAL';
                                                                break;

                                                            case '4':
                                                                $lingkup = 'INTERNASIONAL';
                                                                break;
                                                        }
                                                    ?>
                                                    <h3 class="text-green"><?php echo $lingkup ?></h3>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Judul Kegiatan</label>
                                                <div class="col-md-9">
                                                    <h3 class="text-green"><?php echo $proposal->p_kegiatan ?></h3>
                                                    <!--input name="nama" placeholder="" class="form-control" type="text" value="<?php echo $proposal->p_kegiatan ?>" disabled-->
                                                </div>
                                            </div>
                                            <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Latar Belakang</label>
                                                <div class="col-md-9">
                                                    <p class="text-green"> <?php echo $proposal->p_latar_belakang ?> </p>
                                                </div>
                                            </div>
                                            <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Tujuan</label>
                                                <div class="col-md-9">
                                                    <p class="text-green"> <?php echo $proposal->p_tujuan ?> </p>
                                                </div>
                                            </div>
                                            <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Luaran</label>
                                                <div class="col-md-9">
                                                    <p class="text-green"> <?php echo $proposal->p_luaran ?> </p>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tempat</label>
                                                <div class="col-md-9">
                                                    <h3 class="text-green"><?php echo $proposal->p_tempat ?></h3>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-md-3 control-label">Penanggung Jawab</label>
                                                <div class="col-md-9">
                                                    <table class="table table-hover table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nama</th>
                                                            <th>Nomor Telp</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>#</td>
                                                            <td><p class="text-green"><?php echo $proposal->p_penanggung_jawab ?></p></td>
                                                            <td><p class="text-green"><?php echo $proposal->p_handphone ?></p></td>
                                                        </tr>
                                                        <tr>
                                                            <td>#</td>
                                                            <td><p class="text-green"><?php echo $proposal->p_penanggung_jawab1 ?></p></td>
                                                            <td><p class="text-green"><?php echo $proposal->p_handphone1 ?></p></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                                    <?php $tanggalMulai = explode('-', $proposal->p_tanggal_mulai); $mulai = $tanggalMulai[2].'-'.$bulan[ str_replace('0', '', $tanggalMulai[1]) ].'-'.$tanggalMulai[0] ?>
                                                    
                                            
                                                    <?php $tanggalSelesai = explode('-', $proposal->p_tanggal_selesai); $selesai = $tanggalSelesai[2].'-'.$bulan[ str_replace('0', '', $tanggalSelesai[1]) ].'-'.$tanggalSelesai[0] ?>
                                                   
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-md-3 control-label">Waktu Kegiatan</label>
                                                <div class="col-md-9">
                                                   <h3 class="text-green"> <?php echo $mulai .' s/d '. $selesai ?> </h3>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-md-3 control-label">Pihak Luar Yang Terlibat</label>
                                                <div class="col-md-9">
                                                   <?php if ($proposal->p_is_pihak_luar == 1) { ?>
                                                       <h3 class="text-green">Tidak Ada</h3>
                                                   <?php }else{ ?>

                                                   <table class="table table-hover table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nama</th>
                                                            <th>Nomor Telp</th>
                                                            <th>Organisasi/Instansi</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>#</td>
                                                            <td><p class="text-green"><?php echo $proposal->p_pihak_luar_nama ?></p></td>
                                                            <td><p class="text-green"><?php echo $proposal->p_pihak_luar_telephone ?></p></td>
                                                            <td><p class="text-green"><?php echo $proposal->p_pihak_luar_instansi ?></p></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                   <?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress" class="col-md-3 control-label">Total Anggaran Yang Di Setujui</label>
                                                <div class="col-md-9">
                                                    <h3 class="text-green">Rp. <?php echo number_format($proposal->p_biaya_realisasi) ?></h3>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-md-3 control-label">Informasi Tambahan</label>
                                                <div class="col-md-9">
                                                    <p class="text-green"><?php echo $proposal->p_ringkasan ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="exampleInputFile" class="col-md-3 control-label">File RAB</label>
                                                <div class="col-md-9">
                                                <?php echo ($proposal->p_file_rab == null) ? 'Belum Upload' : '<a href="'.base_url().$proposal->p_file_rab_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="display:block;">FORM SET STATUS LAPORAN PROPOSAL</a></div>
                                <div id="collapseThree" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <form action="<?php echo site_url('proposal/laporan/prosesSet/'.$proposal->l_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <div class="form-body pal">

                                                <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Luaran Yang Di Capai</label>
                                                    <div class="col-md-9">
                                                        <p class="text-green"> <?php echo $proposal->l_luaran ?> </p>
                                                    </div>
                                                </div>

                                                <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Laporan dan Evaluasi</label>
                                                    <div class="col-md-9">
                                                        <p class="text-green"> <?php echo $proposal->l_evaluasi ?> </p>
                                                    </div>
                                                </div>

                                                <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Realisasi Dana Terpakai</label>
                                                    <div class="col-md-9">
                                                        <h3 class="text-green">Rp. <?php echo $proposal->l_realisasi_dana ?> </h3>
                                                    </div>
                                                </div>

                                                <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Bukti Kuitansi</label>
                                                    <div class="col-md-9">
                                                        <?php echo ($proposal->l_file_kuitansi == null) ? 'Belum Upload' : '<a href="'.base_url().$proposal->l_file_kuitansi_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>' ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Link Berita</label>
                                                    <div class="col-md-9">
                                                        <?php echo ($proposal->l_dokumentasi_link == null) ? 'Tidak Ada' : '<a href="'.$proposal->l_dokumentasi_link.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>' ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mbn">
                                                    <label for="inputContent" class="col-md-3 control-label">Dokumentasi Foto</label>

                                                    <?php if($proposal->l_file_photo1 != null){ ?>
                                                    <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo1_path ?>"></a></div>
                                                    <?php } ?>

                                                    <?php if($proposal->l_file_photo2 != null){ ?>
                                                    <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo2_path ?>"></a></div>
                                                    <?php } ?>

                                                    <?php if($proposal->l_file_photo3 != null){ ?>
                                                    <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo3_path ?>"></a></div>
                                                    <?php } ?>
                                                    
                                                </div>

                                                <div class="form-group mbn">
                                                    <label class="col-md-3 control-label">Keputusan<span class="require">*</span></label>
                                                    <div class="col-md-9">
                                                        <select name="status" class="form-control" id="status">
                                                            <option>------PILIH SALAH SATU------</option>
                                                            <option value="1">Harap Diperbaiki</option>
                                                            <option value="2">Diterima</option>
                                                        </select>
                                                    </div>
                                                </div><br/>
                                                <div class="form-group mbn" id="formCatatan"><label for="inputContent" class="col-md-3 control-label">Catatan</label>
                                                    <div class="col-md-9"><textarea name="catatan" id="catatan" rows="3" class="form-control"></textarea></div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    &nbsp;
                                                    <a href="<?php echo site_url('proposal/laporan/daftar') ?>" class="btn btn-green">Cancel</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END CONTENT-->

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $('#catatan').wysihtml5();



</script>

</body>
</html>