<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<style>
    input:focus {
        border-color: red;
    }
</style>
<div class=" rounded mt-4 mx-auto">
    <form id="data-form" method="post" class="pl-3 pr-3" enctype="multipart/form-data" action="<?= base_url('payment/cekStatus') ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="desc" class="col-form-label"> Transaction ID: <small class="text-danger">*</small> </label>
                    <input type="text" name="id" class="form-control" placeholder="Transaction ID" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-md btn-block mt-3" id="back-btn">Cancel This</button>
        <button type="submit" class="btn btn-primary btn-md btn-block mt-3" id="checkout">Check Transaction</button>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        $('#back-btn').click(function() {
            window.location.href = '<?= base_url() ?>';
        });

    });
</script>

<?= $this->endSection(); ?>