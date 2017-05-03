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

                                <form action="<?php echo current_url() ?>" method="post" class="form-horizontal">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tahun</label>
                                            <div class="col-md-6">
                                                <select name="tahun" class="form-control" required>
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <?php foreach($tahun->result() as $row) { ?>
                                                        <option value="<?php echo $row->TAHUN ?>" <?php echo ($selected == $row->TAHUN) ? "selected='selected'" : "" ?>><?php echo $row->TAHUN ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                            <input type="submit" class="btn btn-primary" name="submit" value="SUBMIT">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabel">
                                        <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Mata Anggaran</th>
                                            <th>Besar Anggaran</th>
                                            <th>Realisasi</th>
                                            <th>Saldo</th>
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

                                                       // echo number_format($real);

                                                        echo number_format($pemakaian);
                                                    
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo number_format($real); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
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
                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
             
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
             
                        // realisasi
                        realisasi = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            } );
             
                        // anggaran
                        anggaran = api
                            .column( 2, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        //saldo
                        saldo = api
                            .column( 4, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
             
                        // Update footer
                        $( api.column( 3 ).footer() ).html(
                            realisasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                        );

                        $( api.column( 2 ).footer() ).html(
                            anggaran.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                        );

                        $( api.column( 4 ).footer() ).html(
                            saldo.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                        );
                    }
                    } );
        //table.column( 3 ).data().sum();
    } );
</script>

</body>
</html>