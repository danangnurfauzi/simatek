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
                            <div class="panel-heading">Set Nilai Jenis Anggaran</div>
                            <div class="panel-body">
                                
                                <!--a href="<?php echo site_url('anggaran/rancangan/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a><br/><br/-->

                                <form action="<?php echo site_url('anggaran/rancangan/insertSet') ?>" method="post" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tahun<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="tahun" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php for ($i = date('Y'); $i < date('Y') + 2; $i++) { ?>
                                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Anggaran<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="jenisAnggaran" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($jenis->num_rows() > 0) { foreach($jenis->result() as $row){ ?>
                                                        <option value="<?php echo $row->amk_id ?>"><?php echo $row->amk_nama ?></option>
                                                    <?php } } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="inputUsername" class="col-md-3 control-label">Nilai Anggaran <span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input"><input name="nilai" class="form-control" type="number"></div>
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
                                            <th>Tahun</th>
                                            <th>Jenis Anggaran</th>
                                            <th>Nilai Anggaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($daftar->num_rows() > 0){
                                                foreach($daftar->result() as $row){
                                                    ?>
                                            <tr>
                                                <td><?php echo $row->abk_tahun ?></td>
                                                <td><?php echo $row->amk_nama ?></td>
                                                <td><?php echo number_format($row->abk_nilai) ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('anggaran/rancangan/editSet/'.$row->abk_id) ?>"><span class="label label-violet">Ubah</span></a>
                                                    <a href="<?php echo site_url('anggaran/rancangan/deleteSet/'.$row->abk_id) ?>" onclick="return confirm('Yakin Akan Di Hapus')"><span class="label label-red">Hapus</span></a>
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