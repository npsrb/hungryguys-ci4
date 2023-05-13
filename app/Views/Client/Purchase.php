<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<style>
    input:focus {
        border-color: red;
    }
</style>
<div class=" rounded mt-4 mx-auto ">
    <div class="col-lg-6 col-lg-12 text-center">
        <img class="mb-3" src="<?= base_url('/uploads/' . $category->picture) ?>">
        <h2 class="fw-bold"><?= $category->category; ?></p>
    </div>
    <div class="">
        <label for="">Pick Voucher: </label>
        <div class="row mb-3">
            <?php foreach ($voucer as $a) : ?>
                <div class="col-lg-3 text-center mt-2">
                    <div class="card">
                        <div id="myCard" class="mycards card-body" data-customData="<?= $a->amount ?>">
                            Rp. <?= number_format($a->amount); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <form id="data-form" class="pl-3 pr-3" enctype="multipart/form-data">
            <div class="row">
                <input type="number" id="amount" hidden>
                <div class="col-md-12" <?= $category->option_server == 1 ? "" : "hidden" ?>>
                    <div class="form-group mb-3">
                        <label for="category" class="col-form-label"> Server: <span class="text-danger">*</span> </label>
                        <input type="text" id="server_id" name="server_id" class="form-control" placeholder="Server" minlength="0" maxlength="36" required>
                    </div>
                </div>
                <div class="col-md-12" <?= $category->option_user_id == 1 ? "" : "hidden" ?>>
                    <div class="form-group mb-3">
                        <label for="desc" class="col-form-label"> User ID: <span class="text-danger">*</span> </label>
                        <input type="text" id="user_id" name="user_id" class="form-control" placeholder="User ID" minlength="0" maxlength="100" required>
                    </div>
                </div>
                <div class="col-md-12" <?= $category->option_username == 1 ? "" : "hidden" ?>>
                    <div class="form-group mb-3">
                        <label for="desc" class="col-form-label"> Game Username: <span class="text-danger">*</span> </label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" minlength="0" maxlength="100" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="desc" class="col-form-label"> Email: <small class="text-danger">Notification will be sent here*</small> </label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Email" minlength="0" maxlength="100" required>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-md btn-block mt-3" id="back-btn">Cancel This</button>
            <button type="button" class="btn btn-primary btn-md btn-block mt-3" id="">Checkout</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        var customData = 0;
        $('.mycards').click(function() {
            if ($(".mycards").hasClass('bg-danger text-white')) {
                $(".mycards").removeClass('bg-danger text-white');
                customData = 0;
            }
            $(this).addClass('bg-danger text-white');
            customData = $(this)[0].getAttribute('data-customData');
            $("#amount").val(customData);

        });
        $('#back-btn').click(function() {
            window.location.href = '<?= base_url() ?>';
        });
    });
</script>
<?= $this->endSection(); ?>