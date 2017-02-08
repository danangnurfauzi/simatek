<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>
<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Manajemen LPJ</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">LPJ</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Buat</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Form LPJ (Kegiatan : <?php echo $proposal->p_kegiatan ?>)</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/laporan/insert/'.$id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Luaran Yang di Capai<span class="require">*</span></label>
                                            <div class="col-md-9"><textarea name="luaran" id="luaran" rows="3" class="form-control" required></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Laporan dan Evaluasi<span class="require">*</span></label>
                                            <div class="col-md-9"><textarea name="evaluasi" id="evaluasi" rows="3" class="form-control" required></textarea></div>
                                        </div>
                                        <br/>
                                        <br/>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Realisasi Dana Terpakai<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input name="biaya" placeholder="" class="form-control" type="number" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Bukti Penggunaan Dana<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input type="file" name="kuitansi">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 3MB.</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label">Dokumentasi</label>
                                            <div class="col-md-9">
                                                <input name="linkBerita" placeholder="Link Berita Online" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Foto</label>
                                            <div class="col-md-9">
                                                <input type="file" name="foto1">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                                <input type="file" name="foto2">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label"></label>
                                            <div class="col-md-9">
                                                <input type="file" name="foto3">
                                                <p class="help-block">file dengan ekstensi png/jpg, dengan maksimal ukuran file 1MB.</p>
                                            </div>
                                            
                                        </div><br/>
                                        
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