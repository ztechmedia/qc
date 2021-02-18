<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
        CPP
    </li>
</ul>

<div class="page-title">
    <h2></span> CPP</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="li li-cpp1"><a onclick="openTab('cpp1')">TCE</a></li>
                    <li class="li li-cpp2"><a onclick="openTab('cpp2')">SML</a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="cpp-body"></div>
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
    const cppTab = localStorage.getItem("cppTab");
    let year = <?= $year ?>;
    let month = <?= $month ?>;
    let day = <?= $day ?>;

    function openTab(tab) {
        $(".tab-pane").removeClass("active");
        $(".li").removeClass("active");
        $(`#tab-${tab}`).addClass("active");
        $(`.li-${tab}`).addClass("active");
        setContentLoader(".slittmetalizeing-body");
        let url = `${BASE_URL}admin/productions/cpp/tab/${tab}/${year}/${month}/${day}/false`;
        localStorage.setItem("cppTab", tab);
        loadContent(url, ".cpp-body");
    }

    if (cppTab) {
        openTab(cppTab);
    } else {
        openTab("cpp1");
    }
</script>