<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<?php
    
    $status = array( 
        '0' => '<span class="label label-sm label-warning">Tunggu Proses Prodi</span>',
        '1' => '<span class="label label-sm label-info">Disetujui Oleh Prodi</span>',
        '2' => '<span class="label label-sm label-danger">Di Tolak Prodi</span>',
        '3' => '<span class="label label-sm label-warning">Harap Di Perbaiki (Prodi)</span>',
        '4' => '<span class="label label-sm label-warning">Tunggu Proses Fakultas</span>',
        '5' => '<span class="label label-sm label-info">Disetujui Oleh Fakultas</span>',
        '6' => '<span class="label label-sm label-danger">Di Tolak Fakultas</span>',
        '7' => '<span class="label label-sm label-warning">Harap Di Perbaiki (Fakultas)</span>',
         );

    $roleUser = array('1','3','4','5');
    
?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Proposal</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Proposal</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
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
                            <div class="panel-heading">Daftar Pengajuan Proposal</div>
                            <div class="panel-body">
                                
                                <?php if($_SESSION['roleId'] != 5){ ?>
                                <a href="<?php echo site_url('proposal/pengajuan/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Pengajuan Proposal</a><br/><br/>
                                <?php } ?>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabel">
                                        <thead>
                                        <tr>
                                            <?php if(in_array($_SESSION['roleId'],$roleUser)){ ?>
                                            <th>Organisasi</th>
                                            <?php } ?>
                                            <th>Kegiatan</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Nomor HP</th>
                                            <th>Total Biaya</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status Pengajuan</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($daftar->num_rows() > 0){
                                                foreach($daftar->result() as $row){
                                                    ?>
                                            <tr>
                                                <?php if(in_array($_SESSION['roleId'],$roleUser)){ ?>
                                                <td><?php echo $row->u_nama ?></td>
                                                <?php } ?>
                                                <td><?php echo $row->p_kegiatan ?></td>
                                                <td><?php echo $row->p_penanggung_jawab ?></td>
                                                <td><?php echo $row->p_handphone ?></td>
                                                <td><?php echo number_format($row->p_biaya) ?></td>
                                                <td><?php echo $row->p_tanggal_mulai ?></td>
                                                <td><?php echo $row->p_tanggal_selesai ?></td>
                                                
                                                <?php if(in_array($_SESSION['roleId'],$roleUser)){ ?>
                                                <td>
                                                    <?php 

                                                        $dataTrx = $this->db->query('SELECT * FROM trx_pengajuan WHERE tp_id = '.$row->p_tp_id)->row();

                                                        if( $_SESSION['roleId'] == 5 ){ 
                                                                 if($row->p_status < 4){ 
                                                                    if($row->p_status == 3 && $dataTrx->tp_updated != null){
                                                    ?>
                                                                    <a href="<?php echo site_url('proposal/pengajuan/proses/'.$row->p_id) ?>">
                                                                        <span class="label label-sm label-warning">Sudah Di Revisi (Prodi)</span>
                                                                    </a>
                                                    
                                                                    <?php }else{ ?>

                                                                    <a href="<?php echo site_url('proposal/pengajuan/proses/'.$row->p_id) ?>">
                                                                        <?php echo $status[$row->p_status] ?>
                                                                    </a>

                                                                    <?php } ?>
                                                                <?php }else{ 
                                                                 echo $status[$row->p_status] ?>
                                                                <?php } ?>
                                                    <?php }else{ 

                                                        if($row->p_status == 7 && $dataTrx->tp_updated != null){
                                                    ?>
                                                            <a href="<?php echo site_url('proposal/pengajuan/proses/'.$row->p_id) ?>">
                                                                <span class="label label-sm label-warning">Sudah Di Revisi (Fakultas)</span>
                                                            </a>
                                            
                                                            <?php }else{ ?>

                                                            <a href="<?php echo site_url('proposal/pengajuan/proses/'.$row->p_id) ?>">
                                                                <?php echo $status[$row->p_status] ?>
                                                            </a>

                                                            <?php } ?>
                                                    
                                                    <?php } ?>
                                                </td>
                                                <?php }else{ ?>
                                                <td>
                                                    <?php 
                                                        switch ($row->p_status) {
                                                            case '3':
                                                    ?>
                                                    <?php 
                                                        $dataTrx = $this->db->query('SELECT * FROM trx_pengajuan WHERE tp_id = '.$row->p_tp_id)->row();
                                                        if($dataTrx->tp_updated != null){
                                                    ?>

                                                    <span class="label label-sm label-warning">Sudah Di Revisi (Prodi)</span>

                                                    <?php }else{ ?>

                                                    <a href="<?php echo site_url('proposal/pengajuan/revisi/'.$row->p_id.'/'.$row->p_tp_id) ?>"><?php echo $status[$row->p_status] ?></a>

                                                    <?php } ?>
                                                    
                                                    <?php
                                                                break;

                                                            case '7':
                                                    ?>
                                                    <?php 
                                                        $dataTrx = $this->db->query('SELECT * FROM trx_pengajuan WHERE tp_id = '.$row->p_tp_id)->row();
                                                        if($dataTrx->tp_updated != null){
                                                    ?>

                                                    <span class="label label-sm label-warning">Sudah Di Revisi (Fakultas)</span>

                                                    <?php }else{ ?>

                                                    <a href="<?php echo site_url('proposal/pengajuan/revisi/'.$row->p_id.'/'.$row->p_tp_id) ?>"><?php echo $status[$row->p_status] ?></a>

                                                    <?php } ?>
                                                    
                                                <?php           
                                                                break;

                                                            default:
                                                                echo $status[$row->p_status];
                                                                break;
                                                        }
                                                    ?>
                                                </td>
                                                <?php } ?>
                                                
                                                <td>
                                                    <?php
                                                        if($row->p_file_rab != null)
                                                        {
                                                            echo '<a href="'.base_url().$row->p_file_rab_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>';
                                                        }
                                                        else
                                                        {
                                                            echo 'belum upload file';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo site_url('proposal/pengajuan/edit/'.$row->p_id) ?>"><span class="label label-violet">Ubah</span></a>
                                                    <a href="<?php echo site_url('proposal/pengajuan/delete/'.$row->p_id) ?>" onclick="return confirm('Yakin Akan Di Hapus')"><span class="label label-red">Hapus</span></a>
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