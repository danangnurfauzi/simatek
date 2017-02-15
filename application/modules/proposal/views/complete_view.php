<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>
<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Proposal</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Proposal</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Melengkapi</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Form Pelengkap Proposal (Kegiatan : <?php echo $proposal->p_kegiatan ?>)</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/pengajuan/insertComplete/'.$proposal->p_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Surat Pernyataan Panitia</label>
                                            
                                            <?php if($complete->num_rows() > 0){ if($complete->row()->pc_surat_pernyataan_panitia != null){ ?>
                                            <div class="col-sm-1 col-md-1"><a href="<?php echo base_url().$complete->row()->pc_surat_pernyataan_panitia_path ?>" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a></div>
                                            <div class="col-md-8">
                                            <?php } }else{
                                            ?>
                                            <div class="col-md-9">
                                            <?php } ?> 
                                                <input type="file" name="panitia">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 1MB.</p>
                                            </div>

                                        </div>

                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Izin Kegiatan dari Pemerintah Lokasi Kegiatan</label>
                                            <?php if($complete->num_rows() > 0){ if($complete->row()->pc_surat_izin_pemerintah != null){ ?>
                                            <div class="col-sm-1 col-md-1"><a href="<?php echo base_url().$complete->row()->pc_surat_izin_pemerintah_path ?>" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a></div>
                                            <div class="col-md-8">
                                            <?php } }else{
                                            ?>
                                            <div class="col-md-9">
                                            <?php } ?>
                                                <input type="file" name="pemerintah">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 1MB.</p>
                                            </div>
                                        </div>

                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Izin Kegiatan dari Kepolisian Lokasi Kegiatan</label>
                                            <?php if($complete->num_rows() > 0){ if($complete->row()->pc_surat_izin_polisi != null){ ?>
                                            <div class="col-sm-1 col-md-1"><a href="<?php echo base_url().$complete->row()->pc_surat_izin_polisi_path ?>" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a></div>
                                            <div class="col-md-8">
                                            <?php } }else{
                                            ?>
                                            <div class="col-md-9">
                                            <?php } ?>
                                                <input type="file" name="polisi">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 1MB.</p>
                                            </div>
                                        </div>

                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Surat Izin dari orang tua wali panitia dan peserta</label>
                                            <?php if($complete->num_rows() > 0){ if($complete->row()->pc_surat_izin_ortu != null){ ?>
                                            <div class="col-sm-1 col-md-1"><a href="<?php echo base_url().$complete->row()->pc_surat_izin_ortu_path ?>" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a></div>
                                            <div class="col-md-8">
                                            <?php } }else{
                                            ?>
                                            <div class="col-md-9">
                                            <?php } ?>
                                                <input type="file" name="ortu">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 10MB.</p>
                                            </div>
                                        </div>

                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File Surat Keterangan Sehat Dari Dokter Semua Panitia dan Peserta</label>
                                            <?php if($complete->num_rows() > 0){ if($complete->row()->pc_surat_izin_dokter != null){ ?>
                                            <div class="col-sm-1 col-md-1"><a href="<?php echo base_url().$complete->row()->pc_surat_izin_dokter_path ?>" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a></div>
                                            <div class="col-md-8">
                                            <?php } }else{
                                            ?>
                                            <div class="col-md-9">
                                            <?php } ?>
                                                <input type="file" name="dokter">
                                                <p class="help-block">file dengan ekstensi pdf, dengan maksimal ukuran file 10MB.</p>
                                            </div>
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