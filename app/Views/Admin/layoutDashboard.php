<?= $this->extend('layout'); ?>
<?= $this->section('style'); ?>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .form-check-input {
        display: inline-block;
        width: 80px !important;
        margin-right: 5px;
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
        z-index: 1500;
    }

    #data_table_filter {
        float: right;
        display: block;
    }

    #data_table_wrapper>div:nth-child(2) {
        margin-top: 20px !important;
    }
</style>
<link href="<?= base_url() ?>/dashboard.css" rel="stylesheet">
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<?= $this->include('components/toggle'); ?>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 fw-bolder" href="<?= base_url('admin/dashboard') ?>">Hungry Guys</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <input class="form-control form-control-light w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search"> -->
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="<?= base_url('admin/logout') ?>">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block navbar-dark bg-dark  sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= base_url('admin/dashboard') ?>">
                            <span data-feather="home" class="align-text-bottom"></span>
                            Dashboard
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/categories') ?>">
                            <span data-feather="file" class="align-text-bottom"></span>
                            Categories
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('voucher') ?>">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            Voucher
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/transaction') ?>">
                            <span data-feather="users" class="align-text-bottom"></span>
                            Transaction
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="row justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <div class="col-lg-6 mt-2">
                    <h6><?= $page; ?></h6>
                </div>
                <div class="col-lg-6" <?= $page == "Transaction" ? "hidden" : ""; ?>>
                    <button type="button" class="btn btn-danger btn-sm border" onclick="save()" title="New Category" style="float: right;"><i class="fa fa-plus"></i> New Data <?= ucfirst($controller); ?></button>
                </div>

            </div>
            <?= $this->renderSection('dashboard'); ?>
        </main>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>

<script>
    // dataTables
    $(function() {
        var table = $('#data_table').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "scrollCollapse": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url($controller . "/getall") ?>',
                "type": "POST",
                "dataType": "json",
                "async": "true"
            }
        });
    });



    var urlController = '';
    var submitText = '';


    function getUrl() {
        return urlController;
    }

    function getSubmitText() {
        return submitText;
    }

    function remove(params) {
        Swal.fire({
            title: "<?= lang("App.remove-title") ?>",
            text: "<?= lang("App.remove-text") ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang("App.confirm") ?>',
            cancelButtonText: '<?= lang("App.cancel") ?>'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url($controller . "/remove") ?>',
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
<?= $this->renderSection('dashboardScript'); ?>
<?= $this->endSection(); ?>