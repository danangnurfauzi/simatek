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
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Realisasi</li>
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
                            <div class="panel-heading">Daftar Mata Anggaran</div>
                            <div class="panel-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabel">
                                        <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Mata Anggaran</th>
                                            <th>Besar Anggaran</th>
                                            <th>Realisasi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($listing->result() as $row){ ?>
                                            <tr>
                                                <td><?php echo $row->abk_tahun ?></td>
                                                <td><?php echo $row->amk_nama ?></td>
                                                <td><?php echo number_format($row->abk_nilai) ?></td>
                                                <td>
                                                    <?php 
                                                        
                                                        $pemakaian = realisasiAnggaranKegiatan($row->amk_id , $row->abk_tahun);

                                                        $real = $row->abk_nilai - $pemakaian;

                                                        echo number_format($real);
                                                    
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
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
        var table = $('#tabel').DataTable( {
                        "dom": 'T<"clear">lfrtip',
                        "tableTools": {
                            "sSwfPath": "../../assets/vendors/DataTables/TableTools-2.2.4/swf/copy_csv_xls_pdf.swf",
                            "aButtons": [ "xls", "pdf" , "print" ]
                        }
                    } );
    } );
</script>

</body>
</html>