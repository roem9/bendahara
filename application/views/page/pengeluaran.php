<!-- tambah pengeluaran -->
    <div class="modal fade" id="modalTambahPengeluaran" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPengeluaranLabel">Tambah Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>admin/add_pengeluaran" method="POST">
                    <div class="form-group">
                        <label for="tgl">Tgl Pengeluaran</label>
                        <input type="date" name="tgl_pengeluaran" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="pelaku">Pelaku</label>
                        <input type="text" name="pelaku" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" name="nominal" id="add-nominal" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="keternagan">Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-sm" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Tambah Pengeluaran" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- tambah pengeluaran -->

<!-- edit pengeluaran -->
    <div class="modal fade" id="modalEditPengeluaran" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPengeluaranLabel">Edit Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>admin/edit_pengeluaran" method="POST">
                    <input type="hidden" name="id_pengeluaran" id="id_pengeluaran">
                    <div class="form-group">
                        <label for="tgl">Tgl Pengeluaran</label>
                        <input type="date" name="tgl_pengeluaran" id="tgl_pengeluaran" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="pelaku">Pelaku</label>
                        <input type="text" name="pelaku" id="pelaku" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" name="nominal" id="nominal" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="keternagan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control form-control-sm" rows="5"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Edit Pengeluaran" class="btn btn-sm btn-success">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- edit pengeluaran -->

<div class="container">
    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <?= $this->session->flashdata('pesan');?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <a href="#modalTambahPengeluaran" data-toggle="modal" class="modal-tambah-pengeluaran btn btn-success btn-block btn-sm mb-3"><div class="i fa fa-plus mr-1"></div>tambah pengeluaran</a>
        </div>
    </div>
    <div class="row">
        <?php if(COUNT($pengeluaran) != 0):?>
            <?php foreach ($pengeluaran as $pengeluaran) :?>
                <div class="col-12 col-md-4 mb-2">
                    <ul class="list-group shadow">
                        <li class="list-group-item list-group-item-danger d-flex justify-content-between"><?= rupiah($pengeluaran['nominal'])?> 
                            <span>
                                <a href="<?= base_url()?>admin/delete_pengeluaran/<?= $pengeluaran['id_pengeluaran']?>" onclick="return confirm('Yakin akan menghapus pengeluaran?')" class="btn btn-outline-danger btn-sm mr-1">hapus</a>
                                <a href="#modalEditPengeluaran" data-toggle="modal" data-id="<?= $pengeluaran['id_pengeluaran']?>" class="modal-edit-pengeluaran btn btn-outline-success btn-sm">edit</a>
                            </span>
                        </li>
                        <li class="list-group-item"><?= date('d-M-Y', strtotime($pengeluaran['tgl_pengeluaran']))?></li>
                        <li class="list-group-item"><?= $pengeluaran['pelaku']?></li>
                        <li class="list-group-item"><?= $pengeluaran['keterangan']?></li>
                    </ul>
                </div>
            <?php endforeach;?>
        <?php else :?>
            <div class="col-12 col-md-6">
                <div class="alert alert-warning" role="alert">
                   <i class="fa fa-info-circle mr-1 text-warning"></i> Data Kosong
                </div>
            </div>
        <?php endif;?>
    </div>
</div>

<script>
    $("#pengeluaran").addClass("active");
    $(".modal-edit-pengeluaran").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_pengeluaran_by_id",
            data: {id: id},
            dataType: "json",
            method: "POST",
            async: true,
            success: function(data){
                $("#id_pengeluaran").val(data.id_pengeluaran);
                $("#tgl_pengeluaran").val(data.tgl_pengeluaran);
                $("#pelaku").val(data.pelaku);
                $("#keterangan").val(data.keterangan);
                $("#nominal").val(formatRupiah(data.nominal, 'Rp. '));
            }
        })
    })
    $("#add-nominal").keyup(function(){
        $("#add-nominal").val(formatRupiah(this.value, 'Rp. '))
    })
    
    $("#nominal").keyup(function(){
        $("#nominal").val(formatRupiah(this.value, 'Rp. '))
    })
</script>


