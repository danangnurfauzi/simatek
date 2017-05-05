<?php $this->load->view('templates/header') ?>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="tabeles">
        <thead>
        <tr>
            <th>Tahun</th>
            <th>Mata Anggaran</th>
            <th>Lembaga Kegiatan</th>
            <th>Jenis Kegiatan</th>
            <th>Biaya Realisasi</th>
        </tr>
        </thead>

        <tbody>
            <?php foreach($data->result() as $row){ ?>
            <tr>
                <td><?php echo $row->TAHUN ?></td>
                <td><?php echo $row->amk_nama ?></td>
                <td><?php echo $row->u_nama ?></td>
                <td><?php echo $row->jk_nama ?></td>
                <td style="text-align: right;"><?php echo number_format($row->pma_angka) ?></td>
            </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;">TOTAL</th>
                <th style="text-align: right;"></th>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<?php $this->load->view('templates/footer') ?>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tabeles').DataTable( {
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
                                .column( 4 )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                } );
                 
                            // Update footer
                            $( api.column( 4 ).footer() ).html(
                                realisasi.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                            );

                        }
                    } );
        //table.column( 3 ).data().sum();
    } );
</script>