<?php $this->load->view('templates/header') ?>
<?php $this->load->view('templates/header_top_bar') ?>
<?php $this->load->view('templates/sidebar') ?>

<?php $bulan = array( 1 => 'Januari', 'Februari' , 'Maret' , 'April' , 'Mei' , 'Juni' , 'Juli' , 'Agustus' , 'September' , 'Oktober' , 'November' , 'Desember' ) ?>

<div id="page-wrapper"><!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Manajemen Proposal</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="index.html">Proposal</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">User</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Pengajuan</li>
                </ol>
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div class="row">
                    <div class="col-lg-12">

                        <?php $err = $this->session->flashdata('error'); if(isset($err)){ ?>
                        <div class="alert alert-danger"><strong><?php echo $err ?></strong></div>
                        <?php } ?>
                        
                        <div class="panel panel-green">
                            <div class="panel-heading">Form Set Mata Anggaran Untuk Proposal</div>
                            <div class="panel-body pan">
                                <form action="<?php echo site_url('proposal/pengajuan/prosesSetMataAnggaranProposal/'.$proposal->p_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Organisasi</label>
                                            <div class="col-md-9">
                                                <?php $jenisKegiatan = $this->db->query("SELECT * FROM user WHERE u_id = ".$proposal->p_u_id)->row()->u_nama ?>
                                                <h3 class="text-green"><?php echo $jenisKegiatan ?></h3>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Jenis Kegiatan</label>
                                            <div class="col-md-9">
                                                <?php $jenisKegiatan = $this->db->query("SELECT * FROM jenis_kegiatan WHERE jk_id = ".$proposal->p_jk_id)->row()->jk_nama ?>
                                                <h3 class="text-green"><?php echo $jenisKegiatan ?></h3>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Lingkup Kegiatan</label>
                                            <div class="col-md-9">
                                                <?php
                                                    switch ($proposal->p_lingkup)
                                                    {
                                                        case '1':
                                                            $lingkup = 'INTERNAL';
                                                            break;
                                                        
                                                        case '2':
                                                            $lingkup = 'REGIONAL';
                                                            break;

                                                        case '3':
                                                            $lingkup = 'NASIONAL';
                                                            break;

                                                        case '4':
                                                            $lingkup = 'INTERNASIONAL';
                                                            break;
                                                    }
                                                ?>
                                                <h3 class="text-green"><?php echo $lingkup ?></h3>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Judul Kegiatan</label>
                                            <div class="col-md-9">
                                                <h3 class="text-green"><?php echo $proposal->p_kegiatan ?></h3>
                                                <!--input name="nama" placeholder="" class="form-control" type="text" value="<?php echo $proposal->p_kegiatan ?>" disabled-->
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group"><label for="exampleInputFile" class="col-md-3 control-label">File RAB</label>
                                            <?php echo ($proposal->p_file_rab == null) ? 'Belum Upload' : '<a href="'.base_url().$proposal->p_file_rab_path.'" target="__blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file-text"></i>&nbsp;LIHAT</button></a>' ?>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label for="inputAddress" class="col-md-3 control-label">Total Anggaran Dibutuhkan</label>
                                            <div class="col-md-9">
                                                <h3 class="text-green">Rp. <?php echo number_format($proposal->p_biaya) ?></h3>
                                                <!--input name="biaya" placeholder="" class="form-control" type="number" value="<?php echo $proposal->p_biaya ?>" disabled-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress" class="col-md-3 control-label">Rencana Anggaran di Setujui</label>
                                            <div class="col-md-9">
                                                <h3 class="text-green">Rp. <?php echo number_format($proposal->p_biaya_mata_anggaran_temp) ?></h3>
                                                <!--input name="biaya" placeholder="" class="form-control" type="number" value="<?php echo $proposal->p_biaya ?>" disabled-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress" class="col-md-3 control-label">Rencana Diambil Dari Mata Anggaran</label>
                                            <div class="col-md-9">
                                                <h3 class="text-green"><?php echo $mataAnggaran ?></h3>
                                                <!--input name="biaya" placeholder="" class="form-control" type="number" value="<?php echo $proposal->p_biaya ?>" disabled-->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Keputusan<span class="require">*</span></label>
                                            <div class="col-md-9">
                                            <?php 
                                                    switch ($_SESSION['roleId']) 
                                                    {
                                                        case '3':
                                            ?>
                                                <select name="status" class="form-control" id="status">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="8">Diterima</option>
                                                    <option value="9">Ditolak</option>
                                                </select>
                                            <?php   
                                                            break;
                                                        case '4': 
                                            ?>
                                                <select name="status" class="form-control" id="status">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="7">Harap Diperbaiki</option>
                                                    <option value="5">Diterima</option>
                                                    <option value="6">Ditolak</option>
                                                </select>
                                            <?php               
                                                            break;
                                                        
                                                        case '5':
                                                ?>
                                                <select name="status" class="form-control" id="status">
                                                    <option>------PILIH SALAH SATU------</option>
                                                    <option value="3">Harap Diperbaiki</option>
                                                    <option value="4">Diterima</option>
                                                    <option value="2">Ditolak</option>
                                                </select>
                                                <?php
                                                            break;
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                        <div class="form-group" id="formRealMataAnggaran">
                                            <label class="col-md-3 control-label">Realisasi Mata Anggaran</label>
                                            <div class="col-md-3">
                                                <select name="amkId" class="form-control" id="matang">
                                                    <option value="0">------PILIH SALAH SATU------</option>
                                                    <?php if($anggaran->num_rows() > 0){ 
                                                            foreach($anggaran->result() as $row){
                                                    ?>
                                                    <option value="<?php echo $row->amk_id?>"><?php echo $row->amk_nama ?></option>
                                                    <?php
                                                            }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input name="biayaRealisasi" placeholder="" class="form-control" id="rupiah">
                                            </div>
                                            <div class="col-md-3">
                                                <a href="javascript:setter()" class="btn btn-blue" id="setter">Set</a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3"></label>
                                            <div class="col-md-9">
                                                <table class="table table-hover table-striped" id="tabel">
                                                    <thead>
                                                    <tr>
                                                        <th>Mata Anggaran</th>
                                                        <th>Jumlah</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="addRow">
                                                    
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                            &nbsp;
                                            <a href="<?php echo site_url('proposal/pengajuan/daftar') ?>" class="btn btn-green">Cancel</a>
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

    $('#formRealMataAnggaran').hide();
    $('#tabel').hide();

    $('#status').change(function(){
        var set = $(this).val();
        
        if (set == 8)
        {
            $('#formRealMataAnggaran').show();
            $('#tabel').show();
        }
        else
        {
            $('#formRealMataAnggaran').hide();
            $('#tabel').show();
        }
    });

    $('#rupiah').priceFormat({
        prefix: '',
        thousandsSeparator: '.',
        clearOnEmpty: true,
        centsLimit: 0
    });

    function setter()
    {
        var namaVal = $("#matang").val();
        var id = $("#rupiah").val();
        var nama = $("#matang option:selected").text();

        $("#rupiah").val('');
        $("#matang").val('0');

        if(namaVal == 0){
            alert("Pilih Mata Anggaran");
        }

        if(id == ''){
            alert("Masukkan Jumlah Anggaran")
        }

        if(namaVal != 0 && id != ''){

            $("#addRow").append('<tr id="'+namaVal+'"><td><input type="hidden" name="amk_id[]" value="'+namaVal+'" /><input type="hidden" name="angka[]" value="'+id+'" />'+nama+'</td><td>'+id+'</td><td><a href="javascript:deleteRow('+namaVal+')"><i class="fa fa-times"></i></a></td></tr>')
        }
    }

    function deleteRow(id)
    {
        $("#"+id).remove();
    }

</script>

</body>
</html>