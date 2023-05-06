<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>

<h1><?= session()->test; ?></h1>
<?= $this->endSection(); ?>