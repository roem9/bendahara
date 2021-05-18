<!-- tambah pemasukan -->
    <div class="modal fade" id="modalTambahPemasukan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPemasukanLabel">Tambah Pemasukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>admin/add_pemasukan" method="POST">
                    <div class="form-group">
                        <label for="tgl">Tgl Pemasukan</label>
                        <input type="date" name="tgl_pemasukan" class="form-control form-control-sm">
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
                        <input type="submit" value="Tambah Pemasukan" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- tambah pemasukan -->

<!-- edit pemasukan -->
    <div class="modal fade" id="modalEditPemasukan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPemasukanLabel">Edit Pemasukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>admin/edit_pemasukan" method="POST">
                    <input type="hidden" name="id_pemasukan" id="id_pemasukan">
                    <div class="form-group">
                        <label for="tgl">Tgl Pemasukan</label>
                        <input type="date" name="tgl_pemasukan" id="tgl_pemasukan" class="form-control form-control-sm">
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
                        <input type="submit" value="Edit Pemasukan" class="btn btn-sm btn-success">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- edit pemasukan -->

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
            <a href="#modalTambahPemasukan" data-toggle="modal" class="modal-tambah-pemasukan btn btn-success btn-block btn-sm mb-3"><div class="i fa fa-plus mr-1"></div>tambah pemasukan</a>
        </div>
    </div>
    <div class="row">
        <?php if(COUNT($pemasukan) != 0):?>
            <?php foreach ($pemasukan as $pemasukan) :?>
                <div class="col-12 col-md-4 mb-2">
                    <ul class="list-group shadow">
                        <li class="list-group-item list-group-item-info d-flex justify-content-between"><?= rupiah($pemasukan['nominal'])?> 
                            <span>
                                <a href="<?= base_url()?>admin/delete_pemasukan/<?= $pemasukan['id_pemasukan']?>" onclick="return confirm('Yakin akan menghapus pemasukan?')" class="btn btn-outline-danger btn-sm mr-1">hapus</a>
                                <a href="#modalEditPemasukan" data-toggle="modal" data-id="<?= $pemasukan['id_pemasukan']?>" class="modal-edit-pemasukan btn btn-outline-success btn-sm">edit</a>
                            </span>
                        </li>
                        <li class="list-group-item"><?= date('d-M-Y', strtotime($pemasukan['tgl_pemasukan']))?></li>
                        <li class="list-group-item"><?= $pemasukan['pelaku']?></li>
                        <li class="list-group-item"><?= $pemasukan['keterangan']?></li>
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
    $("#pemasukan").addClass("active");
    $(".modal-edit-pemasukan").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>admin/get_pemasukan_by_id",
            data: {id: id},
            dataType: "json",
            method: "POST",
            async: true,
            success: function(data){
                $("#id_pemasukan").val(data.id_pemasukan);
                $("#tgl_pemasukan").val(data.tgl_pemasukan);
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


