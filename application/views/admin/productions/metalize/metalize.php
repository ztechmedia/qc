<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
        Metalize
    </li>
</ul>

<div class="page-title">
    <h2></span> Metalize</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="li li-mtz1"><a onclick="openTab('mtz1')">TOPMET</a></li>
                    <li class="li li-mtz2"><a onclick="openTab('mtz2')">GVE</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="metalize-body"></div>
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
    const metTab = localStorage.getItem("metTab");
    let year = <?= $year ?>;
    let month = <?= $month ?>;
    let day = <?= $day ?>;

    function openTab(tab) {
        $(".tab-pane").removeClass("active");
        $(".li").removeClass("active");
        $(`#tab-${tab}`).addClass("active");
        $(`.li-${tab}`).addClass("active");
        setContentLoader(".slittmetalizeing-body");
        let url = `${BASE_URL}admin/productions/metalize/tab/${tab}/${year}/${month}/${day}/false`;
        localStorage.setItem("metTab", tab);
        loadContent(url, ".metalize-body");
    }

    if (metTab) {
        openTab(metTab);
    } else {
        openTab("mtz1");
    }
</script>