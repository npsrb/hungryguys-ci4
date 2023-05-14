<?= $this->extend("Admin/layoutDashboard") ?>

<?= $this->section("dashboard") ?>
<div class="card-body">
    <table id="data_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id_transactio</th>
                <th>email</th>
                <th>server_id</th>
                <th>user_id</th>
                <th>username</th>
                <th>amount</th>
                <th>status</th>
                <th>category</th>
            </tr>
        </thead>
    </table>
</div>
<?= $this->endSection(); ?>