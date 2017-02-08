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
                    <li class="active">List</li>
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

                        <div class="panel panel-blue">
                            <div class="panel-heading">Daftar User</div>
                            <div class="panel-body">
                                <a href="<?php echo site_url('user/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah User</a><br/><br/>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabel">
                                        <thead>
                                        <tr>
                                            <th>Level User</th>
                                            <th>Nama</th>
                                            <th>No. HP</th>
                                            <th>Gambar</th>
                                            <th>Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($daftar->num_rows() > 0){
                                                foreach($daftar->result() as $row){
                                                    ?>
                                            <tr>
                                                <td><?php echo role($row->ua_r_id) ?></td>
                                                <td><?php echo $row->u_ketua ?></td>
                                                <td><?php echo $row->u_handphone ?></td>
                                                <td><?php echo ($row->u_logo == null) ? 'belum di set' : '<img width="35" src="'.base_url().$row->u_logo_path.'">' ?></td>
                                                <td><?php echo $row->ua_username ?></td>
                                                <td>
                                                    <a href="<?php echo site_url('user/edit/'.$row->u_id) ?>"><span class="label label-violet">Ubah</span></a>
                                                    <a href="<?php echo site_url('user/delete/'.$row->u_id) ?>" onclick="return confirm('Yakin Akan Di Hapus')"><span class="label label-red">Hapus</span></a>
                                                    <a href="<?php echo site_url('user/resetPassword/'.$row->u_id) ?>"><span class="label label-yellow">Reset Password</span></a>
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