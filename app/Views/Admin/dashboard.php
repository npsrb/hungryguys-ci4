<?= $this->extend("Admin/layoutDashboard") ?>
<?= $this->section('style'); ?>
<style>
    .icon-shape {
        display: inline-flex;
        padding: 12px;
        text-align: center;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
    }

    .icon {
        width: 3rem;
        height: 3rem;
    }

    .icon i {
        font-size: 2.25rem;
    }

    figcaption,
    main {
        display: block;
    }

    main {
        overflow: hidden;
    }

    .bg-yellow {
        background-color: #ffd600 !important;
    }

    h2,
    h5,
    .h2,
    .h5 {
        font-family: inherit;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: .5rem;
        color: #32325d;
    }

    h5,
    .h5 {
        font-size: .8125rem;
    }

    @media (min-width: 992px) {

        .col-lg-6 {
            max-width: 50%;
            flex: 0 0 50%;
        }
    }

    @media (min-width: 1200px) {

        .col-xl-3 {
            max-width: 25%;
            flex: 0 0 25%;
        }

        .col-xl-6 {
            max-width: 50%;
            flex: 0 0 50%;
        }
    }


    .bg-danger {
        background-color: #f5365c !important;
    }



    @media (min-width: 1200px) {

        .justify-content-xl-between {
            justify-content: space-between !important;
        }
    }


    .pt-5 {
        padding-top: 3rem !important;
    }

    .pb-8 {
        padding-bottom: 8rem !important;
    }

    @media (min-width: 768px) {

        .pt-md-8 {
            padding-top: 8rem !important;
        }
    }

    @media (min-width: 1200px) {

        .mb-xl-0 {
            margin-bottom: 0 !important;
        }
    }




    .font-weight-bold {
        font-weight: 600 !important;
    }


    a.text-success:hover,
    a.text-success:focus {
        color: #24a46d !important;
    }

    .text-warning {
        color: #fb6340 !important;
    }

    a.text-warning:hover,
    a.text-warning:focus {
        color: #fa3a0e !important;
    }

    .text-danger {
        color: #f5365c !important;
    }

    a.text-danger:hover,
    a.text-danger:focus {
        color: #ec0c38 !important;
    }

    .text-white {
        color: #fff !important;
    }

    a.text-white:hover,
    a.text-white:focus {
        color: #e6e6e6 !important;
    }

    .text-muted {
        color: #8898aa !important;
    }
</style>
<?= $this->endSection(); ?>
<?= $this->section("dashboard") ?>
<div class="main-content">
    <div class="text-center">
        <img src="https://www.freeiconspng.com/thumbs/gaming-logo/gamer-logo-png-gaming-video-man-character-2.png" alt="">
    </div>
    <div class="header bg-gradient-primary">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row">
                    <div class="col">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Transaksi</h5>
                                        <span class="h2 font-weight-bold text-warning mb-0"><?= $transaksitot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-nowrap">Total Transaksi</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Product</h5>
                                        <span class="h2 font-weight-bold text-warning mb-0"><?= $producttot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-nowrap">Total Product</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Category</h5>
                                        <span class="h2 font-weight-bold text-warning mb-0"><?= $categorytot; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-nowrap">Category Total</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Game Categories
                </div>
                <div class="card-body">
                    <table id="data_table" class="table ">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Server</th>
                                <th>Desc</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md rounded">
        <div class="modal-content">
            <div class="text-center bg-info p-3" id="model-header">
                <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
            </div>
            <div class="modal-body">
                <form id="data-form" class="pl-3 pr-3" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" id="id_category" name="id_category" class="form-control" placeholder="Id categories" maxlength="36" required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="category" class="col-form-label">Game Category: <span class="text-danger">*</span> </label>
                                <input type="text" id="category" name="category" class="form-control" placeholder="Game Category" minlength="0" maxlength="36" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="desc" class="col-form-label"> Description: <span class="text-danger">*</span> </label>
                                <input type="text" id="desc" name="desc" class="form-control" placeholder="Description" minlength="0" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-md-12" id="thumbnail">
                            <div class="form-group mb-3">
                                <label for="desc" class="col-form-label"> Thumbnail: <span class="text-danger">*</span> </label>
                                <input type="file" id="picture" name="picture" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="border-bottom fw-bold mb-3">Feature ON/OFF</p>
                            <div class="form-group mb-3 col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="option_user_id" name="option_user_id">
                                    <label class="form-check-label" for="option_user_id">User ID</label>
                                </div>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="option_server" name="option_server">
                                    <label class="form-check-label" for="option_server">Server</label>
                                </div>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="option_username" id="option_username">
                                    <label class=" form-check-label" for="option_username">Username</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center mt-2">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-danger rounded" id="form-btn"><?= lang("App.save") ?></button>
                            <button type="button" class="btn btn-warning rounded" data-bs-dismiss="modal" style="margin-left:5px"><?= lang("App.cancel") ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>


<?= $this->section('dashboardScript'); ?>
<script>
    function save(id_category) {
        $("#data-form")[0].reset();
        $(".form-control").removeClass('is-invalid').removeClass('is-valid');
        if (typeof id_category === 'undefined' || id_category < 1) { //add
            urlController = '<?= base_url($controller . "/add") ?>';
            submitText = '<?= lang("App.save") ?>';
            $('#model-header').removeClass('bg-info').addClass('bg-primary');
            $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
            $("#form-btn").text(submitText);
            $('#data-modal').modal('show');
        } else { //edit
            $("#data-form #thumbnail").attr('hidden', true);
            urlController = '<?= base_url($controller . "/edit") ?>';
            submitText = '<?= lang("App.update") ?>';
            $.ajax({
                url: '<?php echo base_url($controller . "/getOne") ?>',
                type: 'post',
                data: {
                    id_category: id_category
                },
                dataType: 'json',
                success: function(response) {
                    $('#model-header').removeClass('bg-success').addClass('bg-danger');
                    $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
                    $("#form-btn").text(submitText);
                    $('#data-modal').modal('show');
                    //insert data to form
                    $("#data-form #id_category").val(response.id_category);
                    $("#data-form #category").val(response.category);
                    $("#data-form #desc").val(response.desc);
                    response.option_user_id == '1' ? $("#data-form #option_user_id").attr("checked", true) : $("#data-form #option_user_id").attr("checked", false);
                    response.option_server == '1' ? $("#data-form #option_server").attr("checked", true) : $("#data-form #option_server").attr("checked", false);
                    response.option_username == '1' ? $("#data-form #option_username").attr("checked", true) : $("#data-form #option_username").attr("checked", false);
                }
            });
        }
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            errorElement: 'div ',
            errorClass: 'invalid-feedback',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if ($(element).is('.select')) {
                    element.next().after(error);
                } else if (element.hasClass('select2')) {
                    //error.insertAfter(element);
                    error.insertAfter(element.next());
                } else if (element.hasClass('selectpicker')) {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                var form = $('#data-form')[0];
                var formData = new FormData(form);
                $(".text-danger").remove();
                $.ajax({
                    // fixBug get url from global function only
                    // get global variable is bug!
                    url: getUrl(),
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#form-btn').html('.....');
                        $("#form-btn").attr("disabled", true);
                    },
                    success: function(response) {
                        if (response.success === true) {
                            Swal.fire({
                                toast: true,
                                position: 'center',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                                $('#data-modal').modal('hide');
                                $("#form-btn").attr("disabled", false);
                            })
                        } else {
                            Swal.fire({
                                toast: false,
                                position: 'center',
                                icon: 'error',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            $("#form-btn").attr("disabled", false);
                        }
                        $('#form-btn').html(getSubmitText());
                    }
                });
                return false;
            }
        });

        $('#data-form').validate({
            //insert data-form to database
        });
    }
</script>
<?= $this->endSection(); ?>