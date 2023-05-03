<?= $this->extend("Admin/layoutDashboard") ?>

<?= $this->section("dashboard") ?>
<div class="card">
  <div class="card-body">
    <table id="data_table" class="table ">
      <thead>
        <tr>
          <th>Amount</th>
          <th>Category</th>
          <th>Stock</th>
          <th>Desc</th>
          <th>Option</th>
        </tr>
      </thead>
    </table>
  </div>
</div>


<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="text-center bg-info p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <div class="row">
            <input type="hidden" id="id_category" name="id_category" class="form-control" placeholder="Id categories" maxlength="36" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="category" class="col-form-label"> Category: <span class="text-danger">*</span> </label>
                <input type="text" id="category" name="category" class="form-control" placeholder="Category" minlength="0" maxlength="36" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="desc" class="col-form-label"> Description: <span class="text-danger">*</span> </label>
                <input type="text" id="desc" name="desc" class="form-control" placeholder="Description" minlength="0" maxlength="100" required>
              </div>
            </div>
          </div>
          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="form-btn"><?= lang("App.save") ?></button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>