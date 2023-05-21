<?= $this->extend("Admin/layoutDashboard") ?>

<?= $this->section("dashboard") ?>

<div class="card-body">
    <table id="data_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Email</th>
                <th>Server ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Category</th>
                <th>Option</th>
            </tr>
        </thead>
    </table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('dashboardScript'); ?>
<script>
    function approve(params) {
        Swal.fire({
            title: "Approve this transaction",
            text: "This action can't be undo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang("App.confirm") ?>',
            cancelButtonText: '<?= lang("App.cancel") ?>'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url($controller . "/approve") ?>',
                    type: 'post',
                    data: {
                        params: params
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            })
                        } else {
                            Swal.fire({
                                toast: false,
                                position: 'bottom-end',
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    }
                });
            }
        })
    }

    function reject(params) {
        Swal.fire({
            title: "Reject this transaction",
            text: "This action can't be undo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang("App.confirm") ?>',
            cancelButtonText: '<?= lang("App.cancel") ?>'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url($controller . "/reject") ?>',
                    type: 'post',
                    data: {
                        params: params
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            })
                        } else {
                            Swal.fire({
                                toast: false,
                                position: 'bottom-end',
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        }
                    }
                });
            }
        })
    }
</script>
<?= $this->endSection(); ?>