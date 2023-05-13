<?= $this->extend('layout'); ?>
<?= $this->section('style'); ?>
<style>
    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    img {
        max-width: 100%;
        max-height: 100%;
    }

    .shop:hover {
        background-color: #DC3545;
        color: white;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<?= $this->include('components/flashMessage'); ?>

<body>
    <div class="container p-4 border border-danger rounded" style="border-width: 5px !important;">
        <header class="text-center mb-2 bg-danger rounded">
            <h1 class="fw-bold text-white">Hungry Guys Store</h1>
        </header>

        <?= $this->include("components/toggle"); ?>
        <?= $this->renderSection('clientContent'); ?>
    </div>
</body>

<?= $this->endSection(); ?>