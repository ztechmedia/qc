<ul class="breadcrumb">
	<li class="active">Produktifitas</li>
</ul>

<div class="page-title">
	<h2><span class="fa fa-dashboard"></span> Produktifitas Slitting</h2>
</div>

<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<div style="display:flex; row-direction:row; justify-content:flex-end; margin-bottom:10px;">
				<div class="input-group">
					<input readonly id="date-filter" type="text" class="form-control pointer" 
						style="color: #000;background:#fff;" value="<?= $currDate ?>" 
						data-date="<?= date("d-m-Y") ?>" data-date-format="dd-mm-yyyy" data-date-viewmode="months" />
					<span class="input-group-addon pointer" onclick="changeDate()">Ganti Tanggal</span>
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

	<div class="row">
		<div class="col-md-12">
			<div id="person-met"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div id="person-all"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	const BASE_URL = "<?= base_url() ?>";
	$("#date-filter").datepicker();

	function changeDate() {
		let dt = $("#date-filter").val().split("-");
		const url = `${BASE_URL}admin/performance/slitting/${dt[2]}/${dt[1]}/${dt[0]}`;
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
				{ name: 'Group A', y: <?= $AOK ?> },
				{ name: 'Group B', y: <?= $BOK ?> },
				{ name: 'Group C', y: <?= $COK ?> },
				{ name: 'Group D', y: <?= $DOK ?> },
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
				{ name: 'Group A', y: <?= $ANOT ?> },
				{ name: 'Group B', y: <?= $BNOT ?> },
				{ name: 'Group C', y: <?= $CNOT ?> },
				{ name: 'Group D', y: <?= $DNOT ?> },
			]
		}]
	});

	Highcharts.chart('month', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Persentasi Hasil Produksi (Slitting FG)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
		},
		yAxis: {
			title: {
				text: 'Total Roll'
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
			text: 'Produktifitas Operator Tahun <?=$year?> (Slitting FG POLOSAN)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($person)?>
		},
		yAxis: {
			title: {
				text: 'Total Roll Polos'
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
			name: 'TOTAL ROLL FG POLOSAN <?=$year?>',
			color: "orange",
			data:<?=json_encode($total_roll)?>
		}]
	});

	Highcharts.chart('person-met', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Produktifitas Operator Tahun <?=$year?> (Slitting FG METALIZED)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($person_met)?>
		},
		yAxis: {
			title: {
				text: 'Total Roll Metalize'
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
			name: 'TOTAL ROLL FG METALIZE <?=$year?>',
			color: "green",
			data:<?=json_encode($total_roll_met)?>
		}]
	});

	Highcharts.chart('person-all', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Produktifitas Operator Tahun <?=$year?> (Slitting ALL POLOSAN·METALIZED·BASE FILM)'
		},
		subtitle: {
			text: 'PT. Wira Mustika Abadi'
		},
		xAxis: {
			categories: <?=json_encode($person_all)?>
		},
		yAxis: {
			title: {
				text: 'Total Roll POLOSAN·METALIZED·BASE FILM'
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
			name: 'TOTAL ROLL POLOSAN·METALIZED·BASE FILM <?=$year?>',
			color: "skyblue",
			data:<?=json_encode($total_roll_all)?>
		}]
	});
</script>