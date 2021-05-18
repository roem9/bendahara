<!-- tambah pemasukan -->
<div class="modal fade" id="modalTransaksi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTransaksiLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="list-transaksi"></ul>
            </div>
            </div>
        </div>
    </div>
<!-- tambah pemasukan -->

<div class="container">
    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <?= $this->session->flashdata('pesan');?>
                </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12 col-md-6">
            <ul class="list-group mb-2">
                <li class="list-group-item list-group-item-success d-flex justify-content-between">Saldo <span><?= rupiah($saldo)?></span></li>
            </ul>
        </div>
        <?php if(isset($transaksi)):?>
        <?php foreach ($transaksi as $transaksi) :?>
            <div class="col-12 col-md-6 mb-2">
                <ul class="list-group">
                    <?php if($transaksi['pemasukan'] - $transaksi['pengeluaran'] < 0):?>
                        <li class="list-group-item list-group-item-danger d-flex justify-content-between"><?= $bulan[$transaksi['bulan']] . " " .$transaksi['tahun']?> <span><?= rupiah($transaksi['pemasukan'] - $transaksi['pengeluaran'])?></span></li>
                    <?php else :?>
                        <li class="list-group-item list-group-item-info d-flex justify-content-between"><?= $bulan[$transaksi['bulan']] . " " .$transaksi['tahun']?> <span><?= rupiah($transaksi['pemasukan'] - $transaksi['pengeluaran'])?></span></li>
                    <?php endif;?>
                    <li class="list-group-item d-flex justify-content-between">Pemasukan <span><a href="#modalTransaksi" class="modal-pemasukan" data-toggle="modal" data-id="<?= $transaksi['bulan'] . ' ' .$transaksi['tahun']?>"><?php if($transaksi['pemasukan'] == null){echo "-";}else{echo rupiah($transaksi['pemasukan']);}?></a></span></li>

                    <li class="list-group-item d-flex justify-content-between">Pengeluaran <span><a href="#modalTransaksi" class="modal-pengeluaran" data-toggle="modal" data-id="<?= $transaksi['bulan'] . ' ' .$transaksi['tahun']?>"><?php if($transaksi['pengeluaran'] == null){echo "-";}else{echo rupiah($transaksi['pengeluaran']);}?></a></span></li>
                </ul>
            </div>
        <?php endforeach;?>
        <?php else:?>
            <div class="col-12 col-md-6">
                <div class="alert alert-warning" role="alert">
                   <i class="fa fa-info-circle mr-1 text-warning"></i> Tidak ada data
                </div>
            </div>
        <?php endif;?>
    </div>
</div>

<script>
    $("#rekap").addClass("active");

    $(".modal-pemasukan").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_pemasukan_per_periode",
            method: "POST",
            dataType: "json",
            async: true,
            data: {id: id},
            success: function(data){
                $("#modalTransaksiLabel").html("Pemasukan Periode "+id)
                let html = "";
                for (let i = 0; i < data.length; i++) {
                    html += `<li class="list-group-item">
                            <div class="row">
                                <div class="col-8">
                                    `+data[i].keterangan+`
                                </div>
                                <div class="col-4">
                                    `+formatRupiah(data[i].nominal, 'Rp. ')+`
                                </div>
                            </div>
                        </li>`
                }

                $("#list-transaksi").html(html)
            }
        })
    })
    
    $(".modal-pengeluaran").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_pengeluaran_per_periode",
            method: "POST",
            dataType: "json",
            async: true,
            data: {id: id},
            success: function(data){
                $("#modalTransaksiLabel").html("Pengeluaran Periode "+id)
                let html = "";
                for (let i = 0; i < data.length; i++) {
                    html += `<li class="list-group-item">
                            <div class="row">
                                <div class="col-8">
                                    `+data[i].keterangan+`
                                </div>
                                <div class="col-4">
                                    `+formatRupiah(data[i].nominal, 'Rp. ')+`
                                </div>
                            </div>
                        </li>`
                }

                $("#list-transaksi").html(html)
            }
        })
    })
</script>


