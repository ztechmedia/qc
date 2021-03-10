<ul class="breadcrumb">
    <li>Produksi</li>
    <li class="active">
        Released Roll
    </li>
</ul>

<div class="page-title">
    <h2></span> Total Released: <?=$totalRoll?> Roll</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
			<div style="display:flex; flex-direction:row; justify-content:flex-end; margin-bottom:10px;">
				<div class="input-group">
					<span class="input-group-addon">Tahun</span>
					<select id="year-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=2018; $i <= 2099 ; $i++) {  $selected = $year == $i ? "selected" : null ?>
							<option <?=$selected?> value="<?=$i?>"><?=$i?></option>
						<?php } ?>
					</select>
				</div>
				<div class="input-group" style="margin-left: 20px;">
					<span class="input-group-addon">Bulan</span>
					<select id="month-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=1; $i <= 12 ; $i++) {  $selected = $month == $i ? "selected" : null ?>
							<option <?=$selected?> value="<?=$i?>"><?=mToMonth($i)?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
        <div class="col-md-4">
            <figure class="highcharts-figure">
                <div id="released_month"></div>
            </figure>
        </div>

        <div class="col-md-8">
            <figure class="highcharts-figure">
                <div id="released_year"></div>
            </figure>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-md-4">
            <div style="background-color: #555; border: 1px solid yellow" class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                <div class="widget-item-left" style="border-right: 1px solid yellow">
                    <span style="color: yellow" class="fa fa-times"></span>
                </div>
                <div class="widget-data">
                    <div style="color: yellow" class="widget-int num-count"><?=$status['HOLD']['total']?></div>
                    <div style="color: yellow" class="widget-title"><?=toRp($status['HOLD']['total_kg'])?> Kg</div>
                    <div style="color: yellow" class="widget-subtitle">HOLD <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #555; border: 1px solid orange" class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                <div class="widget-item-left" style="border-right: 1px solid orange">
                    <span style="color: orange" class="fa fa-refresh"></span>
                </div>
                <div class="widget-data">
                    <div style="color: orange" class="widget-int num-count"><?=$status['REWORK']['total']?></div>
                    <div style="color: orange" class="widget-title"><?=toRp($status['REWORK']['total_kg'])?> Kg</div>
                    <div style="color: orange" class="widget-subtitle">REWORK <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div style="background-color: #ccc; border: 1px solid #9c2020" class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                <div class="widget-item-left" style="border-right: 1px solid #9c2020">
                    <span style="color: #9c2020" class="fa fa-trash-o"></span>
                </div>
                <div class="widget-data">
                    <div style="color: #9c2020" class="widget-int num-count"><?=$status['REJECT']['total']?></div>
                    <div style="color: #9c2020" class="widget-title"><?=toRp($status['REJECT']['total_kg'])?> Kg</div>
                    <div style="color: #9c2020" class="widget-subtitle">REJECT <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" id="released-roll">
                <thead>
                    <th>Tgl Released</th>
                    <th>No Released</th>
                    <th>Tipe</th>
                    <th>Tebal</th>
                    <th>Lebar</th>
                    <th>Panjang</th>
                    <th>No Roll</th>
                    <th>Berat</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Alasan</th>
                    <th width="5%">Tindakan</th>
                </thead>
            </table>
        </table>
        </div>
    </div>

</div>

<script>
    const BASE_URL = "<?= base_url() ?>";

    function changeDate() {
		let year = $("#year-date").val();
		let month = $("#month-date").val();
		const url = `${BASE_URL}admin/productions/released/${year}/${month}`;
		setContentLoader(".content");
		loadContent(url, ".content");
    }
    $('#released-roll').DataTable({
        "searching": false,
        "processing": false,
        "serverSide": true,
        "searching": false,
        "order": [
            [0, 'desc']
        ],
        "ajax": {
            "url": "<?= base_url("admin/productions/released-table/$year/$month") ?>",
            "type": "POST"
        },
        columns: [
            {
                data: "tgl_released_jr",
            },
            {
                data: "no_released_jr",
            },
            {
                data: "type_slitt",
            },
            {
                data: "mic_slitt",
            },
            {
                data: 'lebar_slitt'
            },
            {
                data: 'panjang_slitt'
            },
            {
                data: 'no_roll_released_jr'
            },
            {
                data: 'kg_hasil_slitt'
            },
            {
                data: 'id_user_released_jr'
            },
            {
                data: 'status_akhir'
            },
            {
                data: 'reason_jr'
            },{
                    data: 'actions'
                }
        ]
    });

    Highcharts.chart('released_month', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Persentase Release Roll Bulan <?= $fullMonth." Tahun ".$year ?>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: [
                {
                    name: 'HOLD',
                    y: <?=$status["HOLD"]["total"]?>,
                    color: "yellow"
                },
                {
                    name: 'REWORK',
                    y: <?=$status["REWORK"]["total"]?>,
                    color: "orange"
                },
                {
                    name: 'REJECT',
                    y: <?=$status["REJECT"]["total"]?>,
                    color: "#9c2020",
                    sliced: true,
                    selected: true
                },
            ]
        }]
    });

    Highcharts.chart('released_year', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Persentasi Release Roll Tahun <?= $year ?>'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
		},
		yAxis: {
			title: {
				text: 'Total Roll Released'
			}
		},
		plotOptions: {
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: false
			}
		},
		series: [{
			name: 'HOLD',
			color: "yellow",
			data:<?=json_encode($hold)?>
		},{
			name: 'REWORK',
			color: "orange",
			data:<?=json_encode($rework)?>
		},{
			name: 'REJECT',
			color: "#9c2020",
			data:<?=json_encode($reject)?>
		}]
	});
</script>

<style>
    	.tbody {
		display: block;
		height: 380px;
		overflow: auto;
		font-size: 11px;
		color: #000;
	}

	.thead,
	.tbody tr {
		display: table;
		width: 100%;
		table-layout: fixed;
	}
</style>