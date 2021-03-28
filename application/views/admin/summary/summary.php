<ul class="breadcrumb">
    <li class="active">Laporan Produksi</li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-bar-chart-o"></span> Slitting</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid black">
                <div class="widget-item-left">
                    <span class="fa fa-check"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?= toRp($total_slitt_ok) ?> Kg</div>
                    <div class="widget-title">BERAT ROLL OK TAHUN <?= $year?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid orange">
                <div class="widget-item-left">
                    <span class="fa fa-refresh"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?= toRp($total_slitt_hold) ?> Kg</div>
                    <div class="widget-title">BERAT ROLL HOLD TAHUN <?= $year?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid red">
                <div class="widget-item-left">
                    <span class="fa fa-times"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?= toRp($total_slitt_not) ?> Kg</div>
                    <div class="widget-title">BERAT ROLL NOT TAHUN <?= $year?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Hasil Produksi Perminggu</h3>
                </div>
                <div class="panel-body">
                        <?php foreach($products as $key => $product) { ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="widget widget-default widget-padding-sm" style="height: 210px">
                                        <div class="widget-big-int">WEEK #<?= $product['week'] ?></div>
                                        <div class="widget-subtitle plugin-date"><?= revDate($product['first_day']) ?> s/d <?= revDate($product['last_day']) ?></div>
                                        <div class="widget-buttons widget-c3">
                                            <div class="status-roll-date">
                                                <div class="status-container">
                                                    <div>
                                                        <div class="status">
                                                            <i class="fa fa-square ok"></i> <b><?= $product['total_berat_ok']?></b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square hold"></i> <b><?= $product['total_berat_hold']?></b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square not"></i> <b><?= $product['total_berat_not']?></b>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="status">
                                                            <i class="fa fa-square ok"></i> <b><?= $product['total_roll_ok']?> Roll</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square hold"></i> <b><?= $product['total_roll_hold']?> Roll</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square not"></i> <b><?= $product['total_roll_not']?> Roll</b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="wizard">

                                        <ul class="steps_7 anchor">
                                            <?php foreach($product['product'] as $tgl => $value) { ?>
                                            <li>
                                                <a>
                                                    <span class="stepDesc">
                                                        <b><?= revDate($tgl) ?></b><br>
                                                        <p>METALIZED</p>
                                                        <div class="status">
                                                            <i class="fa fa-square ok"></i> <b class="kecil"><?= $value['METALIZZED']['OK']?> Roll (<?= toRp($value['METALIZZED']['berat_ok']) ?>)</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square hold"></i> <b class="kecil"><?= $value['METALIZZED']['HOLD']?> Roll (<?= toRp($value['METALIZZED']['berat_hold']) ?>)</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square not"></i> <b class="kecil"><?= $value['METALIZZED']['NOT']?> Roll (<?= toRp($value['METALIZZED']['berat_not']) ?>)</b>
                                                        </div>
                                                        <p>POLOSAN</p>
                                                        <div class="status">
                                                            <i class="fa fa-square ok"></i> <b class="kecil"><?= $value['POLOSAN']['OK']?> Roll (<?= toRp($value['METALIZZED']['berat_ok']) ?>)</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square hold"></i> <b class="kecil"><?= $value['POLOSAN']['HOLD']?> Roll (<?= toRp($value['METALIZZED']['berat_hold']) ?>)</b>
                                                        </div>
                                                        <div class="status">
                                                            <i class="fa fa-square not"></i> <b class="kecil"><?= $value['POLOSAN']['NOT']?> Roll (<?= toRp($value['METALIZZED']['berat_not']) ?>)</b>
                                                        </div>
                                                    </span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .status-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: left;
    }

    .status {
        width: 100%;
        text-align: left;
        margin-left: 10px;
        margin-right: 10px;
    }

    .ok {
        color: black;
    }

    .hold {
        color: orange;
    }

    .not {
        color: red;
    }

    .kecil {
        font-size: 10px;
    }

    .bold {
        font-weight: bold;
    }
</style>