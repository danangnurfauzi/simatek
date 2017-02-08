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
                    <li class="hidden"><a href="#">daftar</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit</li>
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
                            <div class="panel-heading">Master Jenis Anggaran</div>
                            <div class="panel-body">
                                
                                <form action="<?php echo site_url('anggaran/rancangan/update/'.$data->amk_id) ?>" method="post" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Nama Jenis Anggaran <span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input"><input value="<?php echo $data->amk_nama ?>" name="nama" class="form-control" type="text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="UBAH DATA">
                                            &nbsp;
                                            <a href="<?php echo site_url('anggaran/rancangan/jenis') ?>" class="btn btn-green">Cancel</a>
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

</body>
</html>