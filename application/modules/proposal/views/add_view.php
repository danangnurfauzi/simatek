<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>
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
                        <div class="panel panel-green">
                            <div class="panel-heading">Form Pengajuan Proposal</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/pengajuan/insert') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Kegiatan<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                <select name="jenisKegiatan" class="form-control">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($jenis->num_rows() > 0){ 
                                                            foreach($jenis->result() as $row){
                                                    ?>
                                                    <option value="<?php echo $row->jk_id?>"><?php echo $row->jk_nama ?></option>
                                                    <?php
                                                            }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Lingkup Kegiatan<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                <select name="lingkupKegiatan" class="form-control">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="1">INTERNAL</option>
                                                    <option value="2">REGIONAL</option>
                                                    <option value="3">NASIONAL</option>
                                                    <option value="4">INTERNASIONAL</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Judul Kegiatan<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                <input name="nama" placeholder="" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Latar Belakang<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9"><textarea name="latarBelakang" id="latarBelakang" rows="3" class="form-control" required></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Tujuan<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9"><textarea name="tujuan" id="tujuan" rows="3" class="form-control" required></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Luaran<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9"><textarea name="luaran" id="luaran" rows="3" class="form-control" required></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tempat Kegiatan<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                <input name="tempat" placeholder="" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label">Penanggung Jawab<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-4">
                                                <input name="penanggungJawab" placeholder="nama lengkap" class="form-control" type="text" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input name="hp" placeholder="nomor telp" class="form-control" type="number" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label"></label>
                                            <div class="col-md-4">
                                                <input name="penanggungJawab1" placeholder="nama lengkap" class="form-control" type="text">
                                            </div>
                                            <div class="col-md-4">
                                                <input name="hp1" placeholder="nomor telp" class="form-control" type="number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label">Waktu<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-4">
                                                <input name="tanggalMulai" placeholder="Tanggal Mulai" class="form-control" type="text" id="mulai" required>
                                            </div>
                                            <div class="col-md-4">
                                                <input name="tanggalSelesai" placeholder="Tanggal Selesai" class="form-control" type="text" id="selesai" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Pihak Luar Yang Terlibat<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                <select name="statusPihakLuar" class="form-control" id="statusPihakLuar">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="1">Tidak Ada</option>
                                                    <option value="2">Ada</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="formPihakLuar" style="display: none;">
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-md-3 control-label"></label>
                                                <div class="col-md-3">
                                                    <input name="namaPihakLuar" placeholder="Nama" class="form-control" type="text" id="namaPihakLuar">
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="nomorPihakLuar" placeholder="Nomor Telp" class="form-control" type="text" id="nomorPihakLuar">
                                                </div>
                                                <div class="col-md-3">
                                                    <input name="organisasiPihakLuar" placeholder="Nama Organisasi/Instansi" class="form-control" type="text" id="organisasiPihakLuar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="inputAddress" class="col-md-3 control-label">Total Anggaran<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9">
                                                </i><input name="biaya" placeholder="" class="form-control" id="rupiah">
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File<span class="require">* <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></span></label>
                                            <div class="col-md-9"><input type="file" name="filesRab">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 3MB.</p>
                                                <p class="help-block">file berisi Susunan Panitia, Agenda Kegiatan dan Rencana Anggaran</p>
                                            </div>
                                        </div><br/>
                                        <!--div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Proposal</label>
                                            <div class="col-md-9"><input type="file" name="files">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 3MB.</p></div>
                                        </div-->
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Informasi Tambahan <i class="fa fa-exclamation-circle" data-toggle="tooltip" data-placement="right" data-original-title="Keterangan"></i></label>
                                            <div class="col-md-9"><textarea name="ringkasan" id="ringkasan" rows="3" class="form-control"></textarea></div>
                                        </div>
                                        <br/>
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
    $("#mulai").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $("#selesai").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#ringkasan').wysihtml5();
    $('#tujuan').wysihtml5();
    $('#latarBelakang').wysihtml5();
    $('#luaran').wysihtml5();

    $('#rupiah').priceFormat({
        prefix: '',
        thousandsSeparator: '.',
        clearOnEmpty: true,
        centsLimit: 0
    });

    $('#statusPihakLuar').change(function(){
        var idStatus = $(this).val();
        //alert(idStatus);
        if ( idStatus == 1) 
        {
            $("#formPihakLuar").hide();
            $("#namaPihakLuar").prop("required",false);
            $("#nomorPihakLuar").prop("required",false);
            $("#organisasiPihakLuar").prop("required",false);
        }
        else
        {
            $("#formPihakLuar").show();
            $("#namaPihakLuar").prop("required",true);
            $("#nomorPihakLuar").prop("required",true);
            $("#organisasiPihakLuar").prop("required",true);
        }
    })
</script>

</body>
</html>