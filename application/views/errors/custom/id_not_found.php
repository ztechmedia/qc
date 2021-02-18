<!-- START BREADCRUMB -->
<ul class="breadcrumb push-down-0">
    <li><a class="link-to" data-to="<?=base_url("/dashboard")?>">Beranda</a></li>
    <li class="active">Error 404</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <div class="error-container">
                <div class="error-code">404</div>
                <div class="error-text"><?=$message?></div>
                <div class="error-subtext">Sayang sekali source yang anda tuju tidak ditemukan dalam database.</div>
                <div class="error-actions">
                    <div class="row">
                        <div class="col-md-12 center">
                            <button class="btn btn-warning btn-block link-to btn-rounded"
                                    data-to="<?=base_url("/dashboard")?>">Kembali ke Beranda</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

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