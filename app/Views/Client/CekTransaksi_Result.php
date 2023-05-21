<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<style>
    input:focus {
        border-color: red;
    }
</style>

<card class="card bg-danger text-white">
    <div class="card-header bg-black">
        Transaction Status
    </div>
    <div class="card-body">
        <p>Transaction ID: <?= $result->id_transaction; ?></p>
        <p>Email: <?= $result->email; ?></p>
        <p>Amount: Rp.<?= number_format($result->amount); ?></p>
        <p>Status: <?= $result->status; ?></p>
    </div>
</card>
<button type="button" class="btn btn-danger btn-md btn-block mt-3" id="back-btn">Back</button>
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