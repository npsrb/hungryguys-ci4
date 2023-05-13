<?= $this->extend("Admin/layoutDashboard") ?>

<?= $this->section("dashboard") ?>

<div class="card">
  <div class="card-body">
    <table id="data_table" class="table">
      <thead>
        <tr>
          <th>Amount</th>
          <th>Category</th>
          <th>Status</th>
          <th>Desc</th>
          <th>Option</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md rounded">
    <div class="modal-content">
      <div class="text-center bg-info p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <div class="row">
            <input type="hidden" id="id_voucher" name="id_voucher" class="form-control" placeholder="Id voucher" maxlength="11" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="amount" class="col-form-label"> Amount IDR: <span class="text-danger">*</span> </label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" minlength="0" maxlength="11" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="category" class="col-form-label"> Category: <span class="text-danger">*</span> </label>
                <select type="number" id="category" name="category" class="form-control" placeholder="Category" minlength="0" maxlength="36" required>
                  <option value="">select game category</option>
                  <?php foreach ($category as $a) : ?>
                    <option value="<?= $a->id_category ?>"><?= $a->category; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="deskripsi" class="col-form-label"> Deskripsi: <span class="text-danger">*</span> </label>
                <input type="text" id="deskripsi" name="deskripsi" class="form-control" placeholder="Deskripsi" minlength="0" maxlength="100" required>
              </div>
            </div>
            <div class="col-md-12" id="onoff" hidden>
              <div class="form-check form-switch">
                <input class="form-check-input d-block" type="checkbox" id="status" name="status">
                <label class="form-check-label" for="status">ON/OFF</label>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-danger rounded" id="form-btn"><?= lang("App.save") ?></button>
              <button type="button" class="btn btn-warning rounded" data-bs-dismiss="modal" style="margin-left:5px"><?= lang("App.cancel") ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('dashboardScript'); ?>
<script>
  function save(id_voucher) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof id_voucher === 'undefined' || id_voucher < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-info').addClass('bg-primary');
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');
    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          id_voucher: id_voucher
        },
        dataType: 'json',
        success: function(response) {

          $('#model-header').removeClass('bg-success').addClass('bg-danger');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #id_voucher").val(response.id_voucher);
          $("#data-form #amount").val(response.amount);
          $("#data-form #category").val(response.category);
          $("#data-form #deskripsi").val(response.deskripsi);
          $("#data-form #onoff").attr("hidden", false);
          response.status == '1' ? $("#data-form #status").attr("checked", true) : $("#data-form #status").attr("checked", false);
        }
      });
    }
    $.validator.setDefaults({
      highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
      },
      unhighlight: function(element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
      },
      errorElement: 'div ',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else if ($(element).is('.select')) {
          element.next().after(error);
        } else if (element.hasClass('select2')) {
          //error.insertAfter(element);
          error.insertAfter(element.next());
        } else if (element.hasClass('selectpicker')) {
          error.insertAfter(element.next());
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {

        var form = $('#data-form');
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
          url: getUrl(),
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {
            $('#form-btn').html('.....');
            $("#form-btn").attr("disabled", true);
          },
          success: function(response) {
            if (response.success === true) {
              Swal.fire({
                toast: true,
                position: 'center',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                $('#data-modal').modal('hide');
                $("#form-btn").attr("disabled", false);
              })
            } else {
              Swal.fire({
                toast: false,
                position: 'center',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 3000
              })
              $("#form-btn").attr("disabled", false);
            }
            $('#form-btn').html(getSubmitText());
          }
        });
        return false;
      }
    });

    $('#data-form').validate({

      //insert data-form to database

    });
  }
</script>
<?= $this->endSection(); ?>