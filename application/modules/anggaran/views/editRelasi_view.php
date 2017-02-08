<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Anggaran</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Anggaran</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">Set Anggaran</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Data</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">

                        <?php $suc = $this->session->flashdata('success'); if(isset($suc)){ ?>
                        <div class="alert alert-success"><strong><?php echo $suc ?></strong></div>
                        <?php } ?>

                        <?php $err = $this->session->flashdata('error'); if(isset($err)){ ?>
                        <div class="alert alert-danger"><strong><?php echo $err ?></strong></div>
                        <?php } ?>

                        <?php $errf = $this->session->flashdata('errorf'); if(isset($errf)){ ?>
                        <div class="alert alert-danger"><strong><?php print_r($errf['error']) ?></strong></div>
                        <?php } ?>

                        <div class="panel panel-blue">
                            <div class="panel-heading">Relasi Jenis Anggaran</div>
                            <div class="panel-body">
                                
                                <!--a href="<?php echo site_url('anggaran/rancangan/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a><br/><br/-->

                                <form action="<?php echo site_url('anggaran/rancangan/updateRelasi/'.$data->ark_id) ?>" method="post" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tahun<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="tahun" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php for ($i = date('Y'); $i < date('Y') + 2; $i++) { ?>
                                                        <option value="<?php echo $i ?>" <?php echo ($i == $data->ark_tahun) ? 'selected="selected"' : '' ?>><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Anggaran<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="anggaranKegiatan" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($anggaranKegiatan->num_rows() > 0) { foreach($anggaranKegiatan->result() as $row){ ?>
                                                        <option value="<?php echo $row->amk_id ?>" <?php echo ($row->amk_id == $data->ark_amk_id) ? 'selected="selected"' : '' ?>><?php echo $row->amk_nama ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Kegiatan<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="jenisKegiatan" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($jenisKegiatan->num_rows() > 0) { foreach($jenisKegiatan->result() as $jk){ ?>
                                                        <option value="<?php echo $jk->jk_id ?>" <?php echo ($jk->jk_id == $data->ark_jk_id) ? 'selected="selected"' : '' ?>><?php echo $jk->jk_nama ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="UBAH DATA">
                                            &nbsp;
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
    $(document).ready(function() {
        $('#tabel').DataTable();
    } );
</script>

</body>
</html>