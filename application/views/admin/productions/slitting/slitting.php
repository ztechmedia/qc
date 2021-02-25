<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
        Slitting
    </li>
</ul>

<div class="page-title">
    <h2></span> Slitting</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="li li-scpp1"><a onclick="openTab('scpp1')">SCPP 1</a></li>
                    <li class="li li-scpp2"><a onclick="openTab('scpp2')">SCPP 2</a></li>
                    <li class="li li-scpp3"><a onclick="openTab('scpp3')">SCPP 3</a></li>
                    <li class="li li-met1"><a onclick="openTab('met1')">SMET 1</a></li>
                    <li class="li li-met2"><a onclick="openTab('met2')">SMET 2</a></li>
                    <li class="li li-met3"><a onclick="openTab('met3')">SMET 3</a></li>
                    <li class="li li-scnd1"><a onclick="openTab('scnd1')">Secondary 1</a></li>
                    <li class="li li-scnd2"><a onclick="openTab('scnd2')">Secondary 2</a></li>
                    <li class="li li-all"><a onclick="openTab('all')">Semua Mesin</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="slitting-body"></div>
                </div>
                <div class="panel-footer">
                    @created_by Arman Septian
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    const BASE_URL = "<?= base_url() ?>";
    const slittTab = localStorage.getItem("slittTab");
    let year = <?= $year ?>;
    let month = <?= $month ?>;
    let day = <?= $day ?>;

    function openTab(tab) {
        $(".tab-pane").removeClass("active");
        $(".li").removeClass("active");
        $(`#tab-${tab}`).addClass("active");
        $(`.li-${tab}`).addClass("active");
        setContentLoader(".slitting-body");
        let url = `${BASE_URL}admin/productions/slitting/tab/${tab}/${year}/${month}/${day}/false`;
        localStorage.setItem("slittTab", tab);
        loadContent(url, ".slitting-body");
    }

    if (slittTab) {
        openTab(slittTab);
    } else {
        openTab("scpp1");
    }
</script>