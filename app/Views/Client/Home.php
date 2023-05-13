<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<style>
    .card:hover {
        border: 3px solid #FD2549;
        transform: translateY(-10px);
    }
</style>
<div class="row mt-4 justify-content-center text-center ">
    <?php foreach ($categories as $a) : ?>
        <div class="col-xl-4 mt-4">
            <div class="card border-danger text-danger">
                <img class="card-img-top" src="<?= base_url('/uploads/' . $a->picture) ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title mb-3"><?= $a->category; ?></h5>
                    <button type="submit" class="shop btn btn-sm border-danger rounded" id="buyme" data-custom="<?= $a->id_category ?>"> Select Game</button>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(window).ready(function() {
        $(".shop").click(function(e) {
            e.preventDefault();
            var id = this.getAttribute("data-custom");
            var timerInterval;
            Swal.fire({
                title: 'Finding Voucher',
                html: 'We will find voucher for you',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                $.ajax({
                    url: '<?= base_url('client/setSession') ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('.shop').attr("disabled", true);
                    },
                    success: function(response) {
                        if (response.success === true) {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                Swal.fire({
                                    toast: true,
                                    position: 'center',
                                    icon: 'success',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    $("#buyme").attr("disabled", false);
                                    window.location = "<?= base_url('client/selection') ?>";
                                })
                            }
                        } else {
                            if (result.dismiss === Swal.DismissReason.timer) {
                                Swal.fire({
                                    toast: false,
                                    position: 'center',
                                    icon: 'error',
                                    title: response.messages,
                                    showConfirmButton: false,
                                    timer: 3000
                                })
                            }
                        }
                        $(".shop").attr("disabled", false);
                    }
                });
            })
        });
    });
</script>
<?= $this->endSection(); ?>