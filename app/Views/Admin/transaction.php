<?= $this->extend("Admin/layoutDashboard") ?>

<?= $this->section("dashboard") ?>
<div class="card-body">
    <table id="data_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Option</th>
            </tr>
        </thead>
    </table>
</div>
<?= $this->endSection(); ?>