<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>
<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Manajemen Laporan Revisi</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Laporan Revisi</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Buat</li>
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
                                            <td><?php echo $row->tl_catatan ?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-green">
                            <div class="panel-heading">Form Laporan Revisi (Kegiatan : <?php echo $proposal->p_kegiatan ?>)</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/laporan/updateRevisi/'.$proposal->l_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Luaran Yang di Capai<span class="require">*</span></label>
                                            <div class="col-md-9"><textarea name="luaran" id="luaran" rows="3" class="form-control" required><?php echo $proposal->l_luaran ?></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Laporan dan Evaluasi<span class="require">*</span></label>
                                            <div class="col-md-9"><textarea name="evaluasi" id="evaluasi" rows="3" class="form-control" required><?php echo $proposal->l_evaluasi ?></textarea></div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Realisasi Dana Terpakai<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input name="biaya" placeholder="" class="form-control" type="number" value="<?php echo $proposal->l_realisasi_dana ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Bukti Penggunaan Dana<span class="require">*</span></label>
                                            <div class="col-md-1">
                                            <?php echo ($proposal->l_file_kuitansi == null) ? '' : '<a href="'.base_url().$proposal->l_file_kuitansi_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;BACA</button></a>' ?>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="file" name="kuitansi">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 3MB.</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label">Dokumentasi</label>
                                            <div class="col-md-9">
                                                <input name="linkBerita" placeholder="Link Berita Online" class="form-control" type="text" value="<?php echo $proposal->l_dokumentasi_link ?>">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Foto</label>
                                            <?php if($proposal->l_file_photo1 != null){ ?>
                                            <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo1_path ?>"></a></div>
                                            <?php } ?>

                                            <div class="col-md-6">
                                                <input type="file" name="foto1">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label"></label>
                                            <?php if($proposal->l_file_photo2 != null){ ?>
                                            <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo2_path ?>"></a></div>
                                            <?php } ?>
                                            <div class="col-md-6">
                                                <input type="file" name="foto2">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label"></label>
                                            <?php if($proposal->l_file_photo3 != null){ ?>
                                            <div class="col-sm-3 col-md-3"><a href="#" class="thumbnail"><img alt="hello" style="width: 300px; height: 180px;" src="<?php echo base_url().$proposal->l_file_photo3_path ?>"></a></div>
                                            <?php } ?>
                                            <div class="col-md-6">
                                                <input type="file" name="foto3">
                                                <p class="help-block">file dengan ekstensi png/jpg, dengan maksimal ukuran file 1MB.</p>
                                            </div>
                                            
                                        </div><br/>
                                        
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

    $('#evaluasi').wysihtml5();
    $('#luaran').wysihtml5();

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