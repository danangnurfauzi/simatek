<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<?php $bulan = array( 1 => 'Januari', 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember' ) ?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Manajemen Proposal</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Proposal</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Pengajuan</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-yellow">
                            <div class="panel-heading">CATATAN</div>
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
                                            <td><?php echo $row->tp_catatan ?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="panel panel-green">
                            <div class="panel-heading">Form Set Status Pengajuan Proposal</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/pengajuan/prosesSet/'.$proposal->p_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                                <!--input name="tempat" placeholder="" class="form-control" type="text" value="<?php echo $proposal->p_tempat ?>" disabled-->
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
                                            <label for="inputAddress" class="col-md-3 control-label">Total Anggaran Dibutuhkan</label>
                                            <div class="col-md-9">
                                                <h3 class="text-green">Rp. <?php echo number_format($proposal->p_biaya) ?></h3>
                                                <!--input name="biaya" placeholder="" class="form-control" type="number" value="<?php echo $proposal->p_biaya ?>" disabled-->
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File RAB</label>
                                            <?php echo ($proposal->p_file_rab == null) ? 'Belum Upload' : '<a href="'.base_url().$proposal->p_file_rab_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>' ?>
                                        </div>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Informasi Tambahan</label>
                                            <div class="col-md-9">
                                                <p class="text-green"> <?php echo $proposal->p_ringkasan ?> </p>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Keputusan<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <?php 
                                                    switch ($_SESSION['roleId']) 
                                                    {
                                                        case '4': case '3':
                                            ?>
                                            <select name="status" class="form-control" id="status">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="7">Harap Diperbaiki</option>
                                                    <option value="5">Diterima</option>
                                                    <option value="6">Ditolak</option>
                                                </select>
                                            <?php               
                                                            break;
                                                        
                                                        case '5':
                                                ?>
                                                <select name="status" class="form-control" id="status">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="3">Harap Diperbaiki</option>
                                                    <option value="4">Diterima</option>
                                                    <option value="2">Ditolak</option>
                                                </select>
                                                <?php
                                                            break;
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <?php if($_SESSION['roleId'] == '4'){ ?>
                                        <div class="form-group" id="formBiayaReal" style="display: none;">
                                            <label for="inputAddress" class="col-md-3 control-label">Biaya Yang Diberikan</label>
                                            <div class="col-md-9">
                                                </i><input name="biayaRealisasi" placeholder="" class="form-control" id="rupiah">
                                            </div>
                                        </div>
                                        <div class="form-group" id="mata">
                                            <label class="col-md-3 control-label">Mata Anggaran</label>
                                            <div class="col-md-9">
                                                <select name="amkId" class="form-control">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($anggaran->num_rows() > 0){ 
                                                            foreach($anggaran->result() as $row){
                                                    ?>
                                                    <option value="<?php echo $row->amk_id?>"><?php echo $row->amk_nama ?></option>
                                                    <?php
                                                            }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="form-group mbn" id="formCatatan"><label for="inputContent" class="col-md-3 control-label">Catatan</label>
                                            <div class="col-md-9"><textarea name="catatan" id="catatan" rows="3" class="form-control"></textarea></div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                            &nbsp;
                                            <a href="<?php echo site_url('proposal/pengajuan/daftar') ?>" class="btn btn-green">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--END CONTENT-->

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $('#catatan').wysihtml5();

    <?php if($_SESSION['roleId'] == '4'){ ?>
    $('#mata').hide();
    $('#status').change(function(){
        var set = $(this).val();
        
        if (set == 5)
        {
            $('#formBiayaReal').show();
            $('#mata').show();
        }
        else
        {
            $('#formBiayaReal').hide();
            $('#mata').hide();
        }
    });
    <?php } ?>

    $('#rupiah').priceFormat({
        prefix: '',
        thousandsSeparator: '.',
        clearOnEmpty: true,
        centsLimit: 0
    });

</script>

</body>
</html>