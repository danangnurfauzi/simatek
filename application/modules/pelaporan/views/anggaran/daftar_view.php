<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Pelaporan</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Anggaran</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">daftar</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Daftar</li>
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
                            <div class="panel-heading">Form Pelaporan Anggaran</div>
                            <div class="panel-body">
                                
                                <form id="idForm" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tahun</label>
                                            <div class="col-md-6">
                                                <select name="tahun" class="form-control" required>
                                                    <option value="0">------PILIH SALAH SATU------</option>
                                                    <?php foreach($tahun->result() as $row) { ?>
                                                        <option value="<?php echo $row->TAHUN ?>"><?php echo $row->TAHUN ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mata Anggaran</label>
                                            <div class="col-md-6">
                                                <select name="mataAnggaran" class="form-control" required>
                                                    <option value="0">------PILIH SALAH SATU------</option>
                                                    <?php foreach($mata->result() as $mt) { ?>
                                                        <option value="<?php echo $mt->amk_id ?>"><?php echo $mt->amk_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Lembaga Kegiatan Mahasiswa</label>
                                            <div class="col-md-6">
                                                <select name="lkm" class="form-control" required>
                                                    <option value="0">------PILIH SALAH SATU------</option>
                                                    <?php foreach($lkm->result() as $l) { ?>
                                                        <option value="<?php echo $l->u_id ?>"><?php echo $l->u_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Kegiatan</label>
                                            <div class="col-md-6">
                                                <select name="kegiatan" class="form-control" required>
                                                    <option value="0">------PILIH SALAH SATU------</option>
                                                    <?php foreach($kegiatan->result() as $keg) { ?>
                                                        <option value="<?php echo $keg->jk_id ?>"><?php echo $keg->jk_nama ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="SUBMIT">
                                            &nbsp;
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="panel panel-blue" id="result" style="display: none;">
                            <div class="panel-heading">Hasil</div>
                            <div class="panel-body">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--END CONTENT-->

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $("#idForm").submit(function(e) {

        var url = '<?php echo base_url() ?>pelaporan/anggaran/dataPost'; // the script where you handle the form input.

        $.ajax({
               type: "POST",
               url: url,
               data: $("#idForm").serialize(), // serializes the form's elements.
               success: function(data)
               {
                   alert(data); // show response from the php script.
               }
             });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
    
</script>

</body>
</html>