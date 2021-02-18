<!DOCTYPE html>
<html lang="en" class="body-full-height">

<head>
    <!-- META SECTION -->
    <title>Admin Panel - Quality Dept 2021</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?= base_url("assets/joli/img/wira.png") ?>" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?= base_url('assets/joli/css/theme-white.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom/css/style.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>
    <?php $this->load->view($view) ?>
    <script type="text/javascript" src="<?= base_url("assets/joli/js/jquery/jquery.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/sweetalert/sweetalert.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/joli/js/bootstrap/bootstrap-datepicker.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/joli/js/maskedinput/jquery.maskedinput.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/validation/forms.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/ajax/ajaxRequest.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/actions/errorHandler.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/actions/formActions.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/ajax/ajaxRequest.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/custom/js/actions/authActions.js") ?>"></script>
</body>

<style>
    .custom-logo {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .login-container.lightmode .login-box .login-body {
        background: rgba(0, 0, 0, 0.3) !important;
    }
</style>

</html>