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
                    <li class="hidden"><a href="#">Jenis Anggaran</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
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
                            <div class="panel-heading">Master Mata Anggaran</div>
                            <div class="panel-body">
                                
                                <!--a href="<?php echo site_url('anggaran/rancangan/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a><br/><br/-->

                                <form action="<?php echo site_url('anggaran/rancangan/insert') ?>" method="post" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Nama Mata Anggaran <span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input"><input name="nama" class="form-control" type="text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="TAMBAH DATA">
                                            &nbsp;
                                        </div>
                                    </div>
                                </form> <br/><br />
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabel">
                                        <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($daftar->num_rows() > 0){
                                                foreach($daftar->result() as $row){
                                                    ?>
                                            <tr>
                                                <td><?php echo $row->amk_nama ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('anggaran/rancangan/edit/'.$row->amk_id) ?>"><span class="label label-violet">Ubah</span></a>
                                                    <a href="<?php echo site_url('anggaran/rancangan/delete/'.$row->amk_id) ?>" onclick="return confirm('Yakin Akan Di Hapus')"><span class="label label-red">Hapus</span></a>
                                                </td>

                                            </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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