<!-- Modal -->
<div class="modal fade" id="dataAlumni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dataAlumniLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        <ul class="list-group" id="list-alumni"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between">Alumni <span><a href="#dataAlumni" data-toggle="modal" class="badge badge-danger alumni"><?= COUNT($alumni)?></a></span></li>
            <li class="list-group-item d-flex justify-content-between">Sudah Input <span><a href="#dataAlumni" data-toggle="modal" class="badge badge-danger alumni-input"><?= COUNT($sudah_input)?></a></span></li>
          <li class="list-group-item d-flex justify-content-between">Belum Input <span><a href="#dataAlumni" data-toggle="modal" class="badge badge-danger alumni-belum-input"><?= COUNT($belum_input)?></a></span></li>
        </ul>
      </div>
    </div>
</div>

<script>
  $(".alumni").click(function(){
    $.ajax({
      url: "<?= base_url()?>admin/get_all_alumni",
      data: {id: '10'},
      dataType: "json",
      async: true,
      method: "POST",
      success: function(data){
        $("#dataAlumniLabel").html("List Alumni")
        let html = "";
        let urut = 1;
        for (let i = 0; i < data.length; i++) {
          html += `<li class="list-group-item">`+urut+`. `+data[i].nama+`</li>`;

          urut++;
        }

        $("#list-alumni").html(html);
      }
    })
  })
  
  $(".alumni-input").click(function(){
    $.ajax({
      url: "<?= base_url()?>admin/get_alumni_sudah_input",
      data: {id: '10'},
      dataType: "json",
      async: true,
      method: "POST",
      success: function(data){
        $("#dataAlumniLabel").html("List Alumni Sudah Input")
        let html = "";
        let urut = 1;
        for (let i = 0; i < data.length; i++) {
          html += `<li class="list-group-item">`+urut+`. `+data[i].nama+`</li>`;

          urut++;
        }

        $("#list-alumni").html(html);
      }
    })
  })
  
  
  $(".alumni-belum-input").click(function(){
    $.ajax({
      url: "<?= base_url()?>admin/get_alumni_belum_input",
      data: {id: '10'},
      dataType: "json",
      async: true,
      method: "POST",
      success: function(data){
        $("#dataAlumniLabel").html("List Alumni Belum Input")
        let html = "";
        let urut = 1;
        for (let i = 0; i < data.length; i++) {
          html += `<li class="list-group-item">`+urut+`. `+data[i].nama+`</li>`;

          urut++;
        }

        $("#list-alumni").html(html);
      }
    })
  })


</script>


