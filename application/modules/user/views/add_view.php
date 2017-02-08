<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>
<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">User</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Add</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-green">
                            <div class="panel-heading">Form Tambah User</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('user/insert') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Level User<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="levelUser" class="form-control" id="levelUser">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($role->num_rows() > 0){ 
                                                            foreach($role->result() as $row){
                                                    ?>
                                                    <option value="<?php echo $row->r_id?>"><?php echo $row->r_nama ?></option>
                                                    <?php
                                                            }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="formNaunganLembaga" style="display: none;">
                                            <label class="col-md-3 control-label">Naungan Lembaga<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="naunganLembaga" class="form-control" id="naunganLembaga">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="1">LEMBAGA FAKULTAS</option>
                                                    <option value="2">LEMBAGA PRODI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="formProdi" style="display: none;">
                                            <label class="col-md-3 control-label">Prodi<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <select name="prodi" class="form-control" id="prodi">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php if($prodi->num_rows() > 0){ 
                                                            foreach($prodi->result() as $p){
                                                    ?>
                                                    <option value="<?php echo $p->p_id?>"><?php echo $p->p_nama ?></option>
                                                    <?php
                                                            }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="formNamaLembaga" style="display: none;">
                                            <label class="col-md-3 control-label">Nama Lembaga Kegiatan Mahasiswa<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input name="nama" placeholder="" class="form-control" type="text" required id="namaLembaga">
                                            </div>
                                        </div>
                                        <div class="form-group" id="formSingkatanLembaga" style="display: none;">
                                            <label for="inputEmail" class="col-md-3 control-label">Singkatan Lembaga Kegiatan Mahasiswa<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input name="singkatan" placeholder="" class="form-control" type="text" required id="singkatanLembaga">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-md-3 control-label">Username<span class="require">*</span></label>
                                            <div class="col-md-9">
                                                <input name="username" placeholder="" class="form-control" type="text" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="inputAddress" class="col-md-3 control-label">Nama</label>
                                            <div class="col-md-9">
                                                </i><input name="ketua" placeholder="" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="inputAddress" class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">
                                                </i><input name="email" placeholder="" class="form-control" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group"><label for="inputAddress" class="col-md-3 control-label">Nomor Handphone</label>
                                            <div class="col-md-9">
                                                <div class="input-group"></i><input name="hp" placeholder="" class="form-control" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group mbn"><label for="inputContent" class="col-md-3 control-label">Keterangan</label>

                                            <div class="col-md-9"><textarea name="deskripsi" id="inputContent" rows="3" class="form-control"></textarea></div>
                                        </div>
                                        <br/>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">Foto/Logo</label>

                                            <div class="col-md-9"><input type="file" name="logo">

                                                <p class="help-block">file gambar dengan ekstensi jpg/png, dengan maksimal ukuran file 1MB.</p></div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                            &nbsp;
                                            <a href="<?php echo site_url('user/userList') ?>" class="btn btn-green">Cancel</a>
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
    
    $("#levelUser").change(function(){

        var level = $(this).val();

        switch(level)
        {
            case '2':
                $("#formNaunganLembaga").show();
                $("#formProdi").show();
                $("#formNamaLembaga").show();
                $("#formSingkatanLembaga").show();

                $("#namaLembaga").prop('required',true);
                $("#singkatanLembaga").prop('required',true);
                break;

            case '5':
                $("#formNaunganLembaga").hide();
                $("#formProdi").show();
                $("#formNamaLembaga").hide();
                $("#formSingkatanLembaga").hide();

                $("#namaLembaga").prop('required',false);
                $("#singkatanLembaga").prop('required',false);
                break;

            default:
                $("#formNaunganLembaga").hide();
                $("#formProdi").hide();
                $("#formNamaLembaga").hide();
                $("#formSingkatanLembaga").hide();

                $("#namaLembaga").prop('required',false);
                $("#singkatanLembaga").prop('required',false);
                break;
        }

    });

    $("#naunganLembaga").change(function(){
        var idNaunganLembaga = $(this).val();
        if (idNaunganLembaga == 1)
        {
            $("#formProdi").hide();
        }
        else
        {
            $("#formProdi").show();
        }
    });

</script>

</body>
</html>