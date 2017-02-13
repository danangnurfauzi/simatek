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
            <li class="hidden"><a href="#">daftar</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Profile</li>
        </ol>
        <div class="clearfix"></div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">

                <?php $suc = $this->session->flashdata('success'); if(isset($suc)){ ?>
                <div class="alert alert-success"><strong><?php echo $suc ?></strong></div>
                <?php } ?>

                <?php $err = $this->session->flashdata('error'); if(isset($err)){ ?>
                <div class="alert alert-danger"><strong><?php echo $err ?></strong></div>
                <?php } ?>

                <?php $errf = $this->session->flashdata('errorf'); if(isset($errf)){ ?>
                <div class="alert alert-danger"><strong><?php print_r($errf['error']) ?></strong></div>
                <?php } ?>

                <h2>Profile: <?php echo $personal->u_nama ?></h2>

                <div class="row mtl">
                    <div class="col-md-3">
                        <div class="form-group">
                            <form id="updatePicture" method="post" action="<?php echo site_url('user/updatePicture/'.$personal->u_id) ?>" enctype="multipart/form-data">
                            <div class="text-center mbl"><img src="<?php echo base_url().$personal->u_logo_path ?>" alt="" class="img-responsive"/></div>
                            <div class="text-center mbl" id="drop">
                                <!--button class="btn btn-green" id="buttonPict" /><i class="fa fa-upload"></i>&nbsp;Upload</button-->
                                <input type="file" name="pict" id="pict">
                                <input type="submit" value="upload" name="submit" class="btn btn-green">
                            </div>
                            </form>
                        </div>
                        <table class="table table-striped table-hover">
                            <tbody>
                            <tr>
                                <td>Level User</td>
                                <td><?php $role = $this->db->query("SELECT * FROM role WHERE r_id = ".$personal->ua_r_id)->row()->r_nama; echo $role ?></td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td><?php echo $personal->ua_username ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $personal->u_email ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Handphone</td>
                                <td><?php echo $personal->u_handphone ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-9">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-edit" data-toggle="tab">Edit Profile</a></li>
                            <li><a href="#tab-messages" data-toggle="tab">Account Setting</a></li>
                        </ul>
                        <div id="generalTabContent" class="tab-content">
                            <div id="tab-edit" class="tab-pane fade in active">
                                <form method="post" action="<?php echo site_url('user/user/updateProfile/'.$personal->u_id) ?>" class="form-horizontal">
                                    
                                    <h3>Profile Setting</h3>

                                    <div class="form-group"><label class="col-sm-3 control-label">Nama</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="nama" value="<?php echo $personal->u_nama ?>" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Singkatan</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="singkatan" value="<?php echo $personal->u_singkatan ?>" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Ketua</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="ketua" value="<?php echo $personal->u_ketua ?>" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Email</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="email" value="<?php echo $personal->u_email ?>" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Nomor Handphone</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                 <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="handphone" value="<?php echo $personal->u_handphone ?>" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Keterangan</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9">
                                                    <textarea name="deskripsi" id="keterangan" rows="3" class="form-control"><?php echo $personal->u_deskripsi ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <input type="submit" class="btn btn-green btn-block" value="UPDATE PROFILE" name="updateProfile" />
                                </form>
                            </div>
                            <div id="tab-messages" class="tab-pane fade in">
                                <form method="post" action="<?php echo site_url('user/user/updateUsername/'.$personal->ua_id) ?>" class="form-horizontal"><h3>Ganti Username</h3>

                                    <div class="form-group"><label class="col-sm-3 control-label">Username</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-9"><input type="text" placeholder="" class="form-control" name="username" /></div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                    <input type="submit" class="btn btn-green btn-block" value="CHANGE USERNAME" name="changeUsername" />
                                </form>
                                <form method="post" action="<?php echo site_url('user/user/updatePassword/'.$personal->ua_id) ?>" class="form-horizontal">
                                    <h3>Ganti Password</h3>

                                    <div class="form-group"><label class="col-sm-3 control-label">Password</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-4"><input type="password" placeholder="" class="form-control" name="passw" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Confirm Password</label>

                                        <div class="col-sm-9 controls">
                                            <div class="row">
                                                <div class="col-xs-4"><input type="password" placeholder="" class="form-control" name="rePassw" /></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <input type="submit" class="btn btn-green btn-block" value="CHANGE PASSWORD" name="changePassword" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">

    $('#keterangan').wysihtml5();

    /**$(function() {
        var files = $("#pict").val();
        $('#pict').uploadify({
            'method'   : 'post',
            'formData' : { 'files' : files },
            'swf'      : '<?php echo base_url()?>assets/vendors/uploadify/uploadify.swf',
            'uploader' : '<?php echo site_url() ?>user/user/updatePicture/<?php echo $personal->u_id ?>',
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorMsg);
            },
            'onUploadSuccess' : function(file, data, response) {
                alert('Berhasil Di Ganti');
                location.reload();
            }
            // Put your options here
        });
    });**/

</script>