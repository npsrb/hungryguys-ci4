<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<div class="row mt-4 justify-content-center text-center">
    <?php foreach ($categories as $a) : ?>
        <div class="col-md-4 mt-4">
            <div class="card">
                <img class="card-img-top" src="<?= base_url('/uploads/' . $a->picture) ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $a->category; ?></h5>
                    <p class="card-text"><?= $a->desc; ?></p>
                    <form method="post" action="<?= base_url('client/setSession') ?>">
                        <input type="hidden" name="id" value="<?= $a->id_category ?>">
                        <button type="submit" class="btn btn-danger"> <i class="fas fa-shopping-cart"></i> Select Game</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<?= $this->endSection(); ?>