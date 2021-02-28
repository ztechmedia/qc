<ul class="breadcrumb">
	<li class="active">Produktifitas</li>
</ul>

<div class="page-title">
	<h2><span class="fa fa-dashboard"></span> Produktifitas Metalize</h2>
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
		<div class="col-md-12">
			<div id="month"></div>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-6">
			<div class="panel-group accordion">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a href="#accOneColOne">
								ROLL OK
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open" id="accOneColOne">
						<div id="roll-ok"></div>
					</div>                                
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel-group accordion">
				<div class="panel panel-primary">
					<div class="panel-heading ui-draggable-handle">
						<h4 class="panel-title">
							<a href="#accOneColOne">
								ROLL HOLD & NOT
							</a>
						</h4>
					</div>                                
					<div class="panel-body panel-body-open" id="accOneColOne">
						<div id="roll-not"></div>
					</div>                                
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="person"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	const BASE_URL = "<?= base_url() ?>";

	function changeDate() {
		let year = $("#year-date").val();
		let month = $("#month-date").val();
		const url = `${BASE_URL}admin/performance/metalize/${year}/${month}`;
		setContentLoader(".content");
		loadContent(url, ".content");
	}

	Highcharts.chart('roll-ok', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Performa Group Bulan <?= mToMonth($month).' '.$year ?> '
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
			name: 'Roll OK',
			data: [
				{ name: 'Group A (<?=$AQOK?> Roll)', y: <?= $AOK ?> },
				{ name: 'Group B (<?=$BQOK?> Roll)', y: <?= $BOK ?> },
				{ name: 'Group C (<?=$CQOK?> Roll)', y: <?= $COK ?> },
				{ name: 'Group D (<?=$DQOK?> Roll)', y: <?= $DOK ?> },
			]
		}]
	});

	Highcharts.chart('roll-not', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Performa Group Bulan <?= mToMonth($month).' '.$year ?> '
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
				{ name: 'Group A (<?=$AQHOLD?> Roll)', y: <?= $ANOT ?> },
				{ name: 'Group B (<?=$BQHOLD?> Roll)', y: <?= $BNOT ?> },
				{ name: 'Group C (<?=$CQHOLD?> Roll)', y: <?= $CNOT ?> },
				{ name: 'Group D (<?=$DQHOLD?> Roll)', y: <?= $DNOT ?> },
			]
		}]
	});

	Highcharts.chart('month', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Persentasi Hasil Produksi (Metalize ALL)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
		},
		yAxis: {
			title: {
				text: 'Total Roll Metalize ALL'
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
			name: 'OK',
			color: "black",
			data:<?=json_encode($ok)?>
		},{
			name: 'HOLD',
			color: "orange",
			data:<?=json_encode($hold)?>
		},{
			name: 'NOT',
			color: "red",
			data:<?=json_encode($not)?>
		}]
	});

	Highcharts.chart('person', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Produktifitas Operator Tahun <?=$year?> (Metalize ALL)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($person)?>
		},
		yAxis: {
			title: {
				text: 'Total Roll Metalize ALL'
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
			name: 'TOTAL ROLL Metalize ALL <?=$year?>',
			color: "orange",
			data:<?=json_encode($total_roll)?>
		},{
			name: 'TOTAL ROLL Metalize ALL BULAN <?=strtoupper(mToMonth($month))?>',
			color: "skyblue",
			data:<?=json_encode($total_roll_month)?>
		}]
	});
</script>