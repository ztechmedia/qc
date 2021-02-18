<li class="xn-profile">
    <a class="profile-mini">
        <img src="<?= base_url("assets/joli/img/wira.png") ?>" alt="User" />
    </a>
    <div class="profile">
        <div class="profile-image" style="border: none;">
            <img src="<?= base_url("assets/joli/img/wira.png") ?>" alt="Logo" />
        </div>
        <div class="profile-data">
            <div class="profile-data-name"><?= $this->auth->name ?></div>
            <div class="profile-data-title">Otoritas: <b><?= $this->auth->role ?></b></div>
            <div class="profile-data-title">Ip Address: <b><?=$ip?></b></div>
            <div class="profile-data-title">OS: <b><?=$os?></b></div>
            <div class="profile-data-title">Browser: <b><?=$browser." ".$browser_version?></b></div>
            <div class="profile-data-title">Efektif Program: <b>07 Februari 2021</b></div>
        </div>
    </div>
</li>