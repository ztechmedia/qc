<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>Joli Admin - Responsive Bootstrap Admin Template</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?= base_url('assets/joli/css/theme-white.css') ?>" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>
    <div class="error-container">
        <div class="error-code">404</div>
        <div class="error-text"><?= isset($message) ? "Source Not Found" :  "Page Not Found" ?></div>
        <div class="error-subtext"><?= isset($message) ? $message : "Sayang sekali halaman yang anda tuju tidak ditemukan" ?></div>
        <div class="error-actions">
            <div class="row">
                <div class="col-md-12 center">
                    <button onclick="location.href='<?= base_url('/') ?>'" class="btn btn-warning btn-block btn-rounded">Kembali ke Beranda</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    .center {
        display: flex;
        flex-direction: flex-start;
        justify-content: center;
        align-items: center;
    }

    .center button {
        width: 30%;
    }
</style>