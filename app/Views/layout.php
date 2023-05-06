<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <script src="https://getbootstrap.com/docs/5.3/assets/js/color-modes.js"></script>
    <meta name="theme-color" content="#fffff">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <meta name="theme-color" content="#712cf9">
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">
    <?= $this->renderSection('style'); ?>
    <title><?= $title; ?></title>

</head>

<body>

    <?= $this->renderSection('content'); ?>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- required script auto CRUD -->
    <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap4-toggle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/dataTables.buttons.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/JSZip-2.5.0/jszip.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.print.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Buttons-2.0.1/js/buttons.html5.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("assets/plugins/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js"); ?>" type="text/javascript"></script>
    <!-- end required script -->
    <?= $this->renderSection('script'); ?>
    <script>
        feather.replace()
    </script>

</body>

</html>