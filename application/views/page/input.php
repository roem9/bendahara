<div class="container">
    <?php if( $this->session->flashdata('pesan') ) : ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <?= $this->session->flashdata('pesan');?>
                </div>
        </div>
    <?php endif; ?>
    <div class="row" id="information">
      <div class="col-12 col-md-6">
        <div class="alert alert-info"><i class="fa fa-info-circle text-info"></i> Masukkan NIS Anda yang didapatkan dari ketua angkatan masing-masing</div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="input-group mb-3">
          <input type="text" class="form-control form-control-sm" placeholder="Input NIK" name="nik" id="cek-nik">
          <div class="input-group-append">
            <button class="btn btn-sm btn-primary" type="button" id="btn-cek-nik">Cek NIK</button>
          </div>
        </div>
        <form action="home/edit_alumni" method="post">
          <ul class="list-group" id="form-1">
            <li class="list-group-item list-group-item-info"><i class="fa fa-user mr-3"></i> Data Pribadi</li>
            <li class="list-group-item">
              <div class="form-group">
                <input type="hidden" name="nik" id="nik" class="form-control form-control-sm form-1">
              </div>
              <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control form-control-sm form-1" readonly>
              </div>
              <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="text" name="angkatan" id="angkatan" class="form-control form-control-sm form-1" readonly>
              </div>
              <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control form-control-sm form-1">
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Pria">Ikhwan</option>
                  <option value="Wanita">Akhwat</option>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <small id="passwordHelpInline" class="text-muted">
                  ex : fulan22@gmail.com
                </small>
                <input type="email" name="email" id="email" class="form-control form-control-sm form-1">
              </div>
              <div class="form-group">
                <label for="no">No. Handphone</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control form-control-sm form-1">
              </div>
              <div class="form-group">
                <label for="alamat_ktp">Alamat (Sesuai KTP)</label>
                <textarea name="alamat_ktp" id="alamat_ktp" class="form-control form-control-sm form-1" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="alamat_domisil">Alamat Domisili</label>
                <textarea name="alamat_domisili" id="alamat_domisili" class="form-control form-control-sm form-1" rows="5"></textarea>
              </div>
              <div class="form-group">
                <label for="no_hp_wali">No. Handphone Wali</label>
                <input type="text" name="no_hp_wali" id="no_hp_wali" class="form-control form-control-sm form-1">
              </div>
              <div class="form-group">
                <label for="wali">Posisi Wali di Keluarga</label>
                <input type="text" name="wali" id="wali" class="form-control form-control-sm form-1">
              </div>
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-success" id="next-1"><i class="fa fa-arrow-right"></i> Kesibukan</button>
              </div>
            </li>
          </ul>

          <ul class="list-group" id="form-2">
            <li class="list-group-item list-group-item-info"><i class="fa fa-user-tie"></i> Kesibukan</li>
            <li class="list-group-item">
              <div class="form-group">
                  <label for="kesibukan">Kesibukan</label>
                  <select name="kesibukan" id="kesibukan" data-form="Kesibukan" class="form-control form-control-sm" required>
                      <option value="">Pilih Kesibukan</option>
                      <option value="Kuliah">Kuliah</option>
                      <option value="Bekerja">Bekerja</option>
                      <option value="Kuliah & Bekerja">Kuliah & Bekerja</option>
                      <option value="Lainnya">Lainnya</option>
                  </select>
              </div>
                <!-- kesibukan kuliah -->
                <div id="kuliah">
                  <div class="form-group">
                      <label for="universitas">Universitas</label>
                      <input type="text" class="form-control form-control-sm kuliah" name="universitas" id="universitas" required>
                  </div>
                  <div class="form-group">
                      <label for="jurusan">Jurusan</label>
                      <input type="text" class="form-control form-control-sm kuliah" name="jurusan" id="jurusan" required>
                  </div>
                  <div class="form-group">
                      <label for="jenjang">Jenjang</label>
                      <select name="jenjang" id="jenjang" class="form-control form-control-sm kuliah" required>
                          <option value="">Pilih Jenjang</option>
                          <option value="DI">DI</option>
                          <option value="DII">DII</option>
                          <option value="DIII">DIII</option>
                          <option value="DIV">DIV</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                      </select>
                  </div>
              </div>

              <!-- kesibukan bekerja -->
              <div class="form-group" id="bekerja">
                  <label for="perusahaan">Nama Perusahaan</label>
                  <input type="text" class="form-control form-control-sm bekerja" name="perusahaan" id="perusahaan" required>
              </div>

              <!-- kesibukan lainnya -->
              <div class="form-group" id="lainnya">
                  <label for="pekerjaan_lainnya">Kesibukan Lainnya</label>
                  <input type="text" class="form-control form-control-sm lainnya" name="pekerjaan_lainnya" id="pekerjaan_lainnya" required>
              </div>
              
              <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-sm btn-success" id="prev-2"><i class="fa fa-arrow-left"></i> Data Diri</button>
                  <input type="submit" class="btn btn-sm btn-primary" value="Simpan Data Alumni" id="submit-form">
              </div>
            </li>
          </ul>
        </form>
      </div>
    </div>
</div>

<script>

  setInputFilter(document.getElementById("no_hp"), function(value) {
      return /^[0-9]*$/i.test(value);
  });

  setInputFilter(document.getElementById("no_hp_wali"), function(value) {
      return /^[0-9]*$/i.test(value);
  });

  $("#form-1").hide()
  $("#form-2").hide()
  
  $("#next-1").click(function(){
      let empty = false;
      let html = "";
      $.each($('.form-1'),function() {
          if ($(this).val().length == 0) {
              empty = true;
          }
      })
      
      if(empty == true){
          Swal.fire({
              icon: 'error',
              html: 'Harap mengisi seluruh form'
          })
          return false;
      } else {
          $("#form-1").hide();
          $("#form-2").show();
      }
  })
        
  $("#prev-2").click(function(){
      $("#form-1").show();
      $("#form-2").hide();
  })

  $("#kuliah").hide()
  $("#bekerja").hide()
  $("#lainnya").hide()
  
  $("#kesibukan").change(function(){
      $("#kuliah").hide();
      $("#bekerja").hide();
      $("#lainnya").hide();
      $("#universitas").val("");
      $("#jurusan").val("");
      $("#jenjang").val("");
      $("#perusahaan").val("");
      $("#pekerjaan_lainnya").val("");

      let kesibukan = $(this).val();
      
      if(kesibukan == "Kuliah"){
          $("#kuliah").show();
      } else if(kesibukan == "Bekerja"){
          $("#bekerja").show();
      } else if(kesibukan == "Kuliah & Bekerja"){
          $("#kuliah").show();
          $("#bekerja").show();
      } else if(kesibukan == "Lainnya"){
          $("#lainnya").show()
      }
  })

  $("#btn-cek-nik").click(function(){
      $("#nama").val("")
      $("#angkatan").val("")
      $("#nik").val("")

      let id = $("#cek-nik").val();
      $.ajax({
          url : "<?=base_url()?>home/get_data_alumni",
          method : "POST",
          data : {id : id},
          async : true,
          dataType : 'json',
          success : function(data){
              if(data){
                  $("#information").hide()
                  $("#form-1").show()
                  $("#gagal").html("");
                  $("#nama").val(data.nama);
                  $("#angkatan").val(data.angkatan);
                  $("#nik").val(data.nik);
              } else {
                  $("#information").html(`
                    <div class="col-12 col-md-6">
                      <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning"></i> Maaf NIS Anda tidak terdaftar, silahkan hubungi ketua angkatan Anda</div>
                    </div>`
                  )
              }
          }
      })
  })
</script>



