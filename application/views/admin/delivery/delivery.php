<ul class="breadcrumb">
	<li class="active">Pengiriman</li>
</ul>

<div class="page-title">
	<h2><span class="fa fa-truck"></span> Pengiriman</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<div style="display:flex; flex-direction:row; justify-content:flex-end; margin-bottom:10px;">
				<div class="input-group">
					<span class="input-group-addon">Tahun</span>
					<select id="year-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=2018; $i <= 2099 ; $i++) {  $selected = $year == $i ? "selected" : null; ?>
							<option <?= $selected ?> value="<?=$i?>"><?=$i?></option>
						<?php } ?>
					</select>
				</div>

				<div class="input-group" style="margin-left: 20px;">
					<span class="input-group-addon">Bulan</span>
					<select id="month-date" class="form-control pointer" onchange="changeDate()">
						<?php for ($i=1; $i <= 12 ; $i++) {  $selected = $month == $i ? "selected" : null; ?>
							<option <?= $selected ?> value="<?=$i?>"><?= mToMonth($i) ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div id="month"></div>
		</div>

		<div class="col-md-12">
			<div id="waste"></div>
		</div>
    </div>

	<div class="row" style="margin-top: 10px">
        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid skyblue">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month_polos?> Kg</div>
                    <div class="widget-title">POLOSAN <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid limegreen">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month_metal?> Kg</div>
                    <div class="widget-title">METALIZED <?=mToMonth($month)?></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="widget widget-default widget-item-icon" style="border: 1px solid orange">
                <div class="widget-item-left">
                    <span class="fa fa-truck"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_month?> Kg</div>
                    <div class="widget-title">Total Pengiriman <?=mToMonth($month)?></div>
                </div>
            </div>
		</div>
		
		<div class="col-md-12">
			<div class="widget widget-default widget-item-icon" style="border: 1px solid #9c2020">
                <div class="widget-item-left">
                    <span class="fa fa-trash-o"></span>
                </div>
                <div class="widget-data">
                    <div class="widget-int num-count"><?=$total_waste?> Kg (<?=$waste_percen?> %)</div>
                    <div class="widget-title">Waste Bulan <?=mToMonth($month). ' '. $year?></div>
                </div>
            </div>
		</div>
    </div>
</div>

<script type="text/javascript">
	const BASE_URL = "<?= base_url() ?>";

	function changeDate() {
		let year = $("#year-date").val();
		let month = $("#month-date").val();
		const url = `${BASE_URL}admin/delivery/${year}/${month}`;
		setContentLoader(".content");
		loadContent(url, ".content");
	}

	Highcharts.chart('waste', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Waste <?= mToMonth($month).' '.$year ?> '
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					connectorColor: 'silver'
				}
			}
		},
		series: [{
			name: 'Roll HOLD & NOT',
			data: [
				{ name: '<?=$waste[0]["nama_waste"]. " (".toRp($waste[0]["total_waste"])." Kg)"?>', y: <?= intval($waste[0]["total_waste"]) ?> },
				{ name: '<?=$waste[1]["nama_waste"]. " (".toRp($waste[1]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[1]["total_waste"]) ?> },
				{ name: '<?=$waste[2]["nama_waste"]. " (".toRp($waste[2]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[2]["total_waste"]) ?> },
				{ name: '<?=$waste[3]["nama_waste"]. " (".toRp($waste[3]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[3]["total_waste"]) ?> },
				{ name: '<?=$waste[4]["nama_waste"]. " (".toRp($waste[4]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[4]["total_waste"]) ?> },
				{ name: '<?=$waste[5]["nama_waste"]. " (".toRp($waste[5]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[5]["total_waste"]) ?> },
				{ name: '<?=$waste[6]["nama_waste"]. " (".toRp($waste[6]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[6]["total_waste"]) ?> },
				{ name: '<?=$waste[7]["nama_waste"]. " (".toRp($waste[7]["total_waste"])." Kg)"?>?>', y: <?= intval($waste[7]["total_waste"]) ?> },
			]
		}]
	});

	Highcharts.chart('month', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Pengiriman Tahun <?=$year?>'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($months)?>
		},
		yAxis: {
			title: {
				text: 'Total Berat (Kg)'
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
			name: 'Total Berat Pengiriman TOTAL',
			color: "orange",
			data:<?=json_encode($total_kirim)?>
		}, {
			name: 'Total Berat Pengiriman POLOSAN',
			color: "skyblue",
			data:<?=json_encode($total_kirim_polos)?>
		}, {
			name: 'Total Berat Pengiriman METALIZED',
			color: "limegreen",
			data:<?=json_encode($total_kirim_metal)?>
		}]
	});

</script></div>