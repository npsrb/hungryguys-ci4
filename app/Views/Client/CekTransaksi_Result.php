<?= $this->extend("Client/clientLayout") ?>
<?= $this->section('clientContent'); ?>
<style>
    input:focus {
        border-color: red;
    }
</style>

<table class="table table-bordered table-striped mt-3 border-danger">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Email</th>
            <th>Amout</th>
            <th>Status</th>
        </tr>
        <tr>
            <td><?= $result->id_transaction; ?></td>
            <td><?= $result->email; ?></td>
            <td><?= $result->amount; ?></td>
            <td><?= $result->status; ?></td>
        </tr>
    </thead>
</table>
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